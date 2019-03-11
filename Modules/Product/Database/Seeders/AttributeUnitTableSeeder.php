<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AttributeUnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Model::unguard();
      DB::table('attribute_units')->insert([
        [
          'title' => 'кг',
          'url_key' => 'kg',
          'sort' => 1
        ],
        [
          'title' => 'Гц',
          'url_key' => 'gc',
          'sort' => 2
        ],
        [
          'title' => 'kH',
          'url_key' => 'kh',
          'sort' => 3
        ],
        [
          'title' => 'кг/см',
          'url_key' => 'kg-sm',
          'sort' => 4
        ],
        [
          'title' => 'л/мин',
          'url_key' => 'l-min',
          'sort' => 5
        ],
        [
          'title' => 'Дж.',
          'url_key' => 'dg',
          'sort' => 6
        ],
        [
          'title' => 'H',
          'url_key' => 'h',
          'sort' => 7
        ],
        [
          'title' => '°С',
          'url_key' => 'grad-c',
          'sort' => 8
        ],
        [
          'title' => 'кВт',
          'url_key' => 'kvt',
          'sort' => 9
        ]
      ]);
    }
}
