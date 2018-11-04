<?php

use Illuminate\Database\Seeder;

class AdminConfigTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_config')->delete();
        
        \DB::table('admin_config')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'contact.owner',
                'value' => 'klinson',
                'description' => '站点拥有者',
                'created_at' => '2018-11-04 11:04:16',
                'updated_at' => '2018-11-04 11:04:16',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'contact.email',
                'value' => 'klinson@163.com',
                'description' => '站点联系人邮箱',
                'created_at' => '2018-11-04 11:04:44',
                'updated_at' => '2018-11-04 11:04:44',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'contact.mobile',
                'value' => '未设置',
                'description' => '站点联系人手机号',
                'created_at' => '2018-11-04 11:07:07',
                'updated_at' => '2018-11-04 11:07:45',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'contact.location',
                'value' => '广东 东莞',
                'description' => '站点联系人地址',
                'created_at' => '2018-11-04 11:07:37',
                'updated_at' => '2018-11-04 11:07:37',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'contact.site_name',
                'value' => 'klinson.com',
                'description' => '站点联系人个人主页站点名',
                'created_at' => '2018-11-04 11:08:23',
                'updated_at' => '2018-11-04 11:08:23',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'contact.site_link',
                'value' => 'https://www.klinson.com',
                'description' => '站点联系人个人主页链接地址',
                'created_at' => '2018-11-04 11:08:58',
                'updated_at' => '2018-11-04 11:09:04',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'contact.qq',
                'value' => '337217685',
                'description' => '站点联系人联系qq',
                'created_at' => '2018-11-04 11:09:29',
                'updated_at' => '2018-11-04 11:09:29',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'contact.weixin',
                'value' => 'hqs940809',
                'description' => '站点联系人联系微信号',
                'created_at' => '2018-11-04 11:09:53',
                'updated_at' => '2018-11-04 11:10:16',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'contact.icp',
                'value' => '粤ICP备18048684号',
                'description' => '站点icp信息',
                'created_at' => '2018-11-04 11:10:49',
                'updated_at' => '2018-11-04 11:10:49',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'contact.notify_email',
                'value' => 'klinson@163.com',
                'description' => '新消息实时通知邮箱',
                'created_at' => '2018-11-04 12:04:30',
                'updated_at' => '2018-11-04 12:04:30',
            ),
        ));
        
        
    }
}