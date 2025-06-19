<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// 每小时计算一下活跃用户
app(Schedule::class)->command('pandaria:calculate-active-user')->hourly();

// 每天凌晨 0 点调度同步用户活跃时间的命令
app(Schedule::class)->command('pandaria:sync-user-active-at')->dailyAt('00:00');
