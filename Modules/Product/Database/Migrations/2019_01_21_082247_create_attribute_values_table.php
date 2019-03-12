<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeValuesTable extends Migration
{
  private $tableName = "attribute_values";
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create($this->tableName, function (Blueprint $table) {
      $table->increments('id')->comment('Идентефикатор');
      $table->unsignedInteger('attribute_id')->length(11)->comment('Атрибут');
      $table->unsignedInteger('product_id')->length(11)->comment('Производитель');
      $table->boolean('boolean_value')->default(false)->nullable()->comment('Значние');
      $table->date('date_value')->nullable()->comment('Значение');
      $table->double('double_value', 10, 4)->nullable()->comment('Значение');
      $table->integer('integer_value')->nullable()->comment('Значение');
      $table->string('string_value')->nullable()->comment('Значение');
      $table->decimal('decimal_value',10,2)->nullable()->comment('Значение');
      $table->text('text_value')->nullable()->comment('Значение');
      $table->unsignedInteger('list_value')->nullable()->comment('Значение');
      $table->timestamps();
      $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
      $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
      $table->softDeletes();
    });

    DB::statement("ALTER TABLE `$this->tableName` comment 'Значения атрибутов'");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table($this->tableName, function (Blueprint $table) {
      $table->dropForeign('attribute_values_attribute_id_foreign');
      $table->dropForeign('attribute_values_product_id_foreign');
    });
    Schema::dropIfExists($this->tableName);
  }
}
