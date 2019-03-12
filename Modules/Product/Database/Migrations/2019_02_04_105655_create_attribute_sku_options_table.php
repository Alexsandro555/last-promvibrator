<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeSkuOptionsTable extends Migration
{
  private $tableName = 'attribute_sku_options';
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create($this->tableName, function (Blueprint $table) {
      $table->increments('id')->comment('Иденетфикатор');
      $table->unsignedInteger('sku_id')->comment('SKU');
      $table->unsignedInteger('attribute_id')->comment('Атрибут');
      $table->unsignedInteger('attribute_list_value_id')->comment('Значение');
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
      $table->foreign('sku_id')->references('id')->on('skus')->onDelete('cascade');
      $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
      $table->foreign('attribute_list_value_id')->references('id')->on('attribute_list_values')->onDelete('cascade');
      $table->softDeletes();
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
      $table->dropForeign('attribute_sku_options_sku_id_foreign');
      $table->dropForeign('attribute_sku_options_attribute_id_foreign');
      $table->dropForeign('attribute_sku_options_attribute_list_value_id_foreign');
    });
    Schema::dropIfExists($this->tableName);
  }
}
