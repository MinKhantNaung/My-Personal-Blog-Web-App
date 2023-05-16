<?php

namespace App\Http\Controllers\User;

use App\Models\Project;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\LikeDislike;
use App\Models\Post;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;

class UiController extends Controller
{
    public function __construct()
    {
        $this->middleware('noAdmin');
    }

    // to index page
    public function index()
    {
        $posts = Post::when(request('search'), function ($query) {
                        $query->where('title', 'like', '%' . request('search') . '%')
                              ->orWhere('content', 'like', '%' . request('search') . '%');
                        })
                        ->latest()->paginate(6);
        $posts->appends(request()->all());
        $categories = Category::all();
        $images = Image::all();
        $topPosts = Post::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(3)
            ->get();

        return view('ui-panel.index', compact('images', 'posts', 'categories', 'topPosts'));
    }

    // to post detail when click readmore
    public function detail($id)
    {
        $post = Post::find($id);
        $likes = LikeDislike::where('type', 'like')->get();
        $dislikes = LikeDislike::where('type', 'dislike')->get();
        $isUser = LikeDislike::where('user_id', Auth::user()->id)->where('post_id', $id)->first();

        return view('ui-panel.post_detail', compact('post', 'likes', 'dislikes', 'isUser'));
    }

    // to portfolio page
    public function portfolio()
    {
        $projects = Project::all();
        $students = Student::all();
        $studentCount = Student::find(1);
        $skills = Skill::all();

        return view('ui-panel.portfolio', compact('projects', 'students', 'studentCount', 'skills'));
    }

    // to filter posts by category
    public function filter($id)
    {
        $posts = Post::where('category_id', $id)->paginate(6);
        $posts->appends(request()->all());
        $categories = Category::all();
        $images = Image::all();
        $topPosts = Post::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(3)
            ->get();

        return view('ui-panel.index', compact('images', 'posts', 'categories', 'topPosts'));
    }
}
