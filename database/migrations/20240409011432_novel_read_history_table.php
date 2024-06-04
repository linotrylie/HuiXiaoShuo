<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class NovelReadHistoryTable extends AbstractMigration
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
        $this->createNovelPurchaseHistoryTable();
        $this->createNovelReadHistoryTable();
    }

    public function createNovelReadHistoryTable()
    {
        $tableName = 'xs_' . 'novel_read_history';
        $this->table($tableName, array('id' => false,'primary_key'=>['hid']))
            ->addColumn('hid', 'integer', array('identity' => true, 'signed' => true))
            ->addColumn('nid', 'integer', ['signed' => true, 'default' => 0, 'comment' => '书id'])
            ->addColumn('ncid', 'integer', ['signed' => true, 'default' => 0, 'comment' => '章节id'])
            ->addColumn('uid', 'integer', ['signed' => true, 'default' => 0, 'comment' => 'uid'])
            ->addColumn('created_at', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('updated_at', 'datetime', array('null' => true))
            ->addColumn('deleted_at', 'datetime', array('null' => true))
            ->create();
    }

    public function createNovelPurchaseHistoryTable()
    {
        $tableName = 'xs_' . 'novel_purchase_history';
        $this->table($tableName, array('id' => false,'primary_key'=>['pid']))
            ->addColumn('pid', 'integer', array('identity' => true, 'signed' => true))
            ->addColumn('uid', 'integer', ['signed' => true, 'default' => 0, 'comment' => 'uid'])
            ->addColumn('nid', 'integer', ['signed' => true, 'default' => 0, 'comment' => '书id'])
            ->addColumn('ncid', 'integer', ['signed' => true, 'default' => 0, 'comment' => '章节id'])
            ->addColumn('gold', 'decimal', array('precision' => 16, 'scale' => 2, 'comment' => '金币', 'default' => 0))
            ->addColumn('rmb', 'decimal', array('precision' => 16, 'scale' => 2, 'comment' => '余额', 'default' => 0))
            ->addColumn('created_at', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('updated_at', 'datetime', array('null' => true))
            ->addColumn('deleted_at', 'datetime', array('null' => true))
            ->create();
    }
}
