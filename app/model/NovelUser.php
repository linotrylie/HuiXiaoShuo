<?php

namespace app\model;

use support\Model;

/**
 * xs_novel_user 
 * @property integer $nid 书id
 * @property integer $uid uid
 * @property string $created_at 
 * @property string $updated_at 
 * @property string $deleted_at
 */
class NovelUser extends Model
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
    protected $table = 'novel_user';

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
        'nid',//书id
        'uid',//uid
        'updated_at',//
    ];

    public function novel()
    {
        return $this->hasMany(Novel::class, 'nid', 'nid')
            ->where('deleted_at', '=', null)->select(['title','nid','created_at','updated_at','author']);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'uid', 'uid')
            ->where('deleted_at', '=', null)->select(['username','nickname','uid']);
    }
}
