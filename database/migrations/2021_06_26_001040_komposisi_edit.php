<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KomposisiEdit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('komposisis', function (Blueprint $table) {
            $table->dropForeign('komposisis_menu_id_foreign');
            $table->dropColumn('menu_id');
        });
        Schema::table('komposisis', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained()->ondelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
