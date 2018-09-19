<?php

use Faker\Generator as Faker;


    $factory->define(App\Customer::class, function (Faker $faker) {
        return [
            'name' => $faker->name,
            'project_id' => rand(1,5),
            'created_at'=>date("Y-m-d H:i:s",rand(1535760000,1538265600))

        ];
    });