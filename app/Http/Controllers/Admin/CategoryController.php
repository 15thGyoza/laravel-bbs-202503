<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // 引入 Rule 类
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * 显示分类列表，包含搜索。
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = Category::query();

        // 搜索功能：根据名称或描述模糊搜索
        if ($search = $request->input('search')) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        // 分类通常按名称排序，或者按帖子数量排序
        $query->orderBy('name', 'asc'); // 默认按名称升序

        // 每页显示15个分类并进行分页，并携带搜索参数
        $categories = $query->paginate(15)->appends(request()->query());

        // 返回分类列表视图
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * 显示创建新分类的表单。
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     * 处理创建新分类的表单提交。
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // 定义验证规则
        $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:categories'], // 名称必须唯一
            'description' => ['nullable', 'string', 'max:255'],
        ];

        // 执行验证
        $validatedData = $request->validate($rules);

        // 创建新分类
        $category = new Category();
        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'] ?? null;
        $category->post_count = 0; // 新建分类帖子数量默认为0

        $category->save();

        // 重定向回分类列表页，并带上成功消息
        return redirect()->route('admin.categories.index')->with('success', __('Category created successfully.'));
    }

    /**
     * Display the specified resource.
     * 显示单个分类的详细信息。
     *
     * @param Category $category
     * @return View
     */
    public function show(Category $category): View
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     * 显示编辑分类信息的表单。
     *
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * 处理更新分类信息的表单提交。
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        // 定义验证规则
        $rules = [
            'name' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($category->id)], // 名称必须唯一，但忽略自身
            'description' => ['nullable', 'string', 'max:255'],
        ];

        // 执行验证
        $validatedData = $request->validate($rules);

        // 更新分类字段
        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'] ?? null;

        $category->save();

        // 重定向回编辑页面，并带上成功消息
        return redirect()->route('admin.categories.edit', $category)->with('success', __('Category updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     * 删除指定分类。
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        // 在删除分类前，通常需要处理与该分类关联的话题，例如：
        // 1. 将关联话题的 category_id 设置为 null
        // 2. 将关联话题转移到另一个默认分类
        // 3. 级联删除关联话题 (不推荐，除非你确定要删除所有话题)
        // 这里只是简单删除，如果你的应用需要，请在此处添加逻辑

        // 在我们目前这个项目里面不允许删除分类下面有话题的分类
        if (Topic::where('category_id', $category->id)->exists()) {
            return redirect()->route('admin.categories.index')->with('error', __('Cannot delete category with associated topics.'));
        }

        $category->delete();

        // 重定向回分类列表页，并带上成功消息
        return redirect()->route('admin.categories.index')->with('success', __('Category deleted successfully.'));
    }
}
