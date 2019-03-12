<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldOldIdProductTable extends Migration
{
  private $tableName = 'products';

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table($this->tableName, function (Blueprint $table) {
      $table->unsignedInteger('old_id')->comment('Старый идентефикатор');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table($this->tableName, function (Blueprint $table) {
      $table->dropColumn('old_id');
    });
  }
}
