<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UserTable extends AbstractMigration
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
        $table = $this->table($tableName,array('id' => false, 'primary_key' => array('uid')));
        $table->addColumn('uid', 'integer', array('identity' => true, 'signed' => true))
            ->addColumn('username', 'string', array('limit' => 64, 'comment' => '用户名'))
            ->addColumn('nickname', 'string', array('limit' => 64, 'comment' => '昵称'))
            ->addColumn('phone', 'string', array('limit' => 11, 'comment' => '手机号码'))
            ->addColumn('email', 'string', array('limit' => 128, 'comment' => '邮箱地址'))
            ->addColumn('qq', 'string', array('limit' => 12, 'comment' => 'QQ'))
            ->addColumn('wx_credit', 'string', array('limit' => 64, 'comment' => '微信号'))
            ->addColumn('wb_credit', 'string', array('limit' => 64, 'comment' => '微博号'))
            ->addColumn('salt', 'string', array('limit' => 32, 'comment' => '密码盐'))
            ->addColumn('password', 'string', array('limit' => 128, 'comment' => '密码'))
            ->addColumn('access_token', 'string', array('limit' => 32, 'comment' => '微信权限token', 'null' => true))
            ->addColumn('auth_key', 'string', array('limit' => 32, 'comment' => '微信权限key', 'null' => true))
            ->addColumn('avatar_url', 'string', array('limit' => 255, 'comment' => '头像', 'default' => '/assets/img/avatar.png'))
            ->addColumn('addr', 'string', array('limit' => 128, 'comment' => '最后登录地址', 'default' => ''))
            ->addColumn('ip', 'string', array('limit' => 16, 'comment' => 'IP'))
            ->addColumn('vip_level', 'integer', array('limit' => 2, 'comment' => 'VIP等级', 'default' => 0))
            ->addColumn('rid', 'integer', array('signed' => true, 'comment' => '角色', 'null' => true))
            ->addColumn('puid', 'integer', array('signed' => true, 'comment' => '上级邀请人', 'null' => true))
            ->addColumn('gpuid', 'integer', array('signed' => true, 'comment' => '上上级邀请人', 'null' => true))
            ->addColumn('level', 'integer', array('limit' => 2, 'comment' => '等级', 'default' => 0))
            ->addColumn('credit', 'integer', array('limit' => 11, 'comment' => '经验值', 'default' => 0))
            ->addColumn('gold', 'decimal', array('precision' => 16, 'scale' => 2, 'comment' => '金币', 'default' => 0))
            ->addColumn('rmb', 'decimal', array('precision' => 16, 'scale' => 2, 'comment' => '余额', 'default' => 0))
            ->addColumn('pay_password', 'string', array('limit' => 255, 'comment' => '支付密码'))
            ->addColumn('pay_password_salt', 'string', array('limit' => 255, 'comment' => '支付密码盐'))
            ->addColumn('last_login_time', 'datetime', array('null' => true))
            ->addColumn('status', 'integer', array('default' => 0, 'signed' => true, 'limit' => 1, 'comment' => '状态 0 正常 1 禁用'))
            ->addColumn('created_at', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('updated_at', 'datetime', array('null' => true))
            ->addColumn('deleted_at', 'datetime', array('null' => true))
            ->create();
    }
}
