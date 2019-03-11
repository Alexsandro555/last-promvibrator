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
        'title' => 'Промышленные вибраторы',
        'url_key' => 'promyshlennye-vibratory',
        'sort' => 1
      ]
    ]);
  }
}
