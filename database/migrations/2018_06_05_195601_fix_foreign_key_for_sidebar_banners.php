<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixForeignKeyForSidebarBanners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sidebar_banner_translations', function (Blueprint $table) {
            $table->dropForeign(['banner_id']);
        });

        Schema::table('sidebar_banner_translations', function (Blueprint $table) {
            $table->foreign('banner_id')->references('id')->on('sidebar_banners')->onDelete('cascade');
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
