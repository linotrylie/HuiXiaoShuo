<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddColumnForUser extends AbstractMigration
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
        $tableName = 'xs_' . 'user';
        $this->table($tableName)
            ->addColumn('vip_expired_at', 'datetime', array('null' => true,'comment'=>'会员过期时间'))
            ->addColumn('sex','integer',array('limit'=>1))
            ->addColumn('follow_num','integer',array('limit'=>11,'comment'=>'关注人数'))
            ->addColumn('followed_num','integer',array('limit'=>11,'comment'=>'被多少人关注'))
            ->update();
    }
}
