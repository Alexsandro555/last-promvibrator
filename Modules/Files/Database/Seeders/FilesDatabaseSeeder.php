<?php

namespace Modules\Files\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class FilesDatabaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Model::unguard();
    $this->call("Modules\Files\Database\Seeders\TypeFileTableSeeder");
    // $this->call("OthersTableSeeder");
  }
}
