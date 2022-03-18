<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class comments extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(Users::class);
    }
}
