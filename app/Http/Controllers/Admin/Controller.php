<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * The number of items per page for pagination.
     *
     * @var int
     */
    protected int $perPage = 15;
}
