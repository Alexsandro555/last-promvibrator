<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeProductsTable extends Migration
{
    private $tableName = 'type_products';

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
          $table->unsignedInteger('product_category_id')->nullable()->comment('Категория');
          $table->string('title')->comment('Наименование типа продукта');
          $table->bigInteger('tnved_id')->nullable()->comment('ТНВЭД');
          $table->unsignedInteger('sort')->nullable()->comment('Сорт.');
          $table->boolean('active')->default(true)->comment('Актив.');
          $table->text('description')->nullable()->comment('Описание');
          $table->string('url_key', 255)->comment('Путь');
          $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
          $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
          $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
          $table->softDeletes();
        });

        DB::statement("ALTER TABLE `$this->tableName` comment 'Типы продуктов'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table($this->tableName, function (Blueprint $table) {
        $table->dropForeign('type_products_product_category_id_foreign');
      });
      Schema::dropIfExists($this->tableName);
    }
}
