<?php

declare(strict_types=1);

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

final class NovelTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $this->createNovel();
        $this->createNovelChapter();
        $this->createCategory();
    }

    public function createNovel()
    {
        $tableName = 'xs_' . 'novel';
        $this->table($tableName, array('id' => false, 'primary_key' => array('nid')))
            ->addColumn('nid', 'integer', array('identity' => true, 'signed' => true))
            ->addColumn('cid', 'integer', ['signed' => true, 'default' => 0, 'comment' => '所属分类'])
            ->addColumn('author_id', 'integer', ['signed' => true, 'default' => 0, 'comment' => '推荐票'])
            ->addColumn('title', 'string', ['limit' => 80, 'default' => '', 'comment' => '名称'])
            ->addColumn('author', 'string', ['limit' => 120, 'default' => '', 'comment' => '作者'])
            ->addColumn('pic', 'string', ['limit' => 255, 'default' => '/assets/img/default_book_img.jpg', 'comment' => '图片'])
            ->addColumn('content', 'text', ['comment' => '说明'])
            ->addColumn('tag', 'string', ['limit' => 255, 'default' => '', 'comment' => '标签'])
            ->addColumn('up', 'integer', [ 'signed' => true, 'default' => 0, 'comment' => '顶'])
            ->addColumn('down', 'integer', [ 'signed' => true, 'default' => 0, 'comment' => '踩'])
            ->addColumn('hits', 'integer', array('signed' => true, 'default' => 0, 'comment' => '浏览量'))
            ->addColumn('rating', 'decimal', array('precision' => 4, 'scale' => 2, 'default' => 0, 'comment' => '评分'))
            ->addColumn('rating_count', 'integer', array('signed' => true, 'default' => 0, 'comment' => '评分人数'))
            ->addColumn('serialize', 'integer', array('default' => 0, 'signed' => true, 'limit' => 1, 'comment' => '连载 0 正常 1 禁用'))
            ->addColumn('favorites', 'integer', array('signed' => true, 'default' => 0, 'comment' => '收藏'))
            ->addColumn('position', 'integer', array('default' => 0, 'signed' => true, 'limit' => 2, 'comment' => '推荐位'))
            ->addColumn('hits_day', 'integer', ['signed' => true, 'default' => 0, 'comment' => '日浏览'])
            ->addColumn('hits_week', 'integer', ['signed' => true, 'default' => 0, 'comment' => '周浏览'])
            ->addColumn('hits_month', 'integer', ['signed' => true, 'default' => 0, 'comment' => '月浏览'])
            ->addColumn('hits_time', 'integer', ['signed' => true, 'default' => 0, 'comment' => '浏览时间'])
            ->addColumn('word', 'integer', ['signed' => true, 'default' => 0, 'comment' => '字数'])
            ->addColumn('recommend', 'integer', ['signed' => true, 'default' => 0, 'comment' => '推荐票'])
            ->addColumn('template', 'string', ['limit' => 255, 'default' => '', 'comment' => '模板'])
            ->addColumn('link', 'string', ['limit' => 255, 'default' => '', 'comment' => '外链地址'])
            ->addColumn('reurl', 'string', ['limit' => 255, 'default' => '', 'comment' => '来源'])
            ->addColumn('status', 'integer', array('default' => 0, 'signed' => true, 'limit' => 1, 'comment' => '状态 0 正常 1 禁用'))
            ->addColumn('created_at', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('updated_at', 'datetime', array('null' => true))
            ->addColumn('deleted_at', 'datetime', array('null' => true))
            ->addIndex(array('title'))
            ->addIndex(array('reurl'))
            ->addIndex(array('updated_at'))
            ->addIndex(array('author'))
            ->addIndex(array('hits'))
            ->addIndex(array('serialize'))
            ->addIndex(array('cid'))
            ->addIndex(array('up'))
            ->addIndex(array('down'))
            ->addIndex(array('rating'))
            ->addIndex(array('position'))
            ->addIndex(array('status'))
            ->addIndex(array('hits_day'))
            ->addIndex(array('hits_week'))
            ->addIndex(array('hits_month'))
            ->addIndex(array('word'))
            ->create();
    }

    public function createNovelChapter()
    {
        $tableName = 'xs_' . 'novel_chapter';
        $this->table($tableName, array('id' => false, 'primary_key' => array('ncid')))
            ->addColumn('ncid', 'integer', array('identity' => true, 'signed' => true))
            ->addColumn('nid', 'integer', ['signed' => true, 'default' => 0, 'comment' => '所属小说'])
            ->addColumn('collect_id', 'integer', ['signed' => true, 'default' => 0, 'comment' => '采集ID'])
            ->addColumn('source', 'string', ['limit' => 255, 'default' => '', 'comment' => '源名称'])
            ->addColumn('chapter', 'text', ['comment' => '内容'])
            ->addColumn('reurl', 'string', ['limit' => 255, 'default' => '', 'comment' => '来源'])
            ->addColumn('updated', 'string', ['limit' => 255, 'default' => '', 'comment' => '最新内容'])
            ->addColumn('status', 'integer', array('default' => 0, 'signed' => true, 'limit' => 1, 'comment' => '状态 0 正常 1 禁用'))
            ->addColumn('created_at', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('updated_at', 'datetime', array('null' => true))
            ->addColumn('deleted_at', 'datetime', array('null' => true))
            ->addIndex(array('nid'))
            ->addIndex(array('reurl'))
            ->addIndex(array('updated_at'))
            ->create();
    }

    public function createCategory()
    {
        $tableName = 'xs_' . 'category';
        $this->table($tableName, array('id' => false, 'primary_key' => array('cid')))
            ->addColumn('cid', 'integer', array('identity' => true, 'signed' => true,'comment'=>'分类ID'))
            ->addColumn('title', 'string', ['limit' => 80, 'default' => '', 'comment' => '标题'])
            ->addColumn('pid', 'integer', ['signed' => true, 'default' => 0, 'comment' => '上级分类ID'])
            ->addColumn('sort', 'integer', ['signed' => true, 'default' => 0, 'comment' => '排序（同级有效）'])
            ->addColumn('meta_title', 'string', ['limit' => 80, 'default' => '', 'comment' => 'SEO的网页标题'])
            ->addColumn('meta_keywords', 'string', ['limit' => 255, 'default' => '', 'comment' => '关键字'])
            ->addColumn('meta_description', 'string', ['limit' => 255, 'default' => '', 'comment' => '描述'])
            ->addColumn('icon', 'string', ['limit' => 255, 'default' => '', 'comment' => '图标'])
            ->addColumn('template_index', 'string', ['limit' => 255, 'default' => '', 'comment' => '频道页模板'])
            ->addColumn('template_detail', 'string', ['limit' => 255, 'default' => '', 'comment' => '详情页模板'])
            ->addColumn('template_filter', 'string', ['limit' => 255, 'default' => '', 'comment' => '筛选页模板'])
            ->addColumn('link', 'string', ['limit' => 255, 'default' => '', 'comment' => '外链地址'])
            ->addColumn('type', 'integer', array('default' => 0, 'signed' => true, 'limit' => 3, 'comment' => '分类模型'))
            ->addColumn('status', 'integer', array('default' => 0, 'signed' => true, 'limit' => 1, 'comment' => '数据状态 0 正常 1 禁用'))
            ->addColumn('created_at', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('updated_at', 'datetime', array('null' => true))
            ->addColumn('deleted_at', 'datetime', array('null' => true))
            ->addIndex(array('pid'))
            ->create();
    }
}