<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 50)->comment('账号');
            $table->string('name', 50)->comment('姓名');
            $table->string('nickname', 100)->default('')->comment('你猜');
            $table->tinyInteger('sex')->default(1)->comment('性别: 1-男, 0-女');
            $table->string('email')->default('')->comment('邮箱');
            $table->string('password');
            $table->string('mobile', 20)->default('')->comment('手机');
            $table->tinyInteger('has_enabled')->default(1)->comment('是否启用');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
