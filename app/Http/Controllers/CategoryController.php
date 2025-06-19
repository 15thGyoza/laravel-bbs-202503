<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Link;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Show the topics in a specific category.
     *
     * @param Category $category
     * @param Request $request
     * @param Topic $topic
     * @param User $user
     * @param Link $link
     * @return View
     */
    public function show(Category $category, Request $request, Topic $topic, User $user, Link $link): View
    {
        $topics = $topic->withOrder($request->order)
            ->where('category_id', $category->id)
            ->with(['user', 'category'])
            ->paginate($this->perPage);

        $active_users = $user->getActiveUsers();
        $links = $link->getAllCached();

        return view('topics.index', compact('topics', 'category', 'active_users', 'links'));
    }
}
