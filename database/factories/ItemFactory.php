<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Item::class, function (Faker $faker) {

    return [
        "name"=>$faker->name,
        "unitName"=>$faker->name,
        "bundleName"=>$faker->name,
        "unitsPerBundle"=>$faker->numberBetween(1,20),
        "category"=>collect(config("company.categories"))->random()
    ];
});

$factory->define(App\ItemVariable::class, function (Faker $faker) {

    $price=$faker->randomNumber(4);

    return [
        "buyingPrice"=>$price,
        "sellingPrice"=>$price+$faker->numberBetween(200,10000),
    ];
});
