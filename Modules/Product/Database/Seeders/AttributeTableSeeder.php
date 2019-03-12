<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Model::unguard();
      DB::table('attributes')->insert([
        [
          'title' => 'Вес',
          'url_key' => 'ves',
          'sort' => 1,
          'attribute_type_id' => 4,
          'attribute_unit_id' => 1,
          'attribute_group_id' => 2
        ],
        [
          'title' => 'Вынуждающая сила',
          'url_key' => 'vyinujdayuschaya-sila',
          'sort' => 2,
          'attribute_type_id' => 4,
          'attribute_unit_id' => 3,
          'attribute_group_id' => 2
        ],
        [
          'title' => 'Номинальный ток',
          'url_key' => 'nominalnyiy-tok',
          'sort' => 3,
          'attribute_type_id' => 4,
          'attribute_unit_id' => 10,
          'attribute_group_id' => 3
        ],
        [
          'title' => 'Обороты',
          'url_key' => 'oborotyi',
          'sort' => 4,
          'attribute_type_id' => 4,
          'attribute_unit_id' => 11,
          'attribute_group_id' => 2
        ],
        [
          'title' => 'Потребляемая мощность',
          'url_key' => 'potreblyaemaya-moschnost',
          'sort' => 5,
          'attribute_type_id' => 4,
          'attribute_unit_id' => 12,
          'attribute_group_id' => 3
        ],
        [
          'title' => 'Размер A',
          'url_key' => 'razmer-a',
          'sort' => 6,
          'attribute_type_id' => 3,
          'attribute_unit_id' => 13,
          'attribute_group_id' => 4
        ],
        [
          'title' => 'Размер B',
          'url_key' => 'razmer-b',
          'sort' => 7,
          'attribute_type_id' => 3,
          'attribute_unit_id' => 13,
          'attribute_group_id' => 4
        ],
        [
          'title' => 'Размер C',
          'url_key' => 'razmer-c',
          'sort' => 8,
          'attribute_type_id' => 3,
          'attribute_unit_id' => 13,
          'attribute_group_id' => 4
        ],
        [
          'title' => 'Размер D',
          'url_key' => 'razmer-d',
          'sort' => 9,
          'attribute_type_id' => 3,
          'attribute_unit_id' => 13,
          'attribute_group_id' => 4
        ],
        [
          'title' => 'Размер d N',
          'url_key' => 'razmer-d-n',
          'sort' => 10,
          'attribute_type_id' => 3,
          'attribute_unit_id' => 13,
          'attribute_group_id' => 4
        ],
        [
          'title' => 'Размер E',
          'url_key' => 'razmer-e',
          'sort' => 11,
          'attribute_type_id' => 3,
          'attribute_unit_id' => 13,
          'attribute_group_id' => 4
        ],
        [
          'title' => 'Размер F',
          'url_key' => 'razmer-f',
          'sort' => 12,
          'attribute_type_id' => 3,
          'attribute_unit_id' => 13,
          'attribute_group_id' => 4
        ],
        [
          'title' => 'Размер G',
          'url_key' => 'razmer-g',
          'sort' => 13,
          'attribute_type_id' => 3,
          'attribute_unit_id' => 13,
          'attribute_group_id' => 4
        ],
        [
          'title' => 'Размер L',
          'url_key' => 'razmer-l',
          'sort' => 14,
          'attribute_type_id' => 3,
          'attribute_unit_id' => 13,
          'attribute_group_id' => 4
        ],
        [
          'title' => 'Размер M',
          'url_key' => 'razmer-m',
          'sort' => 15,
          'attribute_type_id' => 3,
          'attribute_unit_id' => 13,
          'attribute_group_id' => 4
        ],
        [
          'title' => 'Статический момент',
          'url_key' => 'staticheskiy-moment',
          'sort' => 16,
          'attribute_type_id' => 3,
          'attribute_unit_id' => 14,
          'attribute_group_id' => 4
        ],
      ]);
    }
}
