<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
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
     * @return View
     */
    public function show(Category $category, Request $request, Topic $topic): View
    {
        $topics = $topic->withOrder($request->order)
            ->where('category_id', $category->id)
            ->with(['user', 'category'])
            ->paginate($this->perPage);

        return view('topics.index', compact('topics', 'category'));
    }
}
