<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ActivityLogService
{
    // Your service logic here
    private static function log($subject,$description,$data)
    {
        $user = Auth::user();
        if($user->role == 'lecturer'){
            $table_user = 'lecturers';
            $user_id = $user->name;
        }else{
            $table_user = 'students';
            $user_id = $user->name;
        }
        ActivityLog::create([
            'subject' => $subject,
            'activity' => $description,
            'properties' => $data,
            'table_user' => $table_user,
            'user_name' => $user_id,
        ]);
    }

    public static function logMasterCreate($object,$data)
    {
        $subject = "Master Data";
        $description = "Create ".$object;
        self::log($subject,$description,$data);
    }

    public static function logMasterUpdate($object,$data)
    {
        $subject = "Master Data";
        $description = "Update ".$object;
        self::log($subject,$description,$data);
    }

    public static function logMasterDelete($object,$data)
    {
        $subject = "Master Data";
        $description = "Delete ".$object;
        self::log($subject,$description,$data);
    }

}
