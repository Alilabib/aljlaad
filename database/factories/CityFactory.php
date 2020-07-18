<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\City;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return [
        //
        'name_ar'=>$faker->city,
        'name_en'=>$faker->city,
        'desc_ar'=>$faker->text,
        
        'desc_en'=>$faker->text,
        'active'=>1
    ];
});
