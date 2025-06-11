<?php

namespace App\Models;

use Database\Factories\ReplyFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property int $topic_id 话题 ID
 * @property int $user_id 用户 ID
 * @property string $content 回复内容
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Topic|null $topic
 * @property-read User|null $user
 * @method static ReplyFactory factory($count = null, $state = [])
 * @method static Builder<static>|Reply newModelQuery()
 * @method static Builder<static>|Reply newQuery()
 * @method static Builder<static>|Reply query()
 * @method static Builder<static>|Reply recent()
 * @method static Builder<static>|Reply whereContent($value)
 * @method static Builder<static>|Reply whereCreatedAt($value)
 * @method static Builder<static>|Reply whereId($value)
 * @method static Builder<static>|Reply whereTopicId($value)
 * @method static Builder<static>|Reply whereUpdatedAt($value)
 * @method static Builder<static>|Reply whereUserId($value)
 * @mixin \Eloquent
 */
class Reply extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = [
        'content',
    ];

    /**
     * A reply belongs to A Topic.
     *
     * @return BelongsTo
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * A reply belongs to a User.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
