<?php

namespace app\model;

use support\Model;

/**
 * xs_category 
 * @property integer $cid 分类ID(主键)
 * @property string $title 标题
 * @property integer $pid 上级分类ID
 * @property integer $sort 排序（同级有效）
 * @property string $meta_title SEO的网页标题
 * @property string $meta_keywords 关键字
 * @property string $meta_description 描述
 * @property string $icon 图标
 * @property string $template_index 频道页模板
 * @property string $template_detail 详情页模板
 * @property string $template_filter 筛选页模板
 * @property string $link 外链地址
 * @property integer $type 分类模型
 * @property integer $status 数据状态 0 正常 1 禁用
 * @property string $created_at 
 * @property string $updated_at 
 * @property string $deleted_at
 */
class Category extends Model
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
    protected $table = 'category';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'cid';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    protected $fillable = [
        'created_at',//
        'deleted_at',//
        'icon',//图标
        'link',//外链地址
        'meta_description',//描述
        'meta_keywords',//关键字
        'meta_title',//SEO的网页标题
        'pid',//上级分类ID
        'sort',//排序（同级有效）
        'status',//数据状态 0 正常 1 禁用
        'template_detail',//详情页模板
        'template_filter',//筛选页模板
        'template_index',//频道页模板
        'title',//标题
        'type',//分类模型
        'updated_at',//
    ];
}
