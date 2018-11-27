<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class WechatMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\WechatMenu::truncate();
        \App\Models\WechatMenu::insert([
            [
                'id' => 1,
                'parent_id' => 0,
                'sort'     => 1,
                'name'     => 'click',
                'type'      => 'click',
                'value' => 'click_1'
            ],
            [
                'id' => 2,
                'parent_id' => 0,
                'sort'     => 1,
                'name'     => 'view',
                'type'      => 'view',
                'value' => 'https://www.klinson.com/'
            ],
            [
                'id' => 3,
                'parent_id' => 0,
                'sort'     => 1,
                'name'     => 'menus',
                'type'      => 'menus',
                'value' => ''
            ],
            [
                'id' => 4,
                'parent_id' => 3,
                'sort'     => 1,
                'name'     => 'sub_view',
                'type'      => 'view',
                'value' => 'https://www.baidu.com/'
            ],
            [
                'id' => 5,
                'parent_id' => 3,
                'sort'     => 1,
                'name'     => 'sub_click',
                'type'      => 'click',
                'value' => 'click_2'
            ],
        ]);
    }
}
