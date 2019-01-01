<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarouselAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carousel_ads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->string('title');
            $table->tinyInteger('has_enabled')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('carousel_ad_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sort')->default(0);
            $table->unsignedInteger('carousel_ad_id')->default(0);
            $table->string('picture');
            $table->string('item_title')->nullable();
            $table->string('url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carousel_ads');
        Schema::dropIfExists('carousel_ad_items');
    }
}
