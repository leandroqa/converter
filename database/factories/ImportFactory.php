<?php

use Faker\Generator as Faker;

$factory->define(App\Import::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->address,
        'stars' => rand(-10,10),
        'contact' => $faker->name ,
        'phone' => $faker->tollFreePhoneNumber,
        'url' => $faker->url,
    ];
});
