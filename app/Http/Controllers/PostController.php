<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.posts.index')
        ->with('posts', Post::where('user_id', auth()->id())->get())
        ->with('posts', Post::filter($request->toArray())->paginate());
    }

    public function show(Post $post)
    {
        return view('front.blog.post', ['post' => $post]);
    }

    public function showPosts(Request $request)
    {
        return view('front.blog.index')->with('posts', Post::filterByPostStatus()->filterByPostDate()->filter($request->toArray())->paginate(9));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StorePost $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['cover_photo'] = $request->file('cover_photo')->store('images', 'public');

        if ($request->banner) {
            $data['banner'] = $request->file('banner')->store('images', 'public');
        }

        $post = Post::create($data);
        $post->save();

        return to_route('posts.index');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit')->with('post', $post);
    }

    public function update(UpdatePost $request, Post $post)
    {
        $data = $request->validated();

        if ($request->banner) {
            $data['banner'] = $request->file('banner')->store('images', 'public');
        }

        if ($request->cover_photo) {
            $data['cover_photo'] = $request->file('cover_photo')->store('images', 'public');
        }

        if (!$request->banner) {
            $data['banner'] = null;
        }

        if (!$request->status) {
            $data['status'] = false;
        }

        $post->update($data);

        return to_route('posts.index');
    }

    public function destroy(Post $post)
    {
        Storage::disk('public')->delete($post->cover_photo);

        if ($post->banner) {
            Storage::disk('public')->delete($post->banner);
        }
        $post->delete();
        return to_route('posts.index');
    }

    public function changeStatus(Post $post)
    {
        $post->status = !$post->status;
        $post->save();

        return redirect()->route('posts.index');
    }
}
