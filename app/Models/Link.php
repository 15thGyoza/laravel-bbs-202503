<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Link extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'link',];

    public string $cacheKey = 'pandaria_links';

    protected int $cacheExpireInSeconds = 1440 * 60; // 24 hours

    /**
     * 缓存所有链接数据
     *
     * @return mixed
     */
    public function getAllCached(): mixed
    {
        // 如果缓存中存在数据，则直接返回
        // 否则从数据库中获取数据并缓存
        return Cache::remember($this->cacheKey, $this->cacheExpireInSeconds, function () {
            return $this->all();
        });
    }
}
