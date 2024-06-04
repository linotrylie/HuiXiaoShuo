<?php

namespace app\model;

use support\Model;

/**
 * xs_novel_chapter 
 * @property integer $ncid (主键)
 * @property integer $nid 所属小说
 * @property integer $collect_id 采集ID
 * @property string $source 源名称
 * @property mixed $chapter 内容
 * @property string $reurl 来源
 * @property string $updated 最新内容
 * @property integer $status 状态 0 正常 1 禁用
 * @property string $created_at 
 * @property string $updated_at 
 * @property string $deleted_at
 */
class NovelChapter extends Model
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
    protected $table = 'novel_chapter';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ncid';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    protected $fillable = [
        'chapter',//内容
        'collect_id',//采集ID
        'comment_num',//评论数量
        'created_at',//
        'deleted_at',//
        'down',//踩
        'gold',//金币
        'nid',//所属小说
        'reurl',//来源
        'rmb',//余额
        'source',//源名称
        'status',//状态 0 正常 1 禁用
        'up',//顶
        'updated',//最新内容
        'updated_at',//
    ];
}
