<?php

use Illuminate\Database\Seeder;

class WechatMenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('wechat_menus')->delete();
        \DB::table('wechat_menus')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => 0,
                'sort' => 1,
                'name' => 'click',
                'type' => 'click',
                'value' => 'click_1',
            ),
            1 => 
            array (
                'id' => 3,
                'parent_id' => 0,
                'sort' => 1,
                'name' => 'menus',
                'type' => 'menus',
                'value' => '',
            ),
            2 => 
            array (
                'id' => 4,
                'parent_id' => 3,
                'sort' => 1,
                'name' => 'sub_view',
                'type' => 'view',
                'value' => 'https://www.klinson.com/',
            ),
            3 => 
            array (
                'id' => 5,
                'parent_id' => 3,
                'sort' => 1,
                'name' => 'sub_click',
                'type' => 'click',
                'value' => 'click_2',
            ),
            4 => 
            array (
                'id' => 6,
                'parent_id' => 0,
                'sort' => 0,
                'name' => '菜单1',
                'type' => 'menus',
                'value' => NULL,
            ),
            5 => 
            array (
                'id' => 8,
                'parent_id' => 6,
                'sort' => 0,
                'name' => '扫一扫',
                'type' => 'scancode_push',
                'value' => 'click_4',
            ),
            6 => 
            array (
                'id' => 14,
                'parent_id' => 6,
                'sort' => 0,
                'name' => '扫一扫等待',
                'type' => 'scancode_waitmsg',
                'value' => 'click_5',
            ),
            7 => 
            array (
                'id' => 16,
                'parent_id' => 6,
                'sort' => 0,
                'name' => '拍照',
                'type' => 'pic_sysphoto',
                'value' => 'click_6',
            ),
            8 => 
            array (
                'id' => 18,
                'parent_id' => 6,
                'sort' => 0,
                'name' => '拍照或选择图片',
                'type' => 'pic_photo_or_album',
                'value' => 'click_8',
            ),
            9 => 
            array (
                'id' => 20,
                'parent_id' => 6,
                'sort' => 0,
                'name' => '选择图片',
                'type' => 'pic_weixin',
                'value' => 'click_7',
            ),
            10 => 
            array (
                'id' => 22,
                'parent_id' => 3,
                'sort' => 0,
                'name' => '地址',
                'type' => 'location_select',
                'value' => 'click_3',
            ),
        ));
        
        
    }
}