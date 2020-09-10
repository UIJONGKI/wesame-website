<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery__attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gallery_id')->nullable()->unsigned()->index();
            $table->string('filename');
            $table->integer('bytes')->nullable()->unsigned();
            $table->string('mime')->nullable();
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
        Schema::dropIfExists('gallery_attachments');
    }
}
