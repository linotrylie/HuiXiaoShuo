<?php

namespace app\model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use support\Model;

/**
 * xs_novel 
 * @property integer $nid (主键)
 * @property integer $cid 所属分类
 * @property integer $author_id 推荐票
 * @property string $title 名称
 * @property string $author 作者
 * @property string $pic 图片
 * @property string $content 说明
 * @property string $tag 标签
 * @property integer $up 顶
 * @property integer $down 踩
 * @property integer $hits 浏览量
 * @property string $rating 评分
 * @property integer $rating_count 评分人数
 * @property integer $serialize 连载 0 正常 1 禁用
 * @property integer $favorites 收藏
 * @property integer $position 推荐位
 * @property integer $hits_day 日浏览
 * @property integer $hits_week 周浏览
 * @property integer $hits_month 月浏览
 * @property integer $hits_time 浏览时间
 * @property integer $word 字数
 * @property integer $recommend 推荐票
 * @property string $template 模板
 * @property string $link 外链地址
 * @property string $reurl 来源
 * @property integer $status 状态 0 正常 1 禁用
 * @property string $created_at 
 * @property string $updated_at 
 * @property string $deleted_at 
 * @property string $sell_way 00 免费  11 全本一次性收费 12 章节收费 13 指定vip等级
 * @property integer $vip_level VIP等级
 * @property integer $comment_num 评论数量
 * @property string $gold 金币
 * @property string $rmb 余额
 */
class Novel extends Model
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
    protected $table = 'novel';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'nid';

    public const NORMAL_STATUS = 0;
    public const DEFINED_STATUS = 1;
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    //免费
    public const SELL_WAY_FREE = '00';
    //一次性收费
    public const SELL_WAY_ONE_CHARGE = '11';
    //章节收费
    public const SELL_WAY_CHAPTER_CHARGE = '12';
    //VIP
    public const SELL_WAY_VIP = '13';

    protected $fillable = [
        'author',//作者
        'author_id',//推荐票
        'cid',//所属分类
        'comment_num',//评论数量
        'content',//说明
        'created_at',//
        'deleted_at',//
        'down',//踩
        'favorites',//收藏
        'gold',//金币
        'hits',//浏览量
        'hits_day',//日浏览
        'hits_month',//月浏览
        'hits_time',//浏览时间
        'hits_week',//周浏览
        'link',//外链地址
        'pic',//图片
        'position',//推荐位
        'rating',//评分
        'rating_count',//评分人数
        'recommend',//推荐票
        'reurl',//来源
        'rmb',//余额
        'sell_way',//00 免费  11 全本一次性收费 12 章节收费 13 指定vip等级
        'serialize',//连载 0 正常 1 禁用
        'status',//状态 0 正常 1 禁用
        'tag',//标签
        'template',//模板
        'title',//名称
        'up',//顶
        'updated_at',//
        'vip_level',//VIP等级
        'word',//字数
    ];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'cid', 'cid')
            ->where('deleted_at', '=', null)
            ->where('type', 2);
    }

    public function chapter(): HasMany
    {
        return $this->hasMany(NovelChapter::class, 'nid', 'nid')
            ->where('deleted_at', '=', null);
    }

    public function lastChapter(): HasOne
    {
        return $this->hasOne(NovelChapter::class, 'nid', 'nid')
            ->where('deleted_at', '=', null)->orderByDesc('ncid')->limit(1);
    }

    public function getNewRecommend(): array
    {
        return self::orderByDesc('created_at')->limit(14)->select(['nid','title'])->get()->toArray();
    }

    /**
     * Linotrylie
     * 2024/4/17 - 15:05
     * 如果代码和注释不一致，那很可能两者都错了
     * @Description
     * @param $nid
     * @return Builder|\Illuminate\Database\Eloquent\Model|null
     */
    public function getNovel($nid): Model|Builder|null
    {
        return self::where('nid',$nid)->where('status',self::NORMAL_STATUS)->whereNull('deleted_at')->first();
    }
}

