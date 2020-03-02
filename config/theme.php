<?php

return [
    'default' => env('DEFAULT_THEME', 'default'),

    'themes' => [
        'default' => [
            'view_root_path' => 'home.default',
            'style_root_path' => 'theme/default',
            'system_name' => 'Klinson',
            'default_title' => 'Cms',
            'description' => 'klinson个人主页cms',
            'keyword' => 'klinson,cms,个人主页',
            'author' => 'klinson',
            'author_link' => 'http://klinson.com',
            'default_article_thumbnail' => 'theme/default/images/default_article_thumbnail.png',
            'default_category_thumbnail' => 'theme/default/images/default_category_thumbnail.png',
        ],
        'icp' => [
            'view_root_path' => 'home.icp',
            'style_root_path' => 'theme/default',
            'system_name' => '生活小情调',
            'default_title' => '生活小情调',
            'description' => 'klinson个人主页cms',
            'keyword' => 'klinson,cms,个人主页',
            'author' => 'klinson',
            'author_link' => 'http://klinson.com',
            'default_article_thumbnail' => 'theme/default/images/default_article_thumbnail.png',
            'default_category_thumbnail' => 'theme/default/images/default_category_thumbnail.png',
        ],
        'video' => [
            'view_root_path' => 'home.video',
            'style_root_path' => 'theme/video',
            'system_name' => '视频资讯',
            'default_title' => '视频资讯',
            'description' => '视频资讯',
            'keyword' => 'klinson,cms,视频资讯',
            'author' => 'klinson',
            'author_link' => 'http://klinson.com',
            'default_article_thumbnail' => 'theme/default/images/default_article_thumbnail.png',
            'default_category_thumbnail' => 'theme/default/images/default_category_thumbnail.png',
        ],

    ]
];
