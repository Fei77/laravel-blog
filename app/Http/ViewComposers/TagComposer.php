<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Tag;

class TagComposer
{
    public function compose(View $view)
    {
        $view->with('tags', Tag::all());
    }
}