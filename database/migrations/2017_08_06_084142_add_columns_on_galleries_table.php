<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsOnGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->boolean('notification')->default(1);
            $table->tinyInteger('view_count')->default(0);

            if (config('database.default')== 'mysql') {
                DB::statement('ALTER TABLE galleries ADD FULLTEXT search(title, content)');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn(['notification', 'view_count']);
        });
    }
}
