<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ProductDatabaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Model::unguard();
    $this->call(AttributeTableSeeder::class);
    /*$this->call(TnvedTableSeeder::class);
    $this->call(ProducerTableSeeder::class);
    $this->call(ProductCategoryTableSeeder::class);
    $this->call(TypeProductTableSeeder::class);
    $this->call(LineProductTableSeeder::class);
    $this->call(AttributeTypeTableSeeder::class);
    $this->call(AttributeUnitTableSeeder::class);
    $this->call(AttributeGroupTableSeeder::class);
    $this->call(VibratorsTableSeeder::class);*/
  }
}
