<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('')->comment('分类标题');
            $table->unsignedInteger('parent_id')->default(0)->comment('父级id');
            $table->string('icon', 50)->nullable()->comment('icon');
            $table->string('thumbnail')->nullable()->comment('缩略图');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->tinyInteger('is_page')->default(0)->comment('是否是单页分类');
            $table->tinyInteger('is_top')->default(0)->comment('是否置顶');
            $table->unsignedInteger('page_article_id')->default(0)->comment('页面显示新闻');
            $table->string('description')->nullable()->comment('描述');
            $table->timestamps();
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
        Schema::dropIfExists('categories');
    }
}
