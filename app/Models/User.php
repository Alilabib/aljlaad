<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
class User extends Authenticatable
{
    //
    use Notifiable;
    protected $guarded = ['id'];
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }
}
