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
          'title' => 'Вал',
          'url_key' => 'val',
          'sort' => 2
        ],
        [
          'title' => 'Игла (наконечник)',
          'url_key' => 'Igla',
          'sort' => 3
        ],
        [
          'title' => 'Механические свойства',
          'url_key' => 'mekhanicheskie-svojstva',
          'sort' => 4
        ],
        [
          'title' => 'SKF подшипник: 6202 2RS',
          'url_key' => 'SKF-podshipnik-6202-2RS',
          'sort' => 5
        ],
        [
          'title' => 'Электрические свойства',
          'url_key' => 'ehlektricheskie-svojstva',
          'sort' => 6
        ],
        [
          'title' => 'SKF подшипник: NJ 2315 C3',
          'url_key' => 'SKF-podshipnik-NJ-2315-C3',
          'sort' => 7
        ],
        [
          'title' => 'SKF подшипник: NJ 2317 C3',
          'url_key' => 'SKF-podshipnik-NJ-2317-C3',
          'sort' => 8
        ],
        [
          'title' => 'SKF подшипник: NJ 2307 C3',
          'url_key' => 'SKF-podshipnik-NJ-2307-C3',
          'sort' => 9
        ],
        [
          'title' => 'SKF подшипник: 6306 2RS',
          'url_key' => 'SKF-podshipnik-6306-2RS',
          'sort' => 10
        ],
        [
          'title' => 'SKF подшипник: NJ 306 C3',
          'url_key' => 'SKF-podshipnik-NJ-306-C3',
          'sort' => 11
        ],
        [
          'title' => 'SKF подшипник: 6305 2RS',
          'url_key' => 'SKF-podshipnik-6305-2RS',
          'sort' => 12
        ],
        [
          'title' => 'SKF подшипник',
          'url_key' => 'SKF-podshipnik',
          'sort' => 13
        ],
        [
          'title' => 'SKF подшипник: 6303 2RS',
          'url_key' => 'SKF-podshipnik-6303-2R',
          'sort' => 14
        ],
        [
          'title' => 'SKF подшипник: 6302 2RS',
          'url_key' => 'SKF-podshipnik-6302-2RS',
          'sort' => 15
        ],
        [
          'title' => 'Вибратор',
          'url_key' => 'vibrator',
          'sort' => 16
        ],
        [
          'title' => 'Динамический момент',
          'url_key' => 'dinamicheskij-moment',
          'sort' => 17
        ],
        [
          'title' => 'Вынуждающая сила (FC)',
          'url_key' => 'vynuzhdayushchaya-sila',
          'sort' => 18
        ],
        [
          'title' => 'Потребление воздуха',
          'url_key' => 'potreblenie-vozduha',
          'sort' => 19
        ],
        [
          'title' => 'SKF подшипник: 6304 2RS',
          'url_key' => 'SKF-podshipnik-6304-2RS',
          'sort' => 20
        ],
        [
          'title' => 'SKF подшипник: 6305 RS',
          'url_key' => 'SKF-podshipnik-6305-RS',
          'sort' => 21
        ],
        [
          'title' => 'SKF подшипник: NJ 2308 C3',
          'url_key' => 'SKF-podshipnik-NJ-2308-C3',
          'sort' => 22
        ],
        [
          'title' => 'SKF подшипник: NJ 2311 C3',
          'url_key' => 'SKF-podshipnik-NJ-2311-C3',
          'sort' => 23
        ],
        [
          'title' => 'SKF подшипник: ',
          'url_key' => 'SKF-podshipnik',
          'sort' => 24
        ],
        [
          'title' => 'Энергия',
          'url_key' => 'ennergiya',
          'sort' => 25
        ],
        [
          'title' => 'Сила удара',
          'url_key' => 'sila-udara',
          'sort' => 26
        ],
      ]);

    }
}
