<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;

Route::get('/', fn () => redirect()->route('articles.index'));
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

// Route resource會註冊7個RestFul常見route
/*
HTTP method URI                         route name          Controller  功能
GET         /articles                   articles.index	    index()	    顯示所有文章列表
GET         /articles/create            articles.create	    create()	顯示建立新文章表單
POST	    /articles                   articles.store	    store()	    儲存新建立的文章
GET         /articles/{article}         articles.show	    show()	    顯示單一文章
GET         /articles/{article}/edit	articles.edit	    edit()	    顯示編輯文章表單
PUT/PATCH	/articles/{article}         articles.update	    update()	更新文章資料
DELETE	    /articles/{article}         articles.destroy	destroy()	刪除文章
*/
// Laravel 從上到下比對routes，如把 articles/{article} 放在上面，articles/create 就會被當作是 articles/{article}
Route::middleware(['auth', 'verified'])->group(function () {    
    Route::resource('articles', ArticleController::class)->except(['index', 'show']);
});
Route::resource('articles', ArticleController::class)->only(['index', 'show']);

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/categories/{category}', [ArticleController::class, 'byCategory'])->name('articles.byCategory');
Route::get('/tags/{tag}', [ArticleController::class, 'byTag'])->name('articles.byTag');