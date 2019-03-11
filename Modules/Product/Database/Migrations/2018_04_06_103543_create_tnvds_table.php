<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTnvdsTable extends Migration
{
  private $tableName = 'tnveds';

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create($this->tableName, function (Blueprint $table) {
      $table->bigInteger('id')->comment('Код');
      $table->unsignedInteger('remote_id')->nullable();
      $table->string('title', 255)->comment('Наименование');
      $table->boolean('active')->default(true)->comment('Актив.');
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
      $table->softDeletes();
    });
    DB::statement("ALTER TABLE `$this->tableName` comment 'ТНВЭД'");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists($this->tableName);
  }
}
