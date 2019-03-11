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
        'title' => 'Классическая серия',
        'type_product_id' => 1,
        'sort' => 1,
        'url_key' => 'classic'
      ],
      [
        'title' => 'Увеличенный ресурс',
        'type_product_id' => 1,
        'sort' => 2,
        'url_key' => 'increased-life'
      ],
      [
        'title' => 'Взрывозащищенная серия',
        'type_product_id' => 1,
        'sort' => 3,
        'url_key' => 'explosion-proof-series'
      ],
      [
        'title' => 'Со съемными крышками',
        'type_product_id' => 1,
        'sort' => 4,
        'url_key' => 'removable-covers'
      ],
      [
        'title' => 'K - поршневой тип',
        'type_product_id' => 2,
        'sort' => 5,
        'url_key' => 'K'
      ],
      [
        'title' => 'S - шаровый тип',
        'type_product_id' => 2,
        'sort' => 6,
        'url_key' => 'S'
      ],
      [
        'title' => 'OR - роликовый тип',
        'type_product_id' => 2,
        'sort' => 7,
        'url_key' => 'OR'
      ],
      [
        'title' => 'OT - турбинный тип',
        'type_product_id' => 2,
        'sort' => 8,
        'url_key' => 'OT'
      ],
      [
        'title' => 'PS - пневмомолоток',
        'type_product_id' => 2,
        'sort' => 9,
        'url_key' => 'PS'
      ],
      [
        'title' => 'PJ - пневмомолот',
        'type_product_id' => 2,
        'sort' => 10,
        'url_key' => 'PJ'
      ],
      [
        'title' => 'F - Поршневые вибраторы',
        'type_product_id' => 2,
        'sort' => 11,
        'url_key' => 'F'
      ],
      [
        'title' => 'P - Постоянного удара',
        'type_product_id' => 2,
        'sort' => 12,
        'url_key' => 'P'
      ],
      [
        'title' => 'PG - пневмопушка',
        'type_product_id' => 3,
        'sort' => 13,
        'url_key' => 'PG'
      ],
      [
        'title' => 'VBS - виброаэраторы',
        'type_product_id' => 3,
        'sort' => 14,
        'url_key' => 'VBS'
      ],
      [
        'title' => 'U - Форсунки аэрации',
        'type_product_id' => 3,
        'sort' => 15,
        'url_key' => 'U'
      ],
      [
        'title' => 'I - пластины аэрации',
        'type_product_id' => 3,
        'sort' => 16,
        'url_key' => 'I'
      ],
      [
        'title' => 'Механические VD',
        'type_product_id' => 4,
        'sort' => 17,
        'url_key' => 'VD'
      ],
      [
        'title' => 'Механические UNI',
        'type_product_id' => 4,
        'sort' => 18,
        'url_key' => 'UNI'
      ],
      [
        'title' => 'Гидравлический вибратор MVO',
        'type_product_id' => 5,
        'sort' => 19,
        'url_key' => 'GVMVO'
      ],
    ]);
  }
}
