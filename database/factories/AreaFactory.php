<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Area;
use Faker\Generator as Faker;

$factory->define(Area::class, function (Faker $faker) {
    return [
        //
        'name_ar'=>$faker->area,
        'name_en'=>$faker->area,
        'city_id'=>factory(\App\Models\City::class)->create(),
        'active'    =>1

    ];
});
