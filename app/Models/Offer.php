<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    protected $guarded = ['id'];
    
    public function getImageUrlAttribute()
    {
        return ($this->img != null) ? asset('storage/uploads/categories/' . $this->img) : asset('media/avatars/avatar10.jpg');
    }

    public function getBackImageUrlAttribute()
    {
        return ($this->img != null) ? asset('storage/uploads/categories/' . $this->img) : asset('media/avatars/avatar10.jpg');
    }
}
