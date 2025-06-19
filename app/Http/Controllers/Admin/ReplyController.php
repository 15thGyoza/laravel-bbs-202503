<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     * 显示回复列表，包含搜索。
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        // 预加载关联模型，避免 N+1 查询问题
        $query = Reply::query()->with(['user', 'topic']);

        // 搜索功能：根据内容、所属话题标题或作者名模糊搜索
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('content', 'like', '%' . $search . '%');
            })
                ->orWhereHas('user', function ($uq) use ($search) {
                    $uq->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('topic', function ($tq) use ($search) {
                    $tq->where('title', 'like', '%' . $search . '%');
                });
        }

        // 回复通常按创建时间倒序排序
        $query->orderBy('created_at', 'desc');

        // 每页显示15个回复并进行分页
        $replies = $query->paginate(15)->appends(request()->query());

        // 返回回复列表视图
        return view('admin.replies.index', compact('replies'));
    }

    /**
     * Display the specified resource.
     * 显示单个回复的详细信息。
     *
     * @param Reply $reply
     * @return View
     */
    public function show(Reply $reply): View
    {
        // 预加载关联数据，以防从列表页直接跳转而未加载
        $reply->load(['user', 'topic']);
        return view('admin.replies.show', compact('reply'));
    }

    /**
     * Show the form for editing the specified resource.
     * 显示编辑回复信息的表单。
     *
     * @param Reply $reply
     * @return View
     */
    public function edit(Reply $reply): View
    {
        // 预加载关联数据
        $reply->load(['user', 'topic']);
        return view('admin.replies.edit', compact('reply'));
    }

    /**
     * Update the specified resource in storage.
     * 处理更新回复信息的表单提交。
     *
     * @param Request $request
     * @param Reply $reply
     * @return RedirectResponse
     */
    public function update(Request $request, Reply $reply): RedirectResponse
    {
        // 定义验证规则
        $rules = [
            'content' => ['required', 'string'],
        ];

        // 执行验证
        $validatedData = $request->validate($rules);

        // 更新回复内容
        $reply->content = $validatedData['content'];

        // 保存回复模型，这将自动更新 `updated_at` 字段
        $reply->save();

        // 重定向回编辑页面，并带上成功消息
        return redirect()->route('admin.replies.edit', $reply)->with('success', __('Reply updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     * 删除指定回复。
     *
     * @param Reply $reply
     * @return RedirectResponse
     */
    public function destroy(Reply $reply): RedirectResponse
    {
        $reply->delete();

        // 重定向回回复列表页，并带上成功消息
        return redirect()->route('admin.replies.index')->with('success', __('Reply deleted successfully.'));
    }
}
