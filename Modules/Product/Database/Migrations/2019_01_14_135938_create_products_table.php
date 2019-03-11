<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
  private $tableName = 'products';

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create($this->tableName, function (Blueprint $table) {
      $table->increments('id')->comment('Идентефикатор');
      $table->integer('remote_id')->nullable();
      $table->string('title', 255)->comment('Название продукта');
      $table->string('url_key', 255)->comment('url');
      $table->decimal('price',10,2)->nullable()->comment('Цена');
      $table->text('description')->nullable()->comment('Описание');
      $table->integer('qty')->nullable()->comment('Количество');
      $table->boolean('active')->default(false)->nullable()->comment('Актив.');
      $table->integer('sort')->nullable()->comment('Сорт.');
      $table->boolean('onsale')->nullable()->comment('Скидка');
      $table->boolean('special')->nullable()->comment('Спецпредложение');
      $table->boolean('need_order')->nullable()->comment('Необходимо заказывать');
      $table->integer('product_category_id')->unsigned()->nullable()->comment('Категория продукта');
      $table->integer('type_product_id')->unsigned()->nullable()->comment('Тип продукта');
      $table->integer('line_product_id')->unsigned()->nullable()->comment('Линейка продукции');
      $table->string('vendor')->nullable()->comment('Артикул');
      $table->string('IEC')->nullable()->comment('IEC');
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
      $table->softDeletes();
      $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
      $table->foreign('type_product_id')->references('id')->on('type_products')->onDelete('cascade');
      $table->foreign('line_product_id')->references('id')->on('line_products')->onDelete('cascade');
    });

    DB::statement("ALTER TABLE `$this->tableName` comment 'Продукция'");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table($this->tableName, function (Blueprint $table) {
      $table->dropForeign('products_type_product_id_foreign');
      $table->dropForeign('products_line_product_id_foreign');
      $table->dropForeign('products_product_category_id_foreign');
    });
    Schema::dropIfExists($this->tableName);
  }
}
