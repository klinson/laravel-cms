<?php

use Illuminate\Database\Seeder;

class AdminMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_menu')->delete();
        
        \DB::table('admin_menu')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => 0,
                'order' => 1,
                'title' => '管理平台',
                'icon' => 'fa-dashboard',
                'uri' => '/',
                'created_at' => '2017-11-04 11:15:46',
                'updated_at' => '2018-11-04 11:15:46',
                'permission' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => 3,
                'order' => 17,
                'title' => '用户管理',
                'icon' => 'fa-users',
                'uri' => 'users',
                'created_at' => '2017-11-04 11:15:46',
                'updated_at' => '2018-11-27 16:33:06',
                'permission' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => 0,
                'order' => 8,
                'title' => '系统管理',
                'icon' => 'fa-tasks',
                'uri' => '',
                'created_at' => '2017-11-04 11:15:46',
                'updated_at' => '2018-11-27 16:33:06',
                'permission' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => 3,
                'order' => 9,
                'title' => '管理员管理',
                'icon' => 'fa-users',
                'uri' => 'auth/users',
                'created_at' => '2017-11-04 11:15:46',
                'updated_at' => '2018-11-27 16:33:06',
                'permission' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => 3,
                'order' => 11,
                'title' => '管理员角色管理',
                'icon' => 'fa-user',
                'uri' => 'auth/roles',
                'created_at' => '2017-11-04 11:15:46',
                'updated_at' => '2018-11-27 16:33:06',
                'permission' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'parent_id' => 3,
                'order' => 12,
                'title' => '管理员角色权限管理',
                'icon' => 'fa-ban',
                'uri' => 'auth/permissions',
                'created_at' => '2017-11-04 11:15:46',
                'updated_at' => '2018-11-27 16:33:06',
                'permission' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'parent_id' => 3,
                'order' => 13,
                'title' => '系统菜单管理',
                'icon' => 'fa-bars',
                'uri' => 'auth/menu',
                'created_at' => '2017-11-04 11:15:46',
                'updated_at' => '2018-11-27 16:33:06',
                'permission' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'parent_id' => 3,
                'order' => 16,
                'title' => '系统操作日志',
                'icon' => 'fa-history',
                'uri' => 'auth/logs',
                'created_at' => '2017-11-04 11:15:46',
                'updated_at' => '2018-11-27 16:33:06',
                'permission' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'parent_id' => 0,
                'order' => 2,
                'title' => '内容管理',
                'icon' => 'fa-copy',
                'uri' => '',
                'created_at' => '2017-11-04 11:15:46',
                'updated_at' => '2018-11-04 10:48:11',
                'permission' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'parent_id' => 9,
                'order' => 3,
                'title' => '分类管理',
                'icon' => 'fa-cubes',
                'uri' => 'categories',
                'created_at' => '2017-11-04 11:15:46',
                'updated_at' => '2018-11-04 11:13:52',
                'permission' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'parent_id' => 9,
                'order' => 4,
                'title' => '文章管理',
                'icon' => 'fa-file-text',
                'uri' => 'articles',
                'created_at' => '2017-11-04 11:15:46',
                'updated_at' => '2018-11-04 11:15:34',
                'permission' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'parent_id' => 3,
                'order' => 14,
                'title' => '资源管理',
                'icon' => 'fa-file',
                'uri' => 'media',
                'created_at' => '2017-11-04 11:15:46',
                'updated_at' => '2018-11-27 16:33:06',
                'permission' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'parent_id' => 3,
                'order' => 10,
                'title' => '系统配置管理',
                'icon' => 'fa-toggle-on',
                'uri' => 'config',
                'created_at' => '2017-11-04 11:15:46',
                'updated_at' => '2018-11-27 16:33:06',
                'permission' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'parent_id' => 3,
                'order' => 15,
                'title' => '备份管理',
                'icon' => 'fa-copy',
                'uri' => 'backup',
                'created_at' => '2017-11-04 11:15:46',
                'updated_at' => '2018-11-27 16:33:06',
                'permission' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'parent_id' => 0,
                'order' => 5,
                'title' => '联系我们',
                'icon' => 'fa-commenting-o',
                'uri' => 'messages',
                'created_at' => '2018-11-04 10:48:57',
                'updated_at' => '2018-11-04 10:49:43',
                'permission' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'parent_id' => 0,
                'order' => 6,
                'title' => '微信管理',
                'icon' => 'fa-wechat',
                'uri' => 'wechat',
                'created_at' => '2018-11-27 16:19:08',
                'updated_at' => '2018-11-27 16:33:06',
                'permission' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'parent_id' => 16,
                'order' => 7,
                'title' => '菜单设置',
                'icon' => 'fa-bars',
                'uri' => 'wechat/menus',
                'created_at' => '2018-11-27 16:33:01',
                'updated_at' => '2018-11-27 16:33:06',
                'permission' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'parent_id' => 16,
                'order' => 0,
                'title' => '推文素材管理',
                'icon' => 'fa-file-text-o',
                'uri' => 'wechat/articles',
                'created_at' => '2018-11-29 17:02:25',
                'updated_at' => '2018-11-29 17:02:25',
                'permission' => NULL,
            ),
        ));
        
        
    }
}