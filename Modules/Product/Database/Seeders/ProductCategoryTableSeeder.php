<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductCategoryTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Model::unguard();

    DB::table('product_categories')->insert([
      [
        'title' => 'Площадочные вибраторы',
        'sort' => 1,
        'url_key' => 'mve'
      ],
      [
        'title' => 'Пневматические вибраторы',
        'sort' => 2,
        'url_key' => 'pnevmo'
      ],
      [
        'title' => 'Системы виброаэрации',
        'sort' => 3,
        'url_key' => 'aeration'
      ],
      [
        'title' => 'Глубинные вибратороы',
        'sort' => 4,
        'url_key' => 'concrete'
      ],
      [
        'title' => 'Гидравлические вибраторы',
        'sort' => 5,
        'url_key' => 'hydro'
      ]
    ]);
  }
}
