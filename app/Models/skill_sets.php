<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class skill_sets extends Model
{
    use HasApiTokens, 
    HasFactory, 
    Notifiable, 
    SoftDeletes;

    public function candidates(){
        return $this->belongsTo(candidates::class, 'candidate_id', 'id');
    }

    public function skills(){
        return $this->belongsTo(skills::class, 'skill_id', 'id');
    }
}
