<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        Category::insert([
            [
                'parent_id' => 0,
                'sort'     => 1,
                'title'     => '技术教程',
                'icon'      => 'fa-bar-chart',
                'is_page'   => 0,
            ],
            [
                'parent_id' => 0,
                'sort'     => 1,
                'title'     => '技术资讯',
                'icon'      => 'fa-users',
                'is_page'   => 0,
            ],
            [
                'parent_id' => 0,
                'sort'     => 2,
                'title'     => '关于我们',
                'icon'      => 'fa-tasks',
                'is_page'   => 1,
            ],
            [
                'parent_id' => 1,
                'sort'     => 3,
                'title'     => 'PHP',
                'icon'      => 'fa-users',
                'is_page'   => 0,
            ],
            [
                'parent_id' => 1,
                'sort'     => 0,
                'title'     => 'Python',
                'icon'      => 'fa-user',
                'is_page'   => 0,
            ],
            [
                'parent_id' => 1,
                'sort'     => 5,
                'title'     => 'go',
                'icon'      => 'fa-ban',
                'is_page'   => 0,
            ]
        ]);
    }
}
