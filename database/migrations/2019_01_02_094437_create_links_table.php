<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->string('title');
            $table->tinyInteger('has_enabled')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('link_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->default(0);
            $table->unsignedInteger('sort')->default(0);
            $table->unsignedInteger('link_id')->default(0);
            $table->string('item_title')->nullable();
            $table->string('url')->nullable();
            $table->string('target')->nullable();
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
