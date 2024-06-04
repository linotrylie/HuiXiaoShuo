<?php

namespace app\model;

use support\Model;

/**
 * xs_novel_comment 
 * @property integer $comment_id (主键)
 * @property integer $nid 书id
 * @property integer $uid uid
 * @property integer $pid 回复ID
 * @property string $content 内容
 * @property integer $up 顶
 * @property integer $down 踩
 * @property string $created_at 
 * @property string $updated_at 
 * @property string $deleted_at
 */
class NovelComment extends Model
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
    protected $table = 'novel_comment';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'comment_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'content',//内容
        'created_at',//
        'deleted_at',//
        'down',//踩
        'nid',//书id
        'pid',//回复ID
        'uid',//uid
        'up',//顶
        'updated_at',//
    ];
}
