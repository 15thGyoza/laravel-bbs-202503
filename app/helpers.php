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
