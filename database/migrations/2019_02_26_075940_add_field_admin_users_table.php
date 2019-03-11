<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldAdminUsersTable extends Migration
{
  private $tableName = 'users';
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table($this->tableName, function(Blueprint $table) {
      $table->boolean('admin')->default(false)->nullable()->comment('Права администратора');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table($this->tableName, function(Blueprint $table) {
      $table->dropColumn('admin');
    });
  }
}
