<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name 名称
 * @property string|null $description 描述
 * @property int $post_count 帖子数量
 * @method static Builder<static>|Category newModelQuery()
 * @method static Builder<static>|Category newQuery()
 * @method static Builder<static>|Category query()
 * @method static Builder<static>|Category whereDescription($value)
 * @method static Builder<static>|Category whereId($value)
 * @method static Builder<static>|Category whereName($value)
 * @method static Builder<static>|Category wherePostCount($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use HasFactory;

    /**
     * 当前表没有 created_at 和 updated_at 字段
     * 因此设置 $timestamps 为 false
     * 在 Laravel 中，默认情况下，Eloquent 模型会自动维护 created_at 和 updated_at 字段
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];
}
