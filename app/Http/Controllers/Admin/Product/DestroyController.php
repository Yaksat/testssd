<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Post;

class DestroyController extends BaseController
{
    public function __invoke(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.post.index');
    }
}
