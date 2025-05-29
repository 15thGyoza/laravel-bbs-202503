<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
