<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArticleController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        // laravel 11+ 不再支援直接於constructor中定義 middleware
        // $this->middleware('auth');
    }

    public function index(): View
    {
        // 查詢文章的tag與user,依id排列, 一個page10筆
        $articles = Article::with(['tags','user'])
            ->latest('updated_at')
            ->paginate(10);
        // 將變數傳給view, compact('articles') 相當於 ['articles' => $articles]
        return view('articles.index', [
        'articles' => $articles,
        'pageTitle' => '所有文章'
    ]);
    }

    public function create(): View
    {
        // 取得Tag的所有資料並依照name排列, $tags: 所有tag的集合
        // $categories = Category::with('children')->whereNull('parent_id')->get();
        $categories = Category::where('parent_id', 6)->get();
        $tags = Tag::orderBy('name')->get();
        return view('articles.create', compact('categories', 'tags'));
    }

    public function store(ArticleRequest $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);
        
        // 呼叫App\Models\User model裡的articles()，回傳一個 HasMany 關聯物件。
        // create([...]): 利用這個關聯物件在資料庫建立一筆文章，同時自動在 articles 表裡把 user_id 欄位設成該使用者的 id。
        $article = $request->user()->articles()->create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'category_id' => $validated['category_id'] ?? null,
            'updated_at' => now()
        ]);
        // 根據request中的input tag(否則是空陣列)
        // sync() 會根據你提供的標籤 ID 陣列，更新 pivot table 中該文章與標籤的關聯
        //$article->tags()->sync($request->input('tags', []));
        if (!empty($validated['tags'])) {
            $article->tags()->sync($validated['tags']);
        }
        // redirect到articles.index 附上flash message
        return redirect()->route('articles.index')->with('success', '文章已建立');
    }

    public function show(Article $article): View
    {
        $article->load(['tags','user']); // Eloquent 的「延遲載入（Eager Loading）」方法。預先載入文章的 tags 與 user 關聯
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article): View
    {
        $this->authorize('update', $article); //判斷「目前登入使用者」是否有權限對 $article 這個文章執行 update 動作
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $selected = $article->tags()->pluck('id')->all(); // $article 這篇文章所有關聯標籤（tags）的 id 欄位集合，並轉成陣列。
        return view('articles.edit', compact('article','categories','tags','selected'));
    }

    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        $this->authorize('update', $article);
        $validated = $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
        'category_id' => 'exists:categories,id',
        'tags' => 'array',
        'tags.*' => 'exists:tags,id',
        ]);

        $article->update([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'category_id' => $validated['category_id'] ?? null,
            'updated_at' => now()
        ]);
        $article->tags()->sync($request->input('tags', []));

        return redirect()->route('articles.show', $article)->with('success', '文章已更新');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $this->authorize('delete', $article);
        $article->delete();
        return redirect()->route('articles.index')->with('success', '文章已刪除');
    }

    protected function syncTags($article, $tagsInput): void
    {
        $names = collect(explode(',', $tagsInput))
            ->map(fn($t) => trim($t))
            ->filter()
            ->unique();

        $tagIds = [];

        foreach ($names as $name) {
            $tag = Tag::firstOrCreate(['name' => $name]);
            $tagIds[] = $tag->id;
        }

        $article->tags()->sync($tagIds);
    }

    public function byCategory(Category $category)
    {
        $articles = $category->articles()
            ->with(['user','category','tags'])
            ->latest('published_at')
            ->paginate(10);

        return view('articles.index', [
            'articles' => $articles,
            'pageTitle' => '分類：' . $category->name,
            'selectedCategory' => $category
        ]);
    }

    public function byTag(Tag $tag)
    {
        $articles = $tag->articles()
            ->with(['user','category','tags'])
            ->latest('published_at')
            ->paginate(10);

        return view('articles.index', [
            'articles' => $articles,
            'pageTitle' => '標籤：' . $tag->name,
            'selectedTag' => $tag
        ]);
    }
    }