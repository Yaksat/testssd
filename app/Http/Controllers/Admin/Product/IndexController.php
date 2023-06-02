<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Post;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $posts = Post::All();
        return view('admin.post.index', compact('posts'));
    }
}
