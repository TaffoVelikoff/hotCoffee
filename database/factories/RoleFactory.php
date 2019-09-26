<?php

use Faker\Generator as Faker;
use TaffoVelikoff\HotCoffee\Role;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
    ];
});