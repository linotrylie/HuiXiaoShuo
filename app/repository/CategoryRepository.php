<?php
/**
 * CategoryRepository.php
 * Linotrylie
 * 2024/4/25 - 15:10
 * @Description
 * 天下万般兵刃，唯过往伤人最深
 */

/**
 * @user: Linotryle
 * @date: 2024/4/25
 * @description
 * @createTime: 15:10
 * @github: https://github.com/linotrylie
 */

namespace app\repository;

use app\model\Category;
use app\model\Novel;

class CategoryRepository extends BaseRepository
{

    public function __construct()
    {
        $this->model = new Category();
    }

    public function getCategoryList($type, $limit = 0, $orderBy = ['sort','asc'])
    {
        $builder = $this->model::query()->where('type', $type)->orderBy($orderBy[0],$orderBy[1]);
        if ($limit > 0) {
            $builder = $builder->limit($limit);
        }
        return $this->get($builder);
    }

    public function getCategoryListByPid($pid)
    {
        $builder = $this->model::query()->where('pid', $pid);
        $data = $this->cache($builder);
        if (!empty($data)) {
            return $data;
        }
        $data = $builder->get(['cid']);
        if (is_null($data)) return [];
        $data = $data->toArray();
        $this->afterQuery($data);
        return $data;
    }

}