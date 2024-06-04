<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddColumnForTableNovelAndChapter extends AbstractMigration
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
        $this->updateNovel();
        $this->updateNovelChapter();
    }

    public function updateNovel()
    {
        $tableName = 'xs_' . 'novel';
        $this->table($tableName)
            ->addColumn('sell_way','string',array('limit'=>2,'comment'=>'00 免费  11 全本一次性收费 12 章节收费 13 指定vip等级'))
            ->addColumn('vip_level', 'integer', array('limit' => 2, 'comment' => 'VIP等级', 'default' => 0))
            ->addColumn('comment_num','integer',array('limit'=>11,'comment'=>'评论数量','default' => 0))
            ->addColumn('gold', 'decimal', array('precision' => 16, 'scale' => 2, 'comment' => '金币', 'default' => 0))
            ->addColumn('rmb', 'decimal', array('precision' => 16, 'scale' => 2, 'comment' => '余额', 'default' => 0))
            ->update();
    }
    public function updateNovelChapter()
    {
        $tableName = 'xs_' . 'novel_chapter';
        $this->table($tableName)
            ->addColumn('up', 'integer', [ 'signed' => true, 'default' => 0, 'comment' => '顶'])
            ->addColumn('down', 'integer', [ 'signed' => true, 'default' => 0, 'comment' => '踩'])
            ->addColumn('gold', 'decimal', array('precision' => 16, 'scale' => 2, 'comment' => '金币', 'default' => 0))
            ->addColumn('rmb', 'decimal', array('precision' => 16, 'scale' => 2, 'comment' => '余额', 'default' => 0))
            ->addColumn('comment_num','integer',array('limit'=>11,'comment'=>'评论数量'))
            ->update();
    }

}
