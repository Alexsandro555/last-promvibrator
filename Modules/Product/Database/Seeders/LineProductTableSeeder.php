<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LineProductTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Model::unguard();
    DB::table('line_products')->insert([
      [
        'title' => '2 полюсной/3000 об/мин.',
        'type_product_id' => 1,
        'sort' => 1,
        'url_key' => '2polus-3000'
      ],
      [
        'title' => '4 полюсной/1500 об/мин.',
        'type_product_id' => 1,
        'sort' => 2,
        'url_key' => '4polus-1500'
      ],
      [
        'title' => '6 полюсной/1000 об/мин.',
        'type_product_id' => 1,
        'sort' => 3,
        'url_key' => '6polus-1000'
      ],
      [
        'title' => '8 полюсной/750 об/мин.',
        'type_product_id' => 1,
        'sort' => 4,
        'url_key' => '8polus-750'
      ],
      [
        'title' => '2 полюсной/однофазный',
        'type_product_id' => 1,
        'sort' => 5,
        'url_key' => '2polus-1faza'
      ],
      [
        'title' => 'микровибраторы',
        'type_product_id' => 1,
        'sort' => 6,
        'url_key' => 'micro'
      ],
      [
        'title' => 'на постоянном токе',
        'type_product_id' => 1,
        'sort' => 7,
        'url_key' => 'direct-current'
      ],
      [
        'title' => 'высокоамплитудные/для помола',
        'type_product_id' => 1,
        'sort' => 7,
        'url_key' => '10polus-600'
      ],
      [
        'title' => '2 полюсной/3000 об/мин.',
        'type_product_id' => 2,
        'sort' => 1,
        'url_key' => '2polus-3000E'
      ],
      [
        'title' => '4 полюсной/1500 об/мин.',
        'type_product_id' => 2,
        'sort' => 2,
        'url_key' => '4polus-1500E'
      ],
      [
        'title' => '6 полюсной/1000 об/мин.',
        'type_product_id' => 2,
        'sort' => 3,
        'url_key' => '6polus-1000E'
      ],
      [
        'title' => '8 полюсной/750 об/мин.',
        'type_product_id' => 2,
        'sort' => 4,
        'url_key' => '8polus-750E'
      ],
      [
        'title' => '2 полюсной/3000 об/мин.',
        'type_product_id' => 3,
        'sort' => 1,
        'url_key' => '2polus-3000D'
      ],
      [
        'title' => '4 полюсной/1500 об/мин.',
        'type_product_id' => 3,
        'sort' => 2,
        'url_key' => '4polus-1500D'
      ],
      [
        'title' => '6 полюсной/1000 об/мин.',
        'type_product_id' => 3,
        'sort' => 3,
        'url_key' => '6polus-1000D'
      ],
      [
        'title' => '8 полюсной/750 об/мин.',
        'type_product_id' => 3,
        'sort' => 4,
        'url_key' => '8polus-750D'
      ],
      [
        'title' => '4 полюсной/1500 об/мин.',
        'type_product_id' => 4,
        'sort' => 2,
        'url_key' => '4polus-1500S'
      ],
      [
        'title' => '6 полюсной/1000 об/мин.',
        'type_product_id' => 4,
        'sort' => 3,
        'url_key' => '6polus-1000S'
      ],
      [
        'title' => '8 полюсной/750 об/мин.',
        'type_product_id' => 4,
        'sort' => 4,
        'url_key' => '8polus-750S'
      ],
    ]);
  }
}
