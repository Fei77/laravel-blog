<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('preview_filename')->nullable();
            $table->string('original_filename')->nullable();
            $table->string('mime_type');
            $table->string('key')->nullable();
            $table->string('alt_text')->nullable();
            $table->string('title')->nullable();
            $table->integer('order')->nullable();
            $table->nullableMorphs('mediable');

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
        Schema::dropIfExists('media');
    }
}
