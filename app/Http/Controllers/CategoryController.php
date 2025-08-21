<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * 顯示所有分類
     */
    public function index()
    {
        $categories = Category::with('parent')->orderBy('name')->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * 顯示建立分類表單
     */
    public function create()
    {
        $parentCategories = Category::orderBy('name')->get();

        return view('categories.create', compact('parentCategories'));
    }

    /**
     * 儲存新分類
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:categories,slug',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $data = $request->only(['name', 'slug', 'parent_id']);
        $data['slug'] = $data['slug'] ?? Str::slug($data['name'], '-');

        Category::create($data);

        return redirect()->route('categories.index')->with('success', '分類建立成功');
    }

    /**
     * 顯示編輯表單
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::where('id', '!=', $category->id)->orderBy('name')->get();

        return view('categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * 更新分類資料
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:categories,slug,' . $category->id,
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $data = $request->only(['name', 'slug', 'parent_id']);
        $data['slug'] = $data['slug'] ?? Str::slug($data['name'], '-');

        $category->update($data);

        return redirect()->route('categories.index')->with('success', '分類更新成功');
    }

    /**
     * 刪除分類
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', '分類已刪除');
    }
}
