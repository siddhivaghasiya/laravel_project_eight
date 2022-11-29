<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestDbtwoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_dbtwo', function (Blueprint $table) {
            $table->id();
            $table->integer('language_id')->default(1);
            $table->integer('media_type')->comment('1:Image;2:Doc,3:Video')->nullable();
            $table->string('title', 255)->nullable();
            $table->string('image', 255)->nullable();
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
        Schema::dropIfExists('test_dbtwo');
    }
}
