<?php

namespace app\model;

use support\Model;

/**
 * xs_role_users 
 * @property integer $uid 
 * @property integer $rid 
 * @property string $created_at 
 * @property string $updated_at 
 * @property string $deleted_at
 */
class RoleUsers extends Model
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
    protected $table = 'role_users';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    protected $fillable = [
        'created_at',//
        'deleted_at',//
        'rid',//
        'uid',//
        'updated_at',//
    ];
}
