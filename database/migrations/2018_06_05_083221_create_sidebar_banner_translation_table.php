<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSidebarBannerTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sidebar_banners', function (Blueprint $table) {
            $table->dropColumn('link');
        });
        Schema::table('sidebar_banners', function (Blueprint $table) {
            $table->dropColumn('image');
        });

        Schema::create('sidebar_banner_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('banner_id');
            $table->string('locale')->index();

            $table->string('image');
            $table->text('link');

            $table->unique(['banner_id', 'locale']);
            $table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sidebar_banner_translations');
    }
}
