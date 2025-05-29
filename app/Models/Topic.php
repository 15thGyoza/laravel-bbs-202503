<?php

namespace App\Models;

use Database\Factories\TopicFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
 * @mixin \Eloquent
 */
class Topic extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];

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
     * @param Builder $query
     * @return Builder
     */
    public function scopeRecent(Builder $query): Builder
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
}
