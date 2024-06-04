<?php
/**
 * HuiModelBuilder.php
 * Linotrylie
 * 2024/4/25 - 11:14
 * @Description
 * 天下万般兵刃，唯过往伤人最深
 */

/**
 * @user: Linotryle
 * @date: 2024/4/25
 * @Description ${CARET}
 * @createTime: 11:14
 * @github: https://github.com/linotrylie
 */

namespace support;

use Illuminate\Database\Query\Builder;

class HuiModelBuilder extends Builder
{
    private $redisKey;

    public function first($columns = ['*'])
    {
        $data = $this->cache();
        if (!empty($data)) {
            return $data;
        }
        $data = parent::first($columns);
        if (is_null($data)) {
            return [];
        }
        $data = $data->toArray();
        $this->afterQuery($data);
        return $data;
    }

    public function get($columns = ['*'])
    {
        $data = $this->cache();
        if (!empty($data)) {
            return $data;
        }
        $data = parent::get($columns);
        if (is_null($data)) {
            return [];
        }
        $data = $data->toArray();
        $this->afterQuery($data);
        return $data;
    }

    private function cache()
    {
        $sql = $this->toSql();
        $sql = str_replace_array('?', $this->getBindings(), $sql);
        var_dump($sql);
        $this->redisKey = md5($sql);
        $val = Redis::get($this->redisKey);
        if (!is_null($val)) {
            return json_decode($val, true);
        }
        return [];
    }

    private function afterQuery($data): ?bool
    {
        try {
            return Redis::setEx($this->redisKey, random_int(3, 180), json_encode($data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE));
        } catch (Exception $e) {
            return false;
        }
    }
}