<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Post;

class PostComposer
{
    public function compose(View $view)
    {
        $view->with('posts', Post::latest()->take(5)->get());
    }
}