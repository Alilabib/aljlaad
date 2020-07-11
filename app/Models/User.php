<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    //
    use Notifiable;
    protected $guarded = ['id'];
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

        /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function token()
    {
        return $this->hasOne(Token::class);
    }

    public function getImageUrlAttribute()
    {

        return ($this->image != null) ? asset('storage/uploads/users/' . $this->img) : asset('media/avatars/avatar10.jpg');
    }

}
