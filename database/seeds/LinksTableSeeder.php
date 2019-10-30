<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('links')->delete();
        
        \DB::table('links')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'index_nav',
                'title' => '顶部导航',
                'has_enabled' => 1,
                'created_at' => '2019-09-18 15:28:29',
                'updated_at' => '2019-09-18 15:28:29',
                'deleted_at' => NULL,
            ),
        ));

        \DB::table('link_items')->delete();

        \DB::table('link_items')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'parent_id' => 0,
                    'sort' => 1,
                    'link_id' => 1,
                    'item_title' => '作品展示',
                    'url' => '/categories/2',
                    'target' => '_self',
                ),
            1 =>
                array (
                    'id' => 2,
                    'parent_id' => 0,
                    'sort' => 2,
                    'link_id' => 1,
                    'item_title' => '技术教程',
                    'url' => '/categories/1',
                    'target' => '_self',
                ),
            2 =>
                array (
                    'id' => 3,
                    'parent_id' => 0,
                    'sort' => 3,
                    'link_id' => 1,
                    'item_title' => '关于我们',
                    'url' => '/contactUs',
                    'target' => '_self',
                ),
        ));
        
        
    }
}