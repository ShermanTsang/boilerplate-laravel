<?php

namespace App\Providers;

use App\Menu;
use App\Page;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Encore\Admin\Config\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Config::load();
        \Carbon\Carbon::setLocale('zh');
        view()->composer('layout.header', function ($view) {
            $view->with('menuList', Menu::query()->where('isDisplay', 1)->orderBy('order')->get());
        });
        view()->composer('layout.footer', function ($view) {
            $view->with('pageList', Page::query()->where('isDisplay', 1)->orderBy('order')->get());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
