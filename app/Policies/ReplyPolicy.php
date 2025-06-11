<?php

namespace App\Policies;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReplyPolicy
{
    /**
     * Only the author of the reply or the author of the topic can delete the reply.
     *
     * @param User $user
     * @param Reply $reply
     * @return bool
     */
    public function destroy(User $user, Reply $reply): bool
    {
        return $user->isAuthorOf($reply) || $user->isAuthorOf($reply->topic);
    }
}
