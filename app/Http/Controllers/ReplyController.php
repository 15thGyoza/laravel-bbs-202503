<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\UpdateReplyRequest;
use App\Models\Reply;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * ReplyController handles the operations related to replies.
 * It includes methods for storing and deleting replies.
 */
class ReplyController extends Controller
{
    /**
     * ReplyController constructor.
     * This constructor applies the 'auth' middleware to all methods in this controller.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreReplyRequest $request
     * @param Reply $reply
     * @return RedirectResponse
     */
    public function store(StoreReplyRequest $request, Reply $reply): RedirectResponse
    {
        $reply->content = $request->content;
        $reply->user_id = auth()->id();
        $reply->topic_id = $request->topic_id;
        $reply->save();

        return redirect()->to($reply->topic->link())->with('success', 'Reply created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reply $reply
     * @return RedirectResponse
     * @throws AuthorizationException'
     */
    public function destroy(Reply $reply): RedirectResponse
    {
        $this->authorize('destroy', $reply);
        $reply->delete();

        return redirect()->to($reply->topic->link())->with('success', 'Reply deleted successfully!');
    }
}
