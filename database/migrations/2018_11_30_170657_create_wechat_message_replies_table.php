<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatMessageRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_message_replies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wechat_message_id');
            $table->string('from');
            $table->string('to');
            $table->string('content');
            $table->tinyInteger('is_success')->default(0);
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wechat_message_replies');
    }
}
