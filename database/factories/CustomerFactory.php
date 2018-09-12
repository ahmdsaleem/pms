<?php

use Faker\Generator as Faker;


    $factory->define(App\Customer::class, function (Faker $faker) {
        return [
            'name' => $faker->name,
            'product_id' => rand(1,5)
        ];
    });