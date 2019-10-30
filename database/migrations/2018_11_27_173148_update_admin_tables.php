<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateAdminTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('admin.database.connection') ?: config('database.default');


        Schema::connection($connection)->table('admin_config', function (Blueprint $table) {
            $table->string('description')->nullable()->change();
            $table->text('value')->change();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        Schema::connection($connection)->table('admin_config', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
            $table->string('value')->change();
        });

    }
}
