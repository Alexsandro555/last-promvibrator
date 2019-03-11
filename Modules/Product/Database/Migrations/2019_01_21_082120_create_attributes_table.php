<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration
{
  private $tableName = "attributes";

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
      $table->unsignedInteger('sort')->nullable()->comment('Сорт.');
      $table->string('title', 255)->comment('Наименование');
      $table->string('url_key', 255)->comment('Псевдоним eng');
      $table->boolean('active')->default(true)->nullable()->comment('Актив.');
      $table->unsignedInteger('attribute_type_id')->nullable()->comment('Тип');
      $table->unsignedInteger('attribute_group_id')->nullable()->comment('Группа атрибута');
      $table->unsignedInteger('attribute_unit_id')->nullable()->comment('Еденица измерения атрибута');
      $table->foreign('attribute_group_id')->references('id')->on('attribute_groups')->onDelete('cascade');
      $table->foreign('attribute_unit_id')->references('id')->on('attribute_units')->onDelete('cascade');
      $table->foreign('attribute_type_id')->references('id')->on('attribute_types')->onDelete('cascade');
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
      $table->softDeletes();
    });

    DB::statement("ALTER TABLE `$this->tableName` comment 'Атрибуты'");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table($this->tableName, function (Blueprint $table) {
      $table->dropForeign('attributes_attribute_group_id_foreign');
      $table->dropForeign('attributes_attribute_unit_id_foreign');
      $table->dropForeign('attributes_attribute_type_id_foreign');
    });
    Schema::dropIfExists($this->tableName);
  }
}
