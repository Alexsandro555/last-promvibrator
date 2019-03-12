<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkusTable extends Migration
{
  private $tableName = 'skus';
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create($this->tableName, function (Blueprint $table) {
      $table->increments('id')->comment('Иденетфикатор');
      $table->unsignedInteger('product_id')->comment('Продукт');
      $table->string('sku')->unique()->comment('SKU');
      $table->decimal('price',10,2)->nullable()->comment('Цена');
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
      $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
      $table->dropForeign('skus_product_id_foreign');
    });
    Schema::dropIfExists($this->tableName);
  }
}
