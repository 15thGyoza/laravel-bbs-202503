<?php

namespace App\Jobs;

use App\Models\Topic;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GenerateSlug implements ShouldQueue
{
    use Queueable;

    protected Topic $topic;

    /**
     * Create a new job instance.
     */
    public function __construct(Topic $topic)
    {
        // 队列任务构造器中接收了 Eloquent 模型，将会只序列化模型的 ID
        $this->topic = $topic;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // 生成 slug
        $slug = rawurlencode(Str::replace(' ', '-', $this->topic->title));

        // 保存到数据库
        // UPDATE topics SET slug = "$slug" WHERE id = "$this->topic->id";
        DB::table('topics')->where('id', $this->topic->id)->update(['slug' => $slug]);
    }
}
