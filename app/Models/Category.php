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
}
