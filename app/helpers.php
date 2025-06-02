<?php


use Illuminate\Support\Facades\Route;

/**
 * Get the current route name and replace dots with dashes.
 * example:
 *  users.index => users-index
 *  <div class="{{ route_class() }}"></div>
 *  <div class="users-index"></div>
 *
 * @return array|string
 */
function route_class(): array|string
{
    return str_replace('.', '-', Route::currentRouteName());
}

function make_excerpt($value, $length = 200): int|string
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return str()->limit($excerpt, $length);
}
