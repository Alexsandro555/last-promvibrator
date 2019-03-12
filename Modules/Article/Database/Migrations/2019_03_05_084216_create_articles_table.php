<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
  private $tableName = 'articles';

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create($this->tableName, function (Blueprint $table) {
      $table->increments('id')->comment('Идентефикатор');
      $table->string('title')->nullable()->comment('Наименование');
      $table->string('url_key', 255)->nullable()->comment('Url');
      $table->text('content')->nullable()->comment('Содержимое');
      $table->unsignedInteger('sort')->nullable()->comment('Сорт.');
      $table->boolean('active')->default(true)->comment('Актив.');
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
      $table->softDeletes();
    });

    DB::statement("ALTER TABLE `$this->tableName` comment 'Статьи'");
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
