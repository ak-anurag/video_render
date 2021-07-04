<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    //connection with comments
    public function comment(){
        return $this->hasMany('App\Models\Comment', 'video_id', 'id');
    }
}
