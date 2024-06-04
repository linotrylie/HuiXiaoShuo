<?php
/**
 * NovelRepository.php
 * Linotrylie
 * 2024/4/25 - 14:53
 * @Description
 * 天下万般兵刃，唯过往伤人最深
 */

/**
 * @user: Linotryle
 * @Description
 * @date: 2024/4/25
 * @createTime: 14:53
 * @github: https://github.com/linotrylie
 */

namespace app\repository;

use app\model\Novel;

class NovelRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Novel();
    }

    public function getListByPosition($position, $limit = 0)
    {
        $builder = $this->model::query()->with(['category'])->where(['position' => $position]);
        if ($limit > 0) {
            $builder = $builder->limit($limit);
        }
        return $this->get($builder);
    }

    public function getListByCategory($cid, $limit = 0)
    {
        $builder = $this->model::query()->with(['category'])->where(['cid' => $cid]);
        if ($limit > 0) {
            $builder = $builder->limit($limit);
        }
        return $this->get($builder);
    }

    public function getPaginationByCid($cid, $page, $pageSize)
    {
        $builder = $this->model::query()->whereIn('cid', $cid);
        $builder = $builder->orderByDesc('created_at');
        return $this->paginate($builder, $page, $pageSize);
    }
}