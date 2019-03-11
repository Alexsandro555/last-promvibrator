<?php

use Faker\Generator as Faker;

$factory->define(\Modules\Product\Entities\Product::class, function (Faker $faker) {
  return [
    'url_key' => $faker->slug
  ];
});