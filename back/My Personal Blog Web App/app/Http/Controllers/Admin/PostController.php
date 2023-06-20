<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(4);

        $posts->appends(request()->all());
        return view('admin-panel.posts.index', compact('posts'));
    }

    // to create posts page
    public function create()
    {
        $categories = Category::all();

        return view('admin-panel.posts.create', compact('categories'));
    }

    // to create posts
    public function createPosts(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'image' => 'required|file|max:10000|image|mimetypes:image/jpg,image/jpeg,image/png,image/svg,image/webp',
            'title' => 'required|unique:posts,title',
            'content' => 'required|min:100',
        ]);

        $newImage = uniqid() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/post_images/', $newImage);

        Post::create([
            'category_id' => $request->category_id,
            'image' => $newImage,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index')->with('successMsg', 'Successfully created a post!');
    }

    // to posts detail page
    public function detail($id)
    {
        $post = Post::find($id);

        return view('admin-panel.posts.detail', compact('post'));
    }

    // to edit posts page
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();

        return view('admin-panel.posts.edit', compact('post', 'categories'));
    }

    // to update post
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'image' => 'file|max:10000|image|mimetypes:image/jpg,image/jpeg,image/png,image/webp,image/svg',
            'title' => 'required|unique:posts,title,' . $id,
            'content' => 'required|min:100',
        ]);

        $post = Post::find($id);

        if ($request->hasFile('image')) {
            $oldImage = $post->image;
            Storage::delete('public/post_images/' . $oldImage);

            $newImage = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/post_images/', $newImage);

            $post->update([
                'image' => $newImage,
            ]);
        }

        $post->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index');
    }

    // to delete post
    public function delete($id)
    {
        $post = Post::find($id);

        Storage::delete('public/post_images/' . $post->image);
        $post->delete();

        return back()->with('successMsg', 'Successfully deleted a post!');
    }

    public function manageComments($id)
    {
        $post = Post::find($id);

        return view('admin-panel.posts.comment', compact('post'));
    }

    public function showHide($id)
    {
        $comment = Comment::find($id);

        if ($comment->status == 'show') {
            $comment->update([
                'status' => 'hide',
            ]);

            return back();
        } else {
            $comment->update([
                'status' => 'show',
            ]);

            return back();
        }
    }
}
