<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RoleTable extends AbstractMigration
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
        $this->createRole();

        $this->createRoleUsers();

        $this->createRoleMenu();

        $this->createMenu();
    }

    public function createRole()
    {
        $tableName = 'xs_' . 'role';
        $table = $this->table($tableName,array('id' => false, 'primary_key' => array('rid')));
        $table->addColumn('rid', 'integer', array('identity' => true, 'signed' => true))
            ->addColumn('name', 'string', array('limit' => 64, 'comment' => '角色名'))
            ->addColumn('slug', 'string', array('limit' => 64, 'comment' => '角色标识'))
            ->addColumn('created_at', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('updated_at', 'datetime', array('null' => true))
            ->addColumn('deleted_at', 'datetime', array('null' => true))
            ->create();
    }

    public function createRoleUsers()
    {
        $tableName = 'xs_' . 'role_users';
        $table = $this->table($tableName,array('id' => false));
        $table->addColumn('uid', 'integer', array('signed' => true))
            ->addColumn('rid', 'integer', array( 'signed' => true))
            ->addColumn('created_at', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('updated_at', 'datetime', array('null' => true))
            ->addColumn('deleted_at', 'datetime', array('null' => true))
            ->addIndex(['rid','uid'], array('unique' => true, 'name' => 'idx_rid_uid'))
            ->create();
    }

    public function createRoleMenu()
    {
        $tableName = 'xs_' . 'role_menu';
        $table = $this->table($tableName,array('id' => false));
        $table->addColumn('mid', 'integer', array('signed' => true))
            ->addColumn('rid', 'integer', array( 'signed' => true))
            ->addColumn('created_at', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('updated_at', 'datetime', array('null' => true))
            ->addColumn('deleted_at', 'datetime', array('null' => true))
            ->addIndex(['rid','mid'], array('unique' => true, 'name' => 'idx_rid_mid'))
            ->create();
    }

    public function createMenu()
    {
        $tableName = 'xs_' . 'menu';
        $table = $this->table($tableName,array('id' => false, 'primary_key' => array('mid')));
        $table->addColumn('mid', 'integer', array('identity' => true,'signed' => true))
            ->addColumn('pid', 'integer', array( 'signed' => true))
            ->addColumn('order', 'integer', array('limit'=>4,'signed' => true))
            ->addColumn('title', 'string', array('limit' => 64, 'comment' => '菜单名'))
            ->addColumn('icon', 'string', array('limit' => 64, 'comment' => '图标'))
            ->addColumn('uri', 'string', array('limit' => 255, 'comment' => 'uri'))
            ->addColumn('show', 'integer', array('limit'=>1,'signed' => true))
            ->addColumn('created_at', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('updated_at', 'datetime', array('null' => true))
            ->addColumn('deleted_at', 'datetime', array('null' => true))
            ->addIndex(['mid','pid'], array('unique' => true, 'name' => 'idx_mid_pid'))
            ->create();
    }

}
