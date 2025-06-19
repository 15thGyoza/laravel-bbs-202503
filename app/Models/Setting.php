<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache; // 引入 Cache Facade

/**
 * *
 * @property int $id
 * @property string $key 配置键名，如 site_name, seo_description
 * @property string|null $value 配置值
 * @property string $type 配置类型，如 string, boolean, integer, json
 * @property string|null $description 配置描述
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Setting newModelQuery()
 * @method static Builder|Setting newQuery()
 * @method static Builder|Setting query()
 * @method static Builder|Setting whereCreatedAt($value)
 * @method static Builder|Setting whereDescription($value)
 * @method static Builder|Setting whereId($value)
 * @method static Builder|Setting whereKey($value)
 * @method static Builder|Setting whereType($value)
 * @method static Builder|Setting whereUpdatedAt($value)
 * @method static Builder|Setting whereValue($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
        'type',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'value' => 'string',
    ];

    // 定义一个常量作为缓存键
    const SETTINGS_CACHE_KEY = 'site_settings_cache';

    /**
     * 从缓存或数据库获取所有站点设置。
     *
     * @return Collection
     */
    public static function getSettingsFromCache(): Collection
    {
        // 尝试从缓存中获取设置
        return Cache::remember(self::SETTINGS_CACHE_KEY, 60 * 24, function () { // 缓存 24 小时
            // 如果缓存中没有，则从数据库获取所有设置并按 key 索引
            return self::all()->keyBy('key');
        });
    }

    /**
     * 清除站点设置缓存。
     * 应该在设置更新后调用。
     *
     * @return bool
     */
    public static function forgetSettingsCache(): bool
    {
        return Cache::forget(self::SETTINGS_CACHE_KEY);
    }
}
