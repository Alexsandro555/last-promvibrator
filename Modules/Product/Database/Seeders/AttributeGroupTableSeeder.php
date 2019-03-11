<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AttributeGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Model::unguard();
      DB::table('attribute_groups')->insert([
        [
          'title' => 'Характеристики',
          'url_key' => 'harakteristiki',
          'sort' => 1
        ],
        [
          'title' => 'Механические свойства',
          'url_key' => 'mekhanicheskie-svojstva',
          'sort' => 4
        ],
        [
          'title' => 'Электрические свойства',
          'url_key' => 'ehlektricheskie-svojstva',
          'sort' => 6
        ]
      ]);

    }
}
