<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('')->comment('标题');
            $table->text('content')->nullable()->comment('内容');
            $table->string('thumbnail')->nullable()->comment('封面缩略图');
            $table->string('author', 50)->nullable()->comment('作者署名信息');
            $table->unsignedInteger('publish_time')->default(0)->comment('发布时间');
            $table->string('description')->nullable()->comment('描述');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->tinyInteger('is_top')->default(0)->comment('是否置顶');
            $table->unsignedInteger('pv')->default(0)->comment('阅读量');
            $table->tinyInteger('has_enabled')->default(0)->comment('状态');

            $table->unsignedInteger('created_at')->default(0);
            $table->unsignedInteger('updated_at')->default(0);
            $table->unsignedInteger('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
