<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class candidates extends Model
{
    use HasApiTokens, 
    HasFactory, 
    Notifiable, 
    SoftDeletes;

    public function jobs(){
        return $this->belongsTo(jobs::class, 'job_id', 'id');
    }

    public function skill_sets(){
        return $this->hasMany(skill_sets::class,'candidate_id', 'id');
    }
}
