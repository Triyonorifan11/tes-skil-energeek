<?php

namespace App\Services;

use App\Models\Kelas;
use App\Models\Kelas_detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KelasService
{
    public static function list_all_kelas()
    {
        $user = Auth::user();
        if ($user->role == 'lecturer') {
            $kelas = Kelas::with('lecturers:id,name')->where('lecturer_id', $user->id)->get();
        } else {
            $kelas = Kelas::with('lecturers:id,name')->get();
        }
        $kelas->makeHidden('lecturer_id');
        foreach ($kelas as $k) {
            $k->lecturers->makeHidden('id');
        }
        return $kelas;
    }
    public static function list_detail_kelas($uid)
    {
        $kelas = Kelas::where('kelas_uid', $uid)->get()[0];
        $query_detail = "SELECT name,npm,kd.created_at,email FROM kelas_details kd inner join students s ON s.id = kd.student_id where kd.kelas_id = :id";
        $kelas_detail = DB::select($query_detail, ['id' => $kelas->id]);
        return [
            'list_detail' => $kelas_detail,
            'nama_kelas' => $kelas->nama_kelas
        ];
    }

    public static function create($data)
    {
        $kelas = new Kelas();
        $kelas->kelas_uid = Str::uuid()->toString();
        $kelas->kode_kelas = $data['kode_kelas'];
        $kelas->nama_kelas = $data['nama_kelas'];
        $kelas->lecturer_id = $data['lecturer_id'];
        $kelas->deskripsi_kelas = $data['deskripsi_kelas'];
        $kelas->save(); 
        ActivityLogService::logMasterCreate('Kelas', $kelas);
        return $kelas;
    }

    public static function update($data, $kelas)
    {
        $kelas = Kelas::where('kelas_uid', $kelas)->get()[0];
        $kelas->kode_kelas = $data['kode_kelas'];
        $kelas->nama_kelas = $data['nama_kelas'];
        $kelas->lecturer_id = $data['lecturer_id'];
        $kelas->deskripsi_kelas = $data['deskripsi_kelas'];
        $kelas->update($data);
        ActivityLogService::logMasterUpdate('Kelas', $kelas);
        return $kelas;
    }

    // delete kelas header
    public static function delete($uid)
    {
        $kelas = Kelas::with('details')->where('kelas_uid', $uid)->get()[0];
        if ($kelas->details->count() > 0) {
            throw new \Exception('Kelas masih memiliki anggota');
        } else {
            $kelas->delete();
            ActivityLogService::logMasterDelete('Kelas', $kelas);
            return $kelas;
        }
    }

    // for kelas detail => daftar / gabung / kursus kelas
    public static function addMember($data)
    {
        $user = Auth::user();
        $kelas = Kelas::where('kelas_uid', $data->kelas_uid)->get()[0];
        $kelas_detail = new Kelas_detail();
        $kelas_detail->student_id = $user->id;
        $kelas_detail->kelas_id = $kelas->id;
        $kelas_detail->save();
        ActivityLogService::logMasterCreate('Kursus Kelas', $kelas_detail);
        return $kelas;
    }

    public static function keluar_kelas($data)
    {
        $user = Auth::user();
        $kelas = Kelas::where('kelas_uid', $data->kelas_uid)->get()[0];
        $kelas_details = Kelas_detail::where("student_id", $user->id)->where('kelas_id', $kelas->id)->get();
        if($kelas_details->count() > 0){
            $kelas_details[0]->delete();
            ActivityLogService::logMasterDelete('Kursus Kelas', $kelas_details[0]);
            return 'success';
        }else{
            throw new \Exception('Anggota tidak terdaftar pada kelas!');
        }
    }
}
