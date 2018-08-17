<?php

use Illuminate\Database\Seeder;
use App\Models\Article;
class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::truncate();
        Article::insert([
            [
                'title' => '关于我们',
                'content' => '<h1>关于我们</h1>',
                'thumbnail' => 'http://jwc.dgut.edu.cn/dglgjwc/tpxw/2017-11/14/e87ca099a50140c88859fec297fd18bf/images/e1978942eb44412bac37d2c98228fcb2.png',
                'author' => 'klinson',
            ],
            [
                'title' => 'PHP哦',
                'content' => '<h1>PHP哦</h1>',
                'thumbnail' => 'http://jwc.dgut.edu.cn/dglgjwc/tpxw/2017-11/14/e87ca099a50140c88859fec297fd18bf/images/e1978942eb44412bac37d2c98228fcb2.png',
                'author' => 'klinson',
            ],
            [
                'title' => 'Python哦',
                'content' => '<h1>Python哦</h1>',
                'thumbnail' => 'http://jwc.dgut.edu.cn/dglgjwc/tpxw/2017-11/14/e87ca099a50140c88859fec297fd18bf/images/e1978942eb44412bac37d2c98228fcb2.png',
                'author' => 'klinson',
            ],
            [
                'title' => '资讯1',
                'content' => '<h1>资讯1</h1>',
                'thumbnail' => 'http://jwc.dgut.edu.cn/dglgjwc/tpxw/2017-11/14/e87ca099a50140c88859fec297fd18bf/images/e1978942eb44412bac37d2c98228fcb2.png',
                'author' => 'klinson',
            ],
            [
                'title' => '资讯2',
                'content' => '<h1>资讯2</h1>',
                'thumbnail' => 'http://jwc.dgut.edu.cn/dglgjwc/tpxw/2017-11/14/e87ca099a50140c88859fec297fd18bf/images/e1978942eb44412bac37d2c98228fcb2.png',
                'author' => 'klinson',
            ]
        ]);

        \DB::table('category_has_articles')->insert([
            [
                'category_id' => 3,
                'article_id'  => 1,
            ],
            [
                'category_id' => 2,
                'article_id'  => 4,
            ],
            [
                'category_id' => 2,
                'article_id'  => 5,
            ],
            [
                'category_id' => 4,
                'article_id'  => 2,
            ],
            [
                'category_id' => 5,
                'article_id'  => 3,
            ],
        ]);
    }
}
