<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::paginate(5);
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'title' => 'required|max:20',
                'body' => 'required|max:400',
            ]
        );
        $validated['user_id'] = auth()->id();
        $post = Post::create($validated);
        session()->flash('message', '保存しました。');
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate(
            [
                'title' => 'required|max:20',
                'body' => 'required|max:400',
            ]
        );
        $post->update($validated);
        session()->flash('message', '更新しました。');
        return redirect()->route('post.index', compact('post'));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        session()->flash('message', '削除しました。');
        return redirect()->route('post.index');
    }
}
