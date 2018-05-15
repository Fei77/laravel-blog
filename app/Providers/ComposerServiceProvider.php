<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['_includes.widgets.categories'], 'App\Http\ViewComposers\CategoryComposer');

        View::composer(['_includes.widgets.posts'], 'App\Http\ViewComposers\PostComposer');

        View::composer(['_includes.widgets.tags'], 'App\Http\ViewComposers\TagComposer');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
