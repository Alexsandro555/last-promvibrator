<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategoriesTable extends Migration
{
  private $tableName = 'product_categories';

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create($this->tableName, function (Blueprint $table) {
      $table->increments('id')->comment('Идентефикатор');
      $table->unsignedInteger('remote_id')->nullable();
      $table->string('title')->comment('Название категории');
      $table->string('url_key', 255)->nullable()->comment('url');
      $table->unsignedInteger('sort')->nullable()->comment('Сорт.');
      $table->boolean('active')->default(true)->comment('Актив.');
      $table->text('description')->nullable()->comment('Описание');
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
      $table->softDeletes();
    });
    DB::statement("ALTER TABLE `$this->tableName` comment 'Категории'");
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
