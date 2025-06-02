<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    /**
     * Only authenticated users can create or edit and destroy topics.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Topic $topic
     * @return View
     */
    public function index(Request $request, Topic $topic): View
    {
        $topics = $topic->withOrder($request->order)
            ->with(['user', 'category'])
            ->paginate($this->perPage);

        return view('topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Topic $topic
     * @return View
     */
    public function create(Topic $topic): View
    {
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTopicRequest $request
     * @param Topic $topic
     * @return RedirectResponse
     */
    public function store(StoreTopicRequest $request, Topic $topic): RedirectResponse
    {
        $topic->fill($request->validated());
        $topic->user()->associate($request->user());
        $topic->save();

        return redirect()->route('topics.show', $topic)->with('success', 'Topic created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic): View
    {
        return view('topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTopicRequest $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        //
    }
}
