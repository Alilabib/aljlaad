<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $guarded = ['id'];

    public function maincategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function getImageUrlAttribute()
    {
        return ($this->img != null) ? asset('storage/uploads/categories/' . $this->img) : asset('media/avatars/avatar10.jpg');
    }

    public function getBackImageUrlAttribute()
    {
        return ($this->img != null) ? asset('storage/uploads/categories/' . $this->img) : asset('media/avatars/avatar10.jpg');
    }

}
