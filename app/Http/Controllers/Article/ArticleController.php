<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $data = Article::latest()->paginate(6);
        return view('articles.index',[
            'articles' => $data
        ]);
    }
    public function detail($id)
    {
        $data = Article::find($id);
        return view('articles.detail', [
            'article' => $data
        ]);
    }
    public function add()
    {
        $data = [
            ['id' => 1, 'name' => 'News'],
            ['id' => 2, 'name' => 'Tech']
        ];
        return view('articles.add', [
            'categories' => $data
        ]);
    }
    public function create()
    {
        $validator = validator(request()->all(), [
            'name' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $article = new Article;
        $article->title = request()->title;
        $article->body =  request()->body;
        $article->category_id = request()->category_id;
        $category->user_id = auth()->user()->id;
        $article->save();
        return redirect('/articles');
    }
    public function delete($id)
    {
        $article = Article::find($id);
        if(Gate::allows('article-update-delete', $article)) {
            $article->delete();
            return redirect('/articles')->with('info','Your article is deleted.');
        }else {
            return back()->with('error','no authorization');
        }
    }
    public function edit($id)
    {
        $data = Article::find($id);
        return view('articles.edit', [
            'article' => $data
        ]);
    }
    public function update($id)
    {
        $article = Article::find($id);
        if(Gate::allows('article-update-delete', $article)) {
            $article->title = request()->title;
            $article->body = request()->body;
            $article->save();
            return redirect('/articles');
        }else {
            return back()->with('error','no authorization');
        }
    }
    public function __construct()
    {
        $this->middleware('auth')->except(['index','detail']);
    }
}
