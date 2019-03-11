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
          'attribute_group_id' => 4
        ],
        [
          'title' => 'Рабочий момент',
          'url_key' => 'rabochij-moment',
          'sort' => 2,
          'attribute_type_id' => 4,
          'attribute_unit_id' => 4,
          'attribute_group_id' => 4
        ],
        [
          'title' => 'Вынуждающая сила',
          'url_key' => 'vynuzhdayushchaya-sila',
          'sort' => 3,
          'attribute_type_id' => 4,
          'attribute_unit_id' => 3,
          'attribute_group_id' => 4
        ],
        [
          'title' => 'Размер',
          'url_key' => 'razmer',
          'sort' => 4,
          'attribute_type_id' => 3,
          'attribute_group_id' => 4
        ],
        [
          'title' => 'Мощность',
          'url_key' => 'moshchnost',
          'sort' => 5,
          'attribute_type_id' => 4,
          'attribute_unit_id' => 9,
          'attribute_group_id' => 6
        ],
        [
          'title' => 'Максимальный ток',
          'sort' => 1,
        ],
        [
          'title' => 'Ia/In',
          'sort' => 1,
        ],
        [
          'title' => 'Температура',
          'sort' => 1,
        ],
        [
          'title' => '100% нагрузка',
          'sort' => 1,
        ],
        [
          'title' => '80% нагрузка',
          'sort' => 1,
        ],
        [
          'title' => '50% нагрузка',
          'sort' => 1,
        ],
        [
          'title' => 'Энергия',
          'sort' => 1,
        ],
        [
          'title' => '2 бара',
          'sort' => 1,
        ],
        [
          'title' => '3 бара',
          'sort' => 1,
        ],
        [
          'title' => '4 бара',
          'sort' => 1,
        ],
        [
          'title' => '6 бара',
          'sort' => 1,
        ],
        [
          'title' => 'Частота 2 бара',
          'sort' => 1,
        ],
        [
          'title' => 'Частота 4 бара',
          'sort' => 1,
        ],
        [
          'title' => 'Частота 6 бара',
          'sort' => 1,
        ],
        [
          'title' => '0.2 бара',
          'sort' => 1,
        ],
        [
          'title' => '0.8 бара',
          'sort' => 1,
        ],
        [
          'title' => 'Цвет мембраны',
          'sort' => 1,
        ],
        [
          'title' => 'Материал',
          'sort' => 1,
        ],
        [
          'title' => 'Минимальная температура',
          'sort' => 1,
        ],
        [
          'title' => 'Максимальная температура',
          'sort' => 1,
        ],
        [
          'title' => 'Частота вибрации',
          'sort' => 1,
        ],
        [
          'title' => 'Амплитуда',
          'sort' => 1,
        ],
        [
          'title' => 'Действие',
          'sort' => 1,
        ],
        [
          'title' => 'Производительность',
          'sort' => 1,
        ],
        [
          'title' => 'Центробежная сила',
          'sort' => 1,
        ],
        [
          'title' => 'Длина вала',
          'sort' => 1,
        ],
        [
          'title' => 'Вес вала',
          'sort' => 1,
        ],
        [
          'title' => 'Диаметр иглы',
          'sort' => 1,
        ],
        [
          'title' => 'Длина иглы',
          'sort' => 1,
        ],
        [
          'title' => 'Вес иглы',
          'sort' => 1,
        ],
        [
          'title' => 'Рабочее давление',
          'sort' => 1,
        ],
        [
          'title' => 'Макс. давление',
          'sort' => 1,
        ],
        [
          'title' => 'Статический момент',
          'sort' => 1,
        ],
        [
          'title' => '3000 гц',
          'sort' => 1,
        ],
        [
          'title' => '6000 гц',
          'sort' => 1,
        ],
      ]);
      DB::table('attributes')->insert([
        [
          'title' => 'Вес',
          'url_key' => 'Ves',
          'attribute_type_id' => 4,
          'attribute_unit_id' => 1,
          'attribute_group_id' => 1
        ],
        [
          'title' => 'Вынуждающая сила',
          'url_key' => 'vinugdaushaia-power',
          'attribute_type_id' => 4,
          'attribute_unit_id' => 3,
          'attribute_group_id' => 1
        ],
        [
          'title' => 'Статический момент',
          'url_key' => 'static-moment',
          'attribute_type_id' => 4,
          'attribute_unit_id' => 4,
          'attribute_group_id' => 1
        ],
        [
          'title' => 'Потребляемая мощность',
          'url_key' => 'potreb-power',
          'attribute_type_id' => 4,
          'attribute_unit_id' => 5,
          'attribute_group_id' => 1
        ],
        [
          'title' => 'Номинальный ток',
          'url_key' => 'nominal-tok',
          'attribute_type_id' => 4,
          'attribute_unit_id' => 6,
          'attribute_group_id' => 1
        ],
        [
          'title' => 'Размер A',
          'url_key' => 'razmer-a',
          'attribute_type_id' => 3,
          'attribute_unit_id' => 7,
          'attribute_group_id' => 2
        ],
        [
          'title' => 'Размер B',
          'url_key' => 'razmer-b',
          'attribute_type_id' => 3,
          'attribute_unit_id' => 7,
          'attribute_group_id' => 2
        ],
        [
          'title' => 'Размер C',
          'url_key' => 'razmer-c',
          'attribute_type_id' => 3,
          'attribute_unit_id' => 7,
          'attribute_group_id' => 2
        ],
        [
          'title' => 'Размер D',
          'url_key' => 'razmer-d',
          'attribute_type_id' => 3,
          'attribute_unit_id' => 7,
          'attribute_group_id' => 2
        ],
        [
          'title' => 'Размер E',
          'url_key' => 'razmer-e',
          'attribute_type_id' => 3,
          'attribute_unit_id' => 7,
          'attribute_group_id' => 2
        ],
        [
          'title' => 'Размер F',
          'url_key' => 'razmer-f',
          'attribute_type_id' => 3,
          'attribute_unit_id' => 7,
          'attribute_group_id' => 2
        ],
        [
          'title' => 'Срок годности',
          'url_key' => 'sroc-godnosti',
          'attribute_type_id' => 5,
          'attribute_unit_id' => 8,
          'attribute_group_id' => 1
        ],
        [
          'title' => 'Стоимость годового обслуживания',
          'url_key' => 'pay-year-obslugivanie',
          'attribute_type_id' => 7,
          'attribute_unit_id' => 9,
          'attribute_group_id' => 1
        ],
        /*[
          'title' => 'Форсированный',
          'url_key' => 'forcing',
          'attribute_type_id' => 1,
          'attribute_group_id' => 1
        ],*/
      ]);
        // $this->call("OthersTableSeeder");
    }
}
