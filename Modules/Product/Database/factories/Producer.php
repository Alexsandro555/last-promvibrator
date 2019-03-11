<?php

use Faker\Generator as Faker;

$factory->define(\Modules\Product\Entities\Producer::class, function (Faker $faker) {
  return [
    'url_key' => $faker->slug
  ];
});