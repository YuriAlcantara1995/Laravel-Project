<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThumbnailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thumbnails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('image_id')->nullable();
            $table->foreign('image_id')
            ->references('id')
            ->on('images')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->string('file_path');
            $table->timestamps();
        });

        Schema::table('images', function (Blueprint $table) {
            $table->unsignedBigInteger('thumbnail_id')->nullable();
            $table->foreign('thumbnail_id')
            ->references('id')
            ->on('thumbnails')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thumbnails');
    }
}
