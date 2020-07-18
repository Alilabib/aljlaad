<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Area;
use Faker\Generator as Faker;

$factory->define(Area::class, function (Faker $faker) {
    return [
        //
        'name_ar'=>$faker->address,
        'name_en'=>$faker->address,
        'lat'=>$faker->latitude,
        'long'=>$faker->longitude,
        'city_id'=>factory(\App\Models\City::class)->create(),

    ];
});
