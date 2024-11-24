<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user', 'categories')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        // $validated['slug'] = Str::slug($validated['title'], '-');
        $validated['published'] = $request->has('published');
        $validated['published_at'] = $validated['published'] ? now() : null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images');
            $validated['image'] = $path;
        }

        $post = Post::create($validated);
        $post->categories()->attach($validated['categories']);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post = Post::with('user', 'categories', 'comments.user', 'comments.replies')->where('slug', $post->slug)->firstOrFail();
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $validated = $request->validated();
        // $validated['slug'] = Str::slug($validated['title'], '-');
        $validated['published'] = $request->has('published');
        // $validated['published_at'] = $validated['published'] ? now() : null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images');
            $validated['image'] = $path;
        }

        $post->update($validated);
        $post->categories()->sync($validated['categories']);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}