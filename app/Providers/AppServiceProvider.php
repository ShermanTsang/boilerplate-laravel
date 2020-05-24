<?php

namespace App\Providers;

use App\Menu;
use App\Page;
use Illuminate\Support\Facades\Blade;
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
        Blade::withoutComponentTags();

        // 注册模版变量
//        view()->composer('layout.header', function ($view) {
//            $view->with('menuList', Menu::where('isDisplay', 1)->orderBy('order')->get());
//        });
//        view()->composer('layout.footer', function ($view) {
//            $view->with('pageList', Page::where('isDisplay', 1)->orderBy('order')->get());
//        });

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
