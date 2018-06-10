<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletesToSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->softDeletes();
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
