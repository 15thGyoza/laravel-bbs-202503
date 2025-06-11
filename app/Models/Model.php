<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 *
 *
 * @method static Builder<static>|Model newModelQuery()
 * @method static Builder<static>|Model newQuery()
 * @method static Builder<static>|Model query()
 * @method static Builder<static>|Model recent()
 * @mixin \Eloquent
 */
class Model extends \Illuminate\Database\Eloquent\Model
{
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
