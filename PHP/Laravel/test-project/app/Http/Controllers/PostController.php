<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function create()
    {
        return view('post.create');
    }
    // 新規投稿を保存するstoreメソッドを追加
    public function store(Request $request)
    {
        Gate::authorize('test');
        // バリデーションを追加
        $validated = $request->validate(
            [
                'title' => 'required|max:20',
                'body' => 'required|max:400',
            ]
        );
        // ユーザーIDを追加
        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);
        // フラッシュメッセージを追加
        $request->session()->flash('message', '投稿が完了致しました。');
        return back();
    }

    // 以下のindexメソッドを追加
    public function index()
    {
        // viewメソッドの第二引数に$postsを渡す (compact関数を使用)
        // compact関数は変数名をキー、変数の値を値とする連想配列を返す
        // ログインユーザーの投稿のみを取得
        // $posts = Post::all();

        // ログインユーザーの投稿のみを取得
        // $posts = Post::where('user_id', auth()->id())->get();

        // ログインユーザー以外の投稿のみを取得
        // $posts = Post::where('user_id', '!=', auth()->id())->get();

        // データの内容を新しい順に取得
        // with()メソッド：DBへは一度のアクセスで済む
        $posts = Post::latest()->with('user')->get();

        return view('post.index', compact('posts'));
    }
}
