<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('getCdn')) {
    function getCdn()
    {
        if (env('QINIU_CUSTOM_DOMAIN')) {
            return '//' . env('QINIU_CUSTOM_DOMAIN').'/';
        } else {
            return "[CDN未配置]";
        }
    }
}


if (!function_exists('getImage')) {
    function getImage($name)
    {
        $key = DB::table('resources')->where('name', $name)->value('key');
        if ($key) {
            return '//' . env('QINIU_CUSTOM_DOMAIN') . '/' . $key . '?imageView2/0/q/80|imageslim';
        } else {
            return "[\"" . $name . "\"参数未设定]";
        }
    }
}

if (!function_exists('getMenuDisplay')) {
    function getMenuDisplay()
    {
        $nav = DB::table('menus')->where('display', 1)->orderBy('order')->get();
        return $nav;
    }
}

if (!function_exists('getPageDisplay')) {
    function getPageDisplay()
    {
        $nav = DB::table('pages')->where('display', 1)->get();
        return $nav;
    }
}

if (!function_exists('getEmailAvatar')) {
    function getEmailAvatar($email, $size = '200', $default = 'retro')
    {
        if (!empty ($email)) {
            $emailHash = md5(strtolower(trim($email)));
        }
        $url = 'https://www.gravatar.com/avatar/' . $emailHash . '?s=' . $size . '&d=' . $default;
        return $url;
    }
}