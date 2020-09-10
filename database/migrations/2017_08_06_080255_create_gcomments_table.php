<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGcommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gcomments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('commentable_type');
            $table->integer('commentable_id')->unsigned();
            $table->text('content');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('gcomments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gcomments', function(Blueprint $table) {
            $table->dropForeign('gcomments_parent_id_foreign');
            $table->dropForeign('gcomments_user_id_foreign');
        });
        Schema::dropIfExists('gcomments');
    }
}
