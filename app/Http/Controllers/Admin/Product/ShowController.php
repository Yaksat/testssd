<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Post;

class ShowController extends BaseController
{
    public function __invoke(Post $post)
    {
        return view('admin.post.show', compact('post'));
    }
}
