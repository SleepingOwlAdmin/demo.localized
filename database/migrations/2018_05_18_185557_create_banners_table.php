<?php

use App\Models\Banner;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $banner = new Banner;

            $table->increments('id');
            $table->text('link');
            $table->string('image');
            $table->string('color', 7)->default($banner->defaultColor());
            $table->enum('alignment', $banner->alignments())->default(Banner::ALIGN_LEFT);

            $table->unsignedInteger('icon_id')->nullable();
            $table->foreign('icon_id')->references('id')->on('banner_icons');

            $table->boolean('is_draft')->default(false);

            $table->timestamps();
        });

        Schema::create('banner_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('banner_id');
            $table->string('locale')->index();

            $table->text('text');

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
        Schema::dropIfExists('banners');
    }
}
