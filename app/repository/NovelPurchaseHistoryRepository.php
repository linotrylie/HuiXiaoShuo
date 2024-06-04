<?php
/**
 * NovelPurchaseHistoryRepository.php
 * Linotrylie
 * 2024/4/25 - 15:11
 * @Description
 * 天下万般兵刃，唯过往伤人最深
 */

/**
 * @user: Linotryle
 * @date: 2024/4/25
 * @description
 * @createTime: 15:11
 * @github: https://github.com/linotrylie
 */

namespace app\repository;

use app\model\NovelPurchaseHistory;

class NovelPurchaseHistoryRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new NovelPurchaseHistory();
    }

    public function save($data)
    {
       return $this->model->fill($data)->save();
    }
}