<?php

namespace App\Observers;

use App\Jobs\GenerateSlug;
use App\Models\Topic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TopicObserver
{
    /**
     * When a topic is being created or updated, generate an excerpt from the body.
     *
     * @param Topic $topic
     * @return void
     */
    public function saving(Topic $topic): void
    {
        // 过滤话题内容的特殊标签
        $topic->body = clean($topic->body, 'user_topic_body');

        // 生成摘要
        $topic->excerpt = make_excerpt($topic->body);
    }

    /**
     * After a topic is saved, if it does not have a slug, generate one.
     *
     * @param Topic $topic
     * @return void
     */
    public function saved(Topic $topic): void
    {
        // 如果没有 slug，则使用标题生成 slug
        // 我们按照查得的日本公司最常见的方式来处理 slug
        // 我们使用队列来生成 slug
        if (!$topic->slug) {
            // 推送生成 slug 的任务到队列
            dispatch(new GenerateSlug($topic));
        }
    }

    /**
     * When a topic is deleted, remove all replies associated with it.
     *
     * @param Topic $topic
     * @return void
     */
    public function deleted(Topic $topic): void
    {
        DB::table('replies')->where('topic_id', $topic->id)->delete();
    }
}
