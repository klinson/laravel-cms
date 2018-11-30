<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default('')->comment('消息类型');
            $table->string('wechat_message_id')->default('');
            $table->string('content', 2048)->nullable()->comment('消息内容');
            $table->text('full_content')->nullable()->comment('消息内容');
            $table->string('from')->default('')->comment('来自用户openid');
            $table->text('from_info')->nullable()->comment('来自用户基本信息');
            $table->string('to')->default('')->comment('发给公众号账号');
            $table->timestamp('received_at')->nullable()->comment('收到时间');
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
        Schema::dropIfExists('wechat_messages');
    }
}
