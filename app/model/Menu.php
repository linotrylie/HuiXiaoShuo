<?php

namespace app\model;

use support\Model;

/**
 * xs_menu 
 * @property integer $mid (主键)
 * @property integer $pid 
 * @property integer $order 
 * @property string $title 菜单名
 * @property string $icon 图标
 * @property string $uri uri
 * @property integer $show 
 * @property string $created_at 
 * @property string $updated_at 
 * @property string $deleted_at
 */
class Menu extends Model
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
    protected $table = 'menu';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'mid';

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
        'order',//
        'pid',//
        'show',//
        'title',//菜单名
        'updated_at',//
        'uri',//uri
    ];
}
