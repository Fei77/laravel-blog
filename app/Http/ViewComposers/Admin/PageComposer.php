<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Page;

class PageComposer
{
    public function compose(View $view)
    {
        $view->with('pages', Page::orderBy('order')->get());
    }
}