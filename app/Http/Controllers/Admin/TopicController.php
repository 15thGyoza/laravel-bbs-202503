<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     * 显示话题列表，包含搜索和排序。
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        // 预加载关联模型，避免 N+1 查询问题
        $query = Topic::query()->with(['user', 'category']);

        // 搜索功能：根据标题、内容、作者名或分类名模糊搜索
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            })
                ->orWhereHas('user', function ($uq) use ($search) {
                    $uq->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('category', function ($cq) use ($search) {
                    $cq->where('name', 'like', '%' . $search . '%');
                });
        }

        // 排序功能
        // 默认按 'recent_replied' (updated_at) 排序，对应 Topic 模型中的 scopeRecentReplied
        $sortBy = $request->input('sort_by', 'recent_replied');

        switch ($sortBy) {
            case 'recent':
                $query->recent(); // 使用 Topic 模型中的 scopeRecent (按 created_at 排序)
                break;
            case 'view_count':
                $query->orderBy('view_count', 'desc'); // 按浏览次数排序
                break;
            case 'recent_replied':
            default:
                $query->recentReplied(); // 使用 Topic 模型中的 scopeRecentReplied (按 updated_at 排序)
                break;
        }

        // 每页显示15个话题并进行分页
        $topics = $query->paginate(15)->appends(request()->query());

        // 返回话题列表视图
        return view('admin.topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     * 显示创建新话题的表单。
     *
     * @return View
     */
    public function create(): View
    {
        // 获取所有分类供创建表单中的下拉选择
        $categories = Category::all();
        return view('admin.topics.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * 处理创建新话题的表单提交。
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // 定义验证规则
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'], // 确保所选分类存在于数据库
        ];

        // 执行验证
        $validatedData = $request->validate($rules);

        $topic = new Topic();
        $topic->title = $validatedData['title'];
        $topic->body = $validatedData['body'];
        // user_id 应该设置为当前登录的管理员ID作为话题作者
        $topic->user_id = auth()->id();
        $topic->category_id = $validatedData['category_id'];

        $topic->save();

        // 重定向回话题列表页，并带上成功消息
        return redirect()->route('admin.topics.index')->with('success', __('Topic created successfully.'));
    }

    /**
     * Display the specified resource.
     * 显示单个话题的详细信息。
     *
     * @param Topic $topic
     * @return View
     */
    public function show(Topic $topic): View
    {
        // 返回话题详情视图
        return view('admin.topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     * 显示编辑话题信息的表单。
     *
     * @param Topic $topic
     * @return View
     */
    public function edit(Topic $topic): View
    {
        // 获取所有分类供编辑表单中的下拉选择
        $categories = Category::all();
        return view('admin.topics.edit', compact('topic', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * 处理更新话题信息的表单提交。
     *
     * @param Request $request
     * @param Topic $topic
     * @return RedirectResponse
     */
    public function update(Request $request, Topic $topic): RedirectResponse
    {
        // 定义验证规则
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'excerpt' => ['nullable', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:0'],
            // view_count 和 reply_count 在后台管理通常不手动修改，由系统自动更新
            // last_reply_user_id 也不手动修改，由回复逻辑自动更新
        ];

        // 执行验证
        $validatedData = $request->validate($rules);

        // 更新话题字段
        $topic->title = $validatedData['title'];
        $topic->body = $validatedData['body'];
        $topic->category_id = $validatedData['category_id'];
        $topic->excerpt = $validatedData['excerpt'] ?? Str::limit(strip_tags($validatedData['body']), 200);
        $topic->order = $validatedData['order'];

        // 保存话题模型，这将自动更新 `updated_at` 字段
        $topic->save();

        // 重定向回编辑页面，并带上成功消息
        return redirect()->route('admin.topics.edit', $topic)->with('success', __('Topic updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     * 删除指定话题。
     *
     * @param Topic $topic
     * @return RedirectResponse
     */
    public function destroy(Topic $topic): RedirectResponse
    {
        // 删除话题，这会触发 TopicObserver 来删除所有关联的回复
        $topic->delete();

        // 重定向回话题列表页，并带上成功消息
        return redirect()->route('admin.topics.index')->with('success', __('Topic deleted successfully.'));
    }
}
