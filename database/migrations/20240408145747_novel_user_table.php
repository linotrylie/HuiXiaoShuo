<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class NovelUserTable extends AbstractMigration
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
        $this->createNovelUser();
        $this->createNovelComment();
    }

    public function createNovelUser()
    {
        $tableName = 'xs_' . 'novel_user';
        $this->table($tableName, array('id' => false))
            ->addColumn('nid', 'integer', ['signed' => true, 'default' => 0, 'comment' => '书id'])
            ->addColumn('uid', 'integer', ['signed' => true, 'default' => 0, 'comment' => 'uid'])
            ->addColumn('created_at', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('updated_at', 'datetime', array('null' => true))
            ->addColumn('deleted_at', 'datetime', array('null' => true))
            ->addIndex(['nid','uid'],array('unique' => true, 'name' => 'idx_nid_uid'))
            ->create();
    }

    public function createNovelComment()
    {
        $tableName = 'xs_' . 'novel_comment';
        $this->table($tableName, array('id' => false,'primary_key'=>['comment_id']))
            ->addColumn('comment_id', 'integer', array('identity' => true, 'signed' => true))
            ->addColumn('nid', 'integer', ['signed' => true, 'default' => 0, 'comment' => '书id'])
            ->addColumn('uid', 'integer', ['signed' => true, 'default' => 0, 'comment' => 'uid'])
            ->addColumn('pid', 'integer', ['signed' => true, 'default' => 0, 'comment' => '回复ID'])
            ->addColumn('content', 'text', ['comment' => '内容'])
            ->addColumn('up', 'integer', [ 'signed' => true, 'default' => 0, 'comment' => '顶'])
            ->addColumn('down', 'integer', [ 'signed' => true, 'default' => 0, 'comment' => '踩'])
            ->addColumn('created_at', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('updated_at', 'datetime', array('null' => true))
            ->addColumn('deleted_at', 'datetime', array('null' => true))
            ->create();
    }
}
