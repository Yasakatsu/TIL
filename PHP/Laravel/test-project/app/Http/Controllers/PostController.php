<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function create()
    {
        return view('post.create');
    }
    // 以下のstoreメソッドを追加
    public function store(Request $request)
    {
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
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }
}
