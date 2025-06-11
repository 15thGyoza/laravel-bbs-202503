<?php

namespace App\Models;

use App\Observers\TopicObserver;
use Database\Factories\TopicFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property string $title 标题
 * @property string $body 内容
 * @property int $user_id 用户ID
 * @property int $category_id 分类ID
 * @property int $view_count 浏览次数
 * @property int $reply_count 回复次数
 * @property int|null $last_reply_user_id 最后回复用户ID
 * @property int $order 排序
 * @property string|null $excerpt 摘要
 * @property string|null $slug 别名
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Category|null $category
 * @property-read User|null $user
 * @method static TopicFactory factory($count = null, $state = [])
 * @method static Builder<static>|Topic newModelQuery()
 * @method static Builder<static>|Topic newQuery()
 * @method static Builder<static>|Topic query()
 * @method static Builder<static>|Topic whereBody($value)
 * @method static Builder<static>|Topic whereCategoryId($value)
 * @method static Builder<static>|Topic whereCreatedAt($value)
 * @method static Builder<static>|Topic whereExcerpt($value)
 * @method static Builder<static>|Topic whereId($value)
 * @method static Builder<static>|Topic whereLastReplyUserId($value)
 * @method static Builder<static>|Topic whereOrder($value)
 * @method static Builder<static>|Topic whereReplyCount($value)
 * @method static Builder<static>|Topic whereSlug($value)
 * @method static Builder<static>|Topic whereTitle($value)
 * @method static Builder<static>|Topic whereUpdatedAt($value)
 * @method static Builder<static>|Topic whereUserId($value)
 * @method static Builder<static>|Topic whereViewCount($value)
 * @method static Builder<static>|Topic recent()
 * @method static Builder<static>|Topic recentReplied()
 * @method static Builder<static>|Topic withOrder(string $order)
 * @property-read Collection<int, Reply> $replies
 * @property-read int|null $replies_count
 * @mixin \Eloquent
 */
#[ObservedBy(TopicObserver::class)]
class Topic extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];

    /**
     * Topic belongs to a User.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Topic belongs to a Category.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * A topic can have many replies.
     *
     * @return HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Scope a query to order topics based on the specified order.
     *
     * @param $query
     * @param string|null $order
     * @return void
     */
    public function scopeWithOrder($query, ?string $order): void
    {
        switch ($order) {
            case 'recent':
                $query->recent($query);
                break;
            default:
                $query->recentReplied($query);
                break;
        }
    }

    /**
     * Scope a query to order topics by creation date.
     *
     * @param $query
     * @return Builder
     */
    public function scopeRecent($query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope a query to order topics by the most recent reply.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeRecentReplied(Builder $query): Builder
    {
        // 当话题有新回复时，我们将编写逻辑来更新话题模型的 reply_count 属性，
        // 此时会自动触发框架对数据模型 updated_at 时间戳的更新
        return $query->orderBy('updated_at', 'desc');
    }

    /**
     * Generate a link to the topic.
     *
     * @param array $params Additional parameters to include in the link.
     * @return string
     */
    public function link(array $params = []): string
    {
        // http://example.com/topics/1/slug
        // http://example.com/topics/当前 topic 的 ID/经过我们使用 urlencode 过后的 title
        // http://127.0.0.1:8000/topics/292/福岡大臣会見概要
        $params = array_merge([$this->id, $this->slug], $params);
        return route('topics.show', $params);
    }

    /**
     * Update the reply count for the topic.
     *
     * This method counts the number of replies associated with the topic
     * and updates the reply_count attribute accordingly.
     *
     * @return void
     */
    public function updateReplyCount(): void
    {
        $this->reply_count = $this->replies->count();
        $this->save();
    }
}
