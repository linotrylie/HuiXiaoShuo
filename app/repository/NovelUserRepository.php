<?php
/**
 * NovelUserRepository.php
 * Linotrylie
 * 2024/4/10 - 15:28
 * @Description
 * 天下万般兵刃，唯过往伤人最深
 */

namespace app\repository;

use app\model\NovelUser;

class NovelUserRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new NovelUser();
    }

}