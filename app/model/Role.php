<?php

namespace app\model;

use support\Model;

/**
 * xs_role 
 * @property integer $rid (主键)
 * @property string $name 角色名
 * @property string $slug 角色标识
 * @property string $created_at 
 * @property string $updated_at 
 * @property string $deleted_at
 */
class Role extends Model
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
    protected $table = 'role';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'rid';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'created_at',//
        'deleted_at',//
        'name',//角色名
        'slug',//角色标识
        'updated_at',//
    ];
}
