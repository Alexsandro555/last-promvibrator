<?php

use Faker\Generator as Faker;

$factory->define(\Modules\Product\Entities\AttributeUnit::class, function (Faker $faker) {
  return [
    'url_key' => $faker->slug
  ];
});