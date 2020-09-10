<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $allTags = \Cache::rememberForever('tags.list', function () {
                return \App\Tag::all();
            });

            $allGtags = \Cache::rememberForever('gtags.list', function(){
                return \App\Gtag::all();
            });

            $currentUser = auth()->user();
            $currentUrl =  current_url();

            $view->with(compact('allTags', 'currentUser', 'currentUrl', 'allGtags'));
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if($this->app->environment('local')) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
