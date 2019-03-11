<?php

use Faker\Generator as Faker;

$factory->define(\Modules\Product\Entities\ProductCategory::class, function (Faker $faker) {
  return [
    'title' => $faker->sentence(3),
    'url_key' => $faker->slug
  ];
});