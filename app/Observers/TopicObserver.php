<?php

namespace App\Observers;

use App\Models\Topic;

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
        $topic->excerpt = make_excerpt($topic->body);
    }
}
