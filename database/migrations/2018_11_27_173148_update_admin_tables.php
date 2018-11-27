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


        Schema::connection($connection)->table(config('admin.database.menu_table'), function (Blueprint $table) {
            $table->string('permission')->nullable();
        });


        Schema::connection($connection)->table(config('admin.database.operation_log_table'), function (Blueprint $table) {
            $table->string('ip')->change();
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

        Schema::connection($connection)->table(config('admin.database.menu_table'), function (Blueprint $table) {
            $table->dropColumn('permission');
        });

        Schema::connection($connection)->table(config('admin.database.operation_log_table'), function (Blueprint $table) {
            $table->dropColumn('ip', 15)->change();
        });
    }
}
