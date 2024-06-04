<?php

namespace app\model;

use support\Model;

/**
 * xs_user 
 * @property integer $uid (主键)
 * @property string $username 用户名
 * @property string $nickname 昵称
 * @property string $phone 手机号码
 * @property string $email 邮箱地址
 * @property string $qq QQ
 * @property string $wx_credit 微信号
 * @property string $wb_credit 微博号
 * @property string $salt 密码盐
 * @property string $password 密码
 * @property string $access_token 微信权限token
 * @property string $auth_key 微信权限key
 * @property string $avatar_url 头像
 * @property string $ip IP
 * @property string $addr 最后登录地址
 * @property integer $vip_level VIP等级
 * @property integer $rid 角色
 * @property integer $puid 上级邀请人
 * @property integer $gpuid 上上级邀请人
 * @property integer $level 等级
 * @property integer $credit 经验值
 * @property string $gold 金币
 * @property string $rmb 余额
 * @property string $pay_password 支付密码
 * @property string $pay_password_salt 支付密码盐
 * @property string $last_login_time 
 * @property integer $status 状态 0 正常 1 禁用
 * @property string $created_at 
 * @property string $updated_at 
 * @property string $deleted_at 
 * @property string $vip_expired_at 会员过期时间
 * @property integer $sex 性别 1 男 2 女
 * @property integer $follow_num 关注人数
 * @property integer $followed_num 被多少人关注
 */
class User extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'mysql';
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'uid';


    public const STATUS = [
        '正常', //正常状态
        '禁止登录' //禁止登录
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'access_token',//微信权限token
        'addr',//最后登录地址
        'auth_key',//微信权限key
        'avatar_url',//头像
        'created_at',//
        'credit',//经验值
        'deleted_at',//
        'email',//邮箱地址
        'follow_num',//关注人数
        'followed_num',//被多少人关注
        'gold',//金币
        'gpuid',//上上级邀请人
        'ip',//IP
        'last_login_time',//
        'level',//等级
        'nickname',//昵称
        'password',//密码
        'pay_password',//支付密码
        'pay_password_salt',//支付密码盐
        'phone',//手机号码
        'puid',//上级邀请人
        'qq',//QQ
        'rid',//角色
        'rmb',//余额
        'salt',//密码盐
        'sex',//性别 1 男 2 女
        'status',//状态 0 正常 1 禁用
        'updated_at',//
        'username',//用户名
        'vip_expired_at',//会员过期时间
        'vip_level',//VIP等级
        'wb_credit',//微博号
        'wx_credit',//微信号
    ];

    public function select()
    {
        return [
            'access_token',//微信权限token
            'addr',//最后登录地址
            'auth_key',//微信权限key
            'avatar_url',//头像
            'created_at',//
            'credit',//经验值
            'deleted_at',//
            'email',//邮箱地址
            'follow_num',//关注人数
            'followed_num',//被多少人关注
            'gold',//金币
            'gpuid',//上上级邀请人
            'ip',//IP
            'last_login_time',//
            'level',//等级
            'nickname',//昵称
            'phone',//手机号码
            'puid',//上级邀请人
            'qq',//QQ
            'rid',//角色
            'rmb',//余额
            'sex',//性别 1 男 2 女
            'status',//状态 0 正常 1 禁用
            'updated_at',//
            'username',//用户名
            'vip_expired_at',//会员过期时间
            'vip_level',//VIP等级
            'wb_credit',//微博号
            'wx_credit',//微信号
        ];
    }

    public function getRedisKey($param)
    {
        if(is_array($param)) {
            return $this->model->getTable().'_'.implode('_',$param);
        }else{
            $this->model->getTable().'_'.$this->model->getKeyName().'_'.$param;
        }
    }
}
