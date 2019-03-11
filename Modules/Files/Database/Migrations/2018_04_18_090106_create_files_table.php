<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
          $table->engine = 'InnoDB';
          $table->increments('id');
          $table->integer('fileable_id')->unsigned()->nullable();
          $table->string('fileable_type',255)->nullable();
          $table->string('original_name',255)->nullable();
          $table->integer('type_file_id')->unsigned();
          $table->json('config');
          $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
          $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
          $table->foreign('type_file_id')->references('id')->on('type_files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('files', function (Blueprint $table) {
        $table->dropForeign('files_type_file_id_foreign');
      });
      Schema::dropIfExists('files');
    }
}
