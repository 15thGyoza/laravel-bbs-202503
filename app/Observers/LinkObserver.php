<?php

namespace App\Observers;

use App\Models\Link;
use Illuminate\Support\Facades\Cache;

class LinkObserver
{
    /**
     * 在保存时清空 cache_key 对应的缓存
     *
     * @param Link $link
     * @return void
     */
    public function saved(Link $link): void
    {
        Cache::forget($link->cache_key);
    }
}
