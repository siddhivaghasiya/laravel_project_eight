<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestDbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_db', function (Blueprint $table) {
            $table->id();
            $table->integer('language_id')->default(1);
            $table->integer('media_type')->comment('1:Image;2:Doc,3:Video')->nullable();
            $table->string('title', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->integer('serial_number')->default(0);
            $table->string('main_image', 255)->nullable();
            $table->text('videoUrl')->nullable();
            $table->tinyInteger('is_thum')->nullable();
            $table->tinyInteger('is_video')->nullable();
            $table->text('keyword')->nullable();
            $table->text('description')->nullable();
            $table->string('document_file')->nullable();
            $table->string('audio_file')->nullable();
            $table->string('audio_thumb')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_db');
    }
}
