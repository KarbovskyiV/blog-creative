<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = Post::query()->paginate(6);
        $randomPosts = Post::query()->get()->random(4);
        $likedPosts = Post::query()->withCount('likedUsers')->orderByDesc('liked_users_count')->get()->take(4);

        return view('post.index', compact('posts', 'randomPosts', 'likedPosts'));

    }
}
