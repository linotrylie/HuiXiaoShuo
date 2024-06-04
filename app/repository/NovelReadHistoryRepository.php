<?php
/**
 * NovelReadHistoryRepository.php
 * Linotrylie
 * 2024/4/25 - 15:12
 * @Description
 * 天下万般兵刃，唯过往伤人最深
 */

/**
 * @user: Linotryle
 * @date: 2024/4/25
 * @description
 * @createTime: 15:12
 * @github: https://github.com/linotrylie
 */

namespace app\repository;

use app\model\NovelReadHistory;

class NovelReadHistoryRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new NovelReadHistory();
    }

    public function getUserReadHistoryList($where, $nidArr)
    {
        $builder = $this->model::query()->where($where)->whereIn('nid', $nidArr)->orderBy('created_at','desc');
        return $this->get($builder);
    }
}