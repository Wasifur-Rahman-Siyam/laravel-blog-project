<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo('App\Models\user');
    }

    public function categories(){
        return $this->belongsToMany('App\Models\category')->withTimestamps();
    }
    public function tags(){
        return $this->belongsToMany('App\Models\tag')->withTimestamps();
    }
}
