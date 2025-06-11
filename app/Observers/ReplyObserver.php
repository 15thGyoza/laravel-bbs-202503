<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;

class ReplyObserver
{
    /**
     * Handle the Reply "created" event.
     *
     * @param Reply $reply
     * @return void
     */
    public function created(Reply $reply): void
    {
        $reply->topic->updateReplyCount();

        // 通知话题作者有新的回复
        $reply->topic->user->notify(new TopicReplied($reply));
    }

    /**
     * Handle the Reply "creating" event.
     *
     * This method is called before a reply is created.
     * It sanitizes the content of the reply to prevent XSS attacks.
     *
     * @param Reply $reply
     * @return void
     */
    public function creating(Reply $reply): void
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }

    /**
     * Handle the Reply "updated" event.
     *
     * @param Reply $reply
     * @return void
     */
    public function deleted(Reply $reply): void
    {
        $reply->topic->updateReplyCount();
    }
}
