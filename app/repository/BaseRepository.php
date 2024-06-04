<?php
/**
 * BaseRepository.php
 * Linotrylie
 * 2024/4/9 - 9:52
 * @Description
 * 天下万般兵刃，唯过往伤人最深
 */

namespace app\repository;

use Illuminate\Database\Eloquent\Builder;
use JsonException;
use support\Redis;

class BaseRepository
{
    const LIMIT_DEFAULT = 12;
    public $model;
    private string $redisKey;

    public function one($where, $relation = [], $orderBy = [])
    {
        $builder = $this->getBuilder($relation, $where, $orderBy);
        return $this->first($builder);
    }

    /**
     * @user: Linotryle
     * 2024/4/25 - 14:50
     * 如果代码和注释不一致，那很可能两者都错了
     * @Description 查询单条数据
     * @param Builder $builder
     * @return array|mixed
     * @throws JsonException
     * @github: https://github.com/linotrylie
     */
    public function first(Builder $builder)
    {
        $data = $this->cache($builder);
        if (!empty($data)) {
            return $data;
        }
        $data = $builder->first();
        if (is_null($data)) {
            return [];
        }
        $data = $data->toArray();
        $this->afterQuery($data);
        return $data;
    }

    /**
     * @user: Linotryle
     * 2024/4/25 - 14:50
     * 如果代码和注释不一致，那很可能两者都错了
     * @Description redis缓存
     * @param Builder $builder
     * @return array|mixed
     * @github: https://github.com/linotrylie
     */
    public function cache(Builder $builder)
    {
        $sql = $builder->toSql();
        $sql = str_replace_array('?', $builder->getBindings(), $sql);
        $this->redisKey = md5($sql);
        $val = Redis::get($this->redisKey);
        if (!is_null($val)) {
            return json_decode($val, true);
        }
        return [];
    }

    /**
     * @user: Linotryle
     * 2024/4/25 - 14:51
     * 如果代码和注释不一致，那很可能两者都错了
     * @Description 查询多条数据
     * @param Builder $builder
     * @return array|mixed
     * @throws JsonException
     * @github: https://github.com/linotrylie
     */
    public function get(Builder $builder)
    {
        $data = $this->cache($builder);
        if (!empty($data)) {
            return $data;
        }
        $data = $builder->get();
        if (is_null($data)) return [];
        $data = $data->toArray();
        $this->afterQuery($data);
        return $data;
    }

    /**
     * @user: Linotryle
     * 2024/4/25 - 14:51
     * 如果代码和注释不一致，那很可能两者都错了
     * @Description 查询之后缓存
     * @param $data
     * @return bool|null
     * @throws JsonException
     * @github: https://github.com/linotrylie
     */
    protected function afterQuery($data): ?bool
    {
        try {
            return Redis::setEx($this->redisKey, random_int(3, 180), json_encode($data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE));
        } catch (Exception $e) {
            return false;
        }
    }

    public function paginate($builder, $page = 1, $limit = 12)
    {
        $data = $this->cache($builder);
        if (!empty($data)) {
            return $data;
        }
        if (empty($limit) || is_null($limit)) $limit = self::LIMIT_DEFAULT;
        $data = $builder->paginate($limit * ($page - 1));
        if (is_null($data)) {
            return [];
        }
        $data = $data->toArray();
        $this->afterQuery($data);
        return $data;
    }

    public function all($where, $relation = [], $limit = 0, $orderBy = [])
    {
        $builder = $this->getBuilder($relation, $where, $orderBy);
        if ($limit > 0) {
            $builder = $builder->limit($limit);
        }
        return $this->get($builder);
    }

    /**
     * @user: Linotryle
     * 2024/4/25 - 16:45
     * 如果代码和注释不一致，那很可能两者都错了
     * @description
     * @param mixed $relation
     * @param $where
     * @param mixed $orderBy
     * @return mixed
     * @github: https://github.com/linotrylie
     */
    public function getBuilder(mixed $relation, $where, mixed $orderBy)
    {
        $builder = $this->model::query();
        if (!empty($relation)) {
            $builder = $builder->with($relation);
        }
        if (!empty($where)) {
            $builder = $builder->where($where);
        }
        if (!empty($orderBy)) {
            foreach ($orderBy as $col => $ord) {
                $builder = $builder->orderBy($col, $ord);
            }
        }
        return $builder;
    }
}