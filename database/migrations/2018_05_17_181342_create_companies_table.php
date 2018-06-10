<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('type_id')->index();
            $table->foreign('type_id')->references('id')->on('company_types');
            $table->string('logo')->nullable();

            $table->string('email')->unique();
            $table->string('phone', 32)->unique();
            $table->string('login', 32)->unique();

            $table->string('password');
            $table->boolean('verified')->default(false);
            $table->rememberToken();
            $table->boolean('receive_newsletters')->default(false);

            $table->timestamps();
        });

        Schema::create('company_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id');
            $table->string('locale')->index();

            $table->string('name');
            $table->text('description')->nullable();
            $table->text('text')->nullable();
            $table->text('contacts')->nullable();

            $table->unique(['company_id', 'locale']);
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
