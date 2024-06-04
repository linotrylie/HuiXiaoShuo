<?php

namespace app\model;

use support\Model;

/**
 * xs_novel_purchase_history 
 * @property integer $pid (主键)
 * @property integer $uid uid
 * @property integer $nid 书id
 * @property integer $ncid 章节id
 * @property string $gold 金币
 * @property string $rmb 余额
 * @property string $created_at 
 * @property string $updated_at 
 * @property string $deleted_at
 */
class NovelPurchaseHistory extends Model
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
    protected $table = 'novel_purchase_history';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'pid';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'created_at',//
        'deleted_at',//
        'gold',//金币
        'ncid',//章节id
        'nid',//书id
        'rmb',//余额
        'uid',//uid
        'updated_at',//
    ];

    public function getRedisKey($param)
    {
        if(is_array($param)) {
            return $this->model->getTable().'_'.implode('_',$param);
        }else{
            $this->model->getTable().'_'.$this->model->getKeyName().'_'.$param;
        }
    }
}
