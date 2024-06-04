<?php

namespace app\model;

use support\Model;

/**
 * xs_novel_read_history 
 * @property integer $hid (主键)
 * @property integer $nid 书id
 * @property integer $ncid 章节id
 * @property integer $uid uid
 * @property string $created_at 
 * @property string $updated_at 
 * @property string $deleted_at
 */
class NovelReadHistory extends Model
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
    protected $table = 'novel_read_history';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'hid';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT =  'updated_at';

    protected $fillable = [
        'created_at',//
        'deleted_at',//
        'ncid',//章节id
        'nid',//书id
        'uid',//uid
        'updated_at',//
    ];
}
