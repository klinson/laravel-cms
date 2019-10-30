<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminTablesSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ArticleTableSeeder::class);
        $this->call(AdminMenuTableSeeder::class);
        $this->call(AdminConfigTableSeeder::class);
        $this->call(WechatMenusTableSeeder::class);
        $this->call(LinksTableSeeder::class);
    }
}
