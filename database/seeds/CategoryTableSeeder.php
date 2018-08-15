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
                'order'     => 1,
                'title'     => '春果',
                'icon'      => 'fa-bar-chart',
            ],
            [
                'parent_id' => 0,
                'order'     => 1,
                'title'     => '夏果',
                'icon'      => 'fa-users',
            ],
            [
                'parent_id' => 0,
                'order'     => 2,
                'title'     => '秋果',
                'icon'      => 'fa-tasks',
            ],
            [
                'parent_id' => 0,
                'order'     => 3,
                'title'     => '冬果',
                'icon'      => 'fa-users',
            ],
            [
                'parent_id' => 1,
                'order'     => 0,
                'title'     => '苹果',
                'icon'      => 'fa-user',
            ],
            [
                'parent_id' => 1,
                'order'     => 5,
                'title'     => '雪梨',
                'icon'      => 'fa-ban',
            ],
            [
                'parent_id' => 2,
                'order'     => 6,
                'title'     => '蟠桃',
                'icon'      => 'fa-bars',
            ],
            [
                'parent_id' => 3,
                'order'     => 7,
                'title'     => '龙眼',
                'icon'      => 'fa-history',
            ],
        ]);
    }
}
