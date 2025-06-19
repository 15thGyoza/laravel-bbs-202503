<?php

namespace App\Models\Traits;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redis;

/**
 * Trait LastActiveAtHelper
 *
 * 该 Trait 用于处理用户最后活跃时间的记录和同步。
 * 它会将用户的最后活跃时间记录到 Redis 中，并提供方法同步到数据库。
 */
trait LastActiveAtHelper
{
    /**
     * Redis 哈希表的前缀
     *
     * @var string
     */
    protected string $hashPrefix = 'pandaria_last_active_at_';

    /**
     * Redis 哈希表字段的前缀
     *
     * @var string
     */
    protected string $fieldPrefix = 'user_';

    /**
     * 记录用户最后活跃时间到 Redis
     *
     * 该方法会将用户的最后活跃时间记录到 Redis 中，使用哈希表存储。
     * 哈希表的键为当天日期，字段为用户 ID，值为当前时间。
     */
    public function recordLastActiveAt(): void
    {
        // Redis 哈希表的命名，如：pandaria_last_active_at_2025-06-18
        $hash = $this->getHashFromDateString(Carbon::now()->toDateString());

        // 字段名称，如：user_1
        $field = $this->getHashField();

        // 当前时间，如：2025-06-18 08:35:15
        $now = Carbon::now()->toDateTimeString();

        // 数据写入 Redis ，字段已存在会被更新
        Redis::hSet($hash, $field, $now);
    }

    /**
     * 同步前一天的用户最后活跃时间到数据库
     *
     * 该方法会从 Redis 中获取昨天的活跃时间数据，并更新到数据库中。
     * 同时，完成同步后会删除 Redis 中的相关数据。
     */
    public function syncUserActiveAt(): void
    {
        // Redis 哈希表的命名，如：pandaria_last_active_at_2025-10-21
        $hash = $this->getHashFromDateString(Carbon::yesterday()->toDateString());

        // #todo 方便测试, 留在这里
        // 为了方便测试和调试，这里可以直接使用今天的日期
        // $today = Carbon::now()->toDateString();
        // $hash = $this->hashPrefix . $today;

        // 从 Redis 中获取所有哈希表里的数据
        $dates = Redis::hGetAll($hash);

        // 遍历，并同步到数据库中
        foreach ($dates as $userId => $activeAt) {
            // 会将 `user_1` 转换为 1
            $userId = str_replace($this->fieldPrefix, '', $userId);

            // 只有当用户存在时才更新到数据库中
            if ($user = $this->find($userId)) {
                $user->last_active_at = $activeAt;
                $user->save();
            }
        }

        // 以数据库为中心的存储，既已同步，即可删除
        Redis::del($hash);
    }

    /**
     * 当你获取当前模型的 `last_active_at` 属性时，这个方法会被调用。
     * 还有就是 setXxxAttribute 方法会在你设置该属性时被调用。
     * $value 参数是你从数据库中获取的值。如果当前数据库中有值，则为该值，否则为 null
     *
     * @param $value
     * @return Carbon|null
     */
    public function getLastActiveAtAttribute($value): ?Carbon
    {
        // Redis 哈希表的命名，如：pandaria_last_active_at_2025-10-21
        $hash = $this->getHashFromDateString(Carbon::now()->toDateString());

        // 字段名称，如：user_1
        $field = $this->getHashField();

        // 三元运算符，优先选择 Redis 的数据，否则使用数据库中
        $datetime = Redis::hGet($hash, $field) ?: $value;

        // 如果存在的话，返回时间对应的 Carbon 实体
        if ($datetime) {
            return new Carbon($datetime);
        } else {
            // 否则使用用户注册时间
            return $this->created_at;
        }
    }

    /**
     * 获取 Redis 哈希表名
     *
     * @param $date
     * @return string
     */
    public function getHashFromDateString($date): string
    {
        // Redis 哈希表的命名，如：pandaria_last_active_at_2025-10-21
        return $this->hashPrefix . $date;
    }

    /**
     * 获取 Redis 哈希表字段名
     *
     * @return string
     */
    public function getHashField(): string
    {
        // 字段名称，如：user_1
        return $this->fieldPrefix . $this->id;
    }
}
