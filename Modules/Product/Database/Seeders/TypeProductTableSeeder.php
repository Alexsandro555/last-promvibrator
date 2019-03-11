<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TypeProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('type_products')->insert([
          [
            'title' => 'Площадочные вибраторы',
            'tnved_id' => 1,
            'product_category_id' => 1,
            'sort' => 1,
            'url_key' => 'mve'
          ],
          [
            'title' => 'Пневматические вибраторы',
            'tnved_id' => 1,
            'product_category_id' => 1,
            'sort' => 2,
            'url_key' => 'pnevmo'
          ],
          [
            'title' => 'Системы виброаэрации',
            'tnved_id' => 1,
            'product_category_id' => 1,
            'sort' => 3,
            'url_key' => 'aeration'
          ],
          [
            'title' => 'Глубинные вибратороы',
            'tnved_id' => 1,
            'product_category_id' => 1,
            'sort' => 4,
            'url_key' => 'concrete'
          ],
          [
            'title' => 'Гидравлические вибратороы',
            'tnved_id' => 1,
            'product_category_id' => 1,
            'sort' => 5,
            'url_key' => 'hydro'
          ]
        ]);
    }
}
