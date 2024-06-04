<?php


use Phinx\Seed\AbstractSeed;

class CategorySeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $categoriesData = [
            [
                'title' => '首页',
                'sort' => 1,
                'meta_title' => '笔趣阁-无弹窗小说网,全文免费阅读',
                'meta_keywords' => '笔趣阁,新笔趣阁,免费全本小说,全本TXT小说,无弹窗小说',
                'meta_description' => '笔趣阁是无弹窗广告的免费小说阅读网站,提供最新完结小说,全本玄幻小说、都市小说、穿越小说、网游小说、武侠仙侠、历史军事、修真同人等全本小说免费阅读,最新完本小说阅读就在笔趣阁',
                'icon' => '',
                'template_index' => '/',
                'template_detail' => '/',
                'template_filter' => '/',
                'status' => 0,
                'type' => 1
            ],
            [
                'title' => '排行榜',
                'sort' => 11,
                'meta_title' => '笔趣阁-无弹窗小说网,全文免费阅读',
                'meta_keywords' => '笔趣阁,新笔趣阁,免费全本小说,全本TXT小说,无弹窗小说',
                'meta_description' => '笔趣阁是无弹窗广告的免费小说阅读网站,提供最新完结小说,全本玄幻小说、都市小说、穿越小说、网游小说、武侠仙侠、历史军事、修真同人等全本小说免费阅读,最新完本小说阅读就在笔趣阁',
                'icon' => '',
                'template_index' => '/novel/top',
                'template_detail' => '',
                'template_filter' => '',
                'status' => 0,
                'type' => 1
            ],
            [
                'title' => '完本',
                'sort' => 10,
                'meta_title' => '笔趣阁-无弹窗小说网,全文免费阅读',
                'meta_keywords' => '笔趣阁,新笔趣阁,免费全本小说,全本TXT小说,无弹窗小说',
                'meta_description' => '笔趣阁是无弹窗广告的免费小说阅读网站,提供最新完结小说,全本玄幻小说、都市小说、穿越小说、网游小说、武侠仙侠、历史军事、修真同人等全本小说免费阅读,最新完本小说阅读就在笔趣阁',
                'icon' => '',
                'template_index' => '/novel/finish',
                'template_detail' => '',
                'template_filter' => '',
                'status' => 0,
                'type' => 1
            ],
            [
                'title' => '女生',
                'sort' => 8,
                'meta_title' => '笔趣阁-无弹窗小说网,全文免费阅读',
                'meta_keywords' => '笔趣阁,新笔趣阁,免费全本小说,全本TXT小说,无弹窗小说',
                'meta_description' => '笔趣阁是无弹窗广告的免费小说阅读网站,提供最新完结小说,全本玄幻小说、都市小说、穿越小说、网游小说、武侠仙侠、历史军事、修真同人等全本小说免费阅读,最新完本小说阅读就在笔趣阁',
                'icon' => '',
                'template_index' => '/novel/category/%d',
                'template_detail' => '',
                'template_filter' => '',
                'status' => 0,
                'type' => 1
            ],
            [
                'title' => '玄幻',
                'sort' => 2,
                'meta_title' => '笔趣阁-无弹窗小说网,全文免费阅读',
                'meta_keywords' => '笔趣阁,新笔趣阁,免费全本小说,全本TXT小说,无弹窗小说',
                'meta_description' => '笔趣阁是无弹窗广告的免费小说阅读网站,提供最新完结小说,全本玄幻小说、都市小说、穿越小说、网游小说、武侠仙侠、历史军事、修真同人等全本小说免费阅读,最新完本小说阅读就在笔趣阁',
                'icon' => '',
                'template_index' => '/novel/category/%d',
                'template_detail' => '',
                'template_filter' => '',
                'status' => 0,
                'type' => 1
            ],
            [
                'title' => '武侠',
                'sort' => 3,
                'meta_title' => '笔趣阁-无弹窗小说网,全文免费阅读',
                'meta_keywords' => '笔趣阁,新笔趣阁,免费全本小说,全本TXT小说,无弹窗小说',
                'meta_description' => '笔趣阁是无弹窗广告的免费小说阅读网站,提供最新完结小说,全本玄幻小说、都市小说、穿越小说、网游小说、武侠仙侠、历史军事、修真同人等全本小说免费阅读,最新完本小说阅读就在笔趣阁',
                'icon' => '',
                'template_index' => '/novel/category/%d',
                'template_detail' => '',
                'template_filter' => '',
                'status' => 0,
                'type' => 1
            ],
            [
                'title' => '都市',
                'sort' => 4,
                'meta_title' => '笔趣阁-无弹窗小说网,全文免费阅读',
                'meta_keywords' => '笔趣阁,新笔趣阁,免费全本小说,全本TXT小说,无弹窗小说',
                'meta_description' => '笔趣阁是无弹窗广告的免费小说阅读网站,提供最新完结小说,全本玄幻小说、都市小说、穿越小说、网游小说、武侠仙侠、历史军事、修真同人等全本小说免费阅读,最新完本小说阅读就在笔趣阁',
                'icon' => '',
                'template_index' => '/novel/category/%d',
                'template_detail' => '',
                'template_filter' => '',
                'status' => 0,
                'type' => 1
            ],
            [
                'title' => '历史',
                'sort' => 5,
                'meta_title' => '笔趣阁-无弹窗小说网,全文免费阅读',
                'meta_keywords' => '笔趣阁,新笔趣阁,免费全本小说,全本TXT小说,无弹窗小说',
                'meta_description' => '笔趣阁是无弹窗广告的免费小说阅读网站,提供最新完结小说,全本玄幻小说、都市小说、穿越小说、网游小说、武侠仙侠、历史军事、修真同人等全本小说免费阅读,最新完本小说阅读就在笔趣阁',
                'icon' => '',
                'template_index' => '/novel/category/%d',
                'template_detail' => '',
                'template_filter' => '',
                'status' => 0,
                'type' => 1
            ],
            [
                'title' => '网游',
                'sort' => 6,
                'meta_title' => '笔趣阁-无弹窗小说网,全文免费阅读',
                'meta_keywords' => '笔趣阁,新笔趣阁,免费全本小说,全本TXT小说,无弹窗小说',
                'meta_description' => '笔趣阁是无弹窗广告的免费小说阅读网站,提供最新完结小说,全本玄幻小说、都市小说、穿越小说、网游小说、武侠仙侠、历史军事、修真同人等全本小说免费阅读,最新完本小说阅读就在笔趣阁',
                'icon' => '',
                'template_index' => '/novel/category/%d',
                'template_detail' => '',
                'template_filter' => '',
                'status' => 0,
                'type' => 1
            ],
            [
                'title' => '科幻',
                'sort' => 7,
                'meta_title' => '笔趣阁-无弹窗小说网,全文免费阅读',
                'meta_keywords' => '笔趣阁,新笔趣阁,免费全本小说,全本TXT小说,无弹窗小说',
                'meta_description' => '笔趣阁是无弹窗广告的免费小说阅读网站,提供最新完结小说,全本玄幻小说、都市小说、穿越小说、网游小说、武侠仙侠、历史军事、修真同人等全本小说免费阅读,最新完本小说阅读就在笔趣阁',
                'icon' => '',
                'template_index' => '/novel/category/%d',
                'template_detail' => '',
                'template_filter' => '',
                'status' => 0,
                'type' => 1
            ],
            [
                'title' => '玄幻奇幻',
                'sort' => 1,
                'meta_title' => '笔趣阁-无弹窗小说网,全文免费阅读',
                'meta_keywords' => '笔趣阁,新笔趣阁,免费全本小说,全本TXT小说,无弹窗小说',
                'meta_description' => '笔趣阁是无弹窗广告的免费小说阅读网站,提供最新完结小说,全本玄幻小说、都市小说、穿越小说、网游小说、武侠仙侠、历史军事、修真同人等全本小说免费阅读,最新完本小说阅读就在笔趣阁',
                'icon' => '',
                'template_index' => '',
                'template_detail' => '',
                'template_filter' => '',
                'status' => 0,
                'type' => 2
            ],
            [
                'title' => '武侠仙侠',
                'sort' => 1,
                'meta_title' => '笔趣阁-无弹窗小说网,全文免费阅读',
                'meta_keywords' => '笔趣阁,新笔趣阁,免费全本小说,全本TXT小说,无弹窗小说',
                'meta_description' => '笔趣阁是无弹窗广告的免费小说阅读网站,提供最新完结小说,全本玄幻小说、都市小说、穿越小说、网游小说、武侠仙侠、历史军事、修真同人等全本小说免费阅读,最新完本小说阅读就在笔趣阁',
                'icon' => '',
                'template_index' => '',
                'template_detail' => '',
                'template_filter' => '',
                'status' => 0,
                'type' => 2
            ],
            [
                'title' => '都市言情',
                'sort' => 1,
                'meta_title' => '笔趣阁-无弹窗小说网,全文免费阅读',
                'meta_keywords' => '笔趣阁,新笔趣阁,免费全本小说,全本TXT小说,无弹窗小说',
                'meta_description' => '笔趣阁是无弹窗广告的免费小说阅读网站,提供最新完结小说,全本玄幻小说、都市小说、穿越小说、网游小说、武侠仙侠、历史军事、修真同人等全本小说免费阅读,最新完本小说阅读就在笔趣阁',
                'icon' => '',
                'template_index' => '',
                'template_detail' => '',
                'template_filter' => '',
                'status' => 0,
                'type' => 2
            ],
            [
                'title' => '历史军事',
                'sort' => 1,
                'meta_title' => '笔趣阁-无弹窗小说网,全文免费阅读',
                'meta_keywords' => '笔趣阁,新笔趣阁,免费全本小说,全本TXT小说,无弹窗小说',
                'meta_description' => '笔趣阁是无弹窗广告的免费小说阅读网站,提供最新完结小说,全本玄幻小说、都市小说、穿越小说、网游小说、武侠仙侠、历史军事、修真同人等全本小说免费阅读,最新完本小说阅读就在笔趣阁',
                'icon' => '',
                'template_index' => '',
                'template_detail' => '',
                'template_filter' => '',
                'status' => 0,
                'type' => 2
            ],
            [
                'title' => '网游竞技',
                'sort' => 1,
                'meta_title' => '笔趣阁-无弹窗小说网,全文免费阅读',
                'meta_keywords' => '笔趣阁,新笔趣阁,免费全本小说,全本TXT小说,无弹窗小说',
                'meta_description' => '笔趣阁是无弹窗广告的免费小说阅读网站,提供最新完结小说,全本玄幻小说、都市小说、穿越小说、网游小说、武侠仙侠、历史军事、修真同人等全本小说免费阅读,最新完本小说阅读就在笔趣阁',
                'icon' => '',
                'template_index' => '',
                'template_detail' => '',
                'template_filter' => '',
                'status' => 0,
                'type' => 2
            ],
            [
                'title' => '科幻灵异',
                'sort' => 1,
                'meta_title' => '笔趣阁-无弹窗小说网,全文免费阅读',
                'meta_keywords' => '笔趣阁,新笔趣阁,免费全本小说,全本TXT小说,无弹窗小说',
                'meta_description' => '笔趣阁是无弹窗广告的免费小说阅读网站,提供最新完结小说,全本玄幻小说、都市小说、穿越小说、网游小说、武侠仙侠、历史军事、修真同人等全本小说免费阅读,最新完本小说阅读就在笔趣阁',
                'icon' => '',
                'template_index' => '',
                'template_detail' => '',
                'template_filter' => '',
                'status' => 0,
                'type' => 2
            ],
            [
                'title' => '女生频道',
                'sort' => 1,
                'meta_title' => '笔趣阁-无弹窗小说网,全文免费阅读',
                'meta_keywords' => '笔趣阁,新笔趣阁,免费全本小说,全本TXT小说,无弹窗小说',
                'meta_description' => '笔趣阁是无弹窗广告的免费小说阅读网站,提供最新完结小说,全本玄幻小说、都市小说、穿越小说、网游小说、武侠仙侠、历史军事、修真同人等全本小说免费阅读,最新完本小说阅读就在笔趣阁',
                'icon' => '',
                'template_index' => '',
                'template_detail' => '',
                'template_filter' => '',
                'status' => 0,
                'type' => 2
            ],
            [
                'title' => '男生频道',
                'sort' => 1,
                'meta_title' => '笔趣阁-无弹窗小说网,全文免费阅读',
                'meta_keywords' => '笔趣阁,新笔趣阁,免费全本小说,全本TXT小说,无弹窗小说',
                'meta_description' => '笔趣阁是无弹窗广告的免费小说阅读网站,提供最新完结小说,全本玄幻小说、都市小说、穿越小说、网游小说、武侠仙侠、历史军事、修真同人等全本小说免费阅读,最新完本小说阅读就在笔趣阁',
                'icon' => '',
                'template_index' => '',
                'template_detail' => '',
                'template_filter' => '',
                'status' => 0,
                'type' => 2
            ]
        ];
        $category = $this->table('xs_category');
        $category->insert($categoriesData)->save();
//        $novelData = [
//
//        ];
//        $novel = $this->table('xs_novel');
//        $novel->insert($novelData)->save();

    }
}
