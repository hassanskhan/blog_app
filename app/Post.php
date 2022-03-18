<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    protected $date=['created_at'];
protected $appends=['new_time'];
    public function comments(){

        return $this->hasMany(comments::class);
    
    }
    public function users(){

        return $this->hasMany(User::class);
    }

 
    public function getNewTimeAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();  
      }
}
