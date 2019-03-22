<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('getQiNiuCdnLink')) {
    function getQiNiuCdnLink($type = null)
    {
        if ($type) {
            if (strtoupper($type) === 'default') {
                return env('QINIU_DEFAULT_DOMAIN') ? 'http://' . env('QINIU_DEFAULT_DOMAIN') . '/' : '[ env -> QINIU_DEFAULT_DOMAIN is empty ]';
            }
            if (strtoupper($type) === 'https') {
                return env('QINIU_HTTPS_DOMAIN') ? 'http://' . env('QINIU_HTTPS_DOMAIN') . '/' : '[ env -> QINIU_HTTPS_DOMAIN is empty ]';
            }
            if (strtoupper($type) === 'custom') {
                return env('QINIU_CUSTOM_DOMAIN') ? 'http://' . env('QINIU_CUSTOM_DOMAIN') . '/' : '[ env -> QINIU_CUSTOM_DOMAIN is empty ]';
            }
            return ' invalid parameter.';
        } else {
            return env('QINIU_HTTPS_DOMAIN') ?
                'https://' . env('QINIU_HTTPS_DOMAIN') . '/' : env('QINIU_CUSTOM_DOMAIN') ?
                    '//' . env('QINIU_CUSTOM_DOMAIN') . '/' : env('QINIU_DEFAULT_DOMAIN') ?
                        'http://' . env('QINIU_DEFAULT_DOMAIN') . '/' : '[ Please set QiNiuCDN link.]';
        }
    }
}

if (!function_exists('getAsset')) {
    function getAsset($name)
    {
        $key = DB::table('resources')->where('name', $name)->value('key');
        if ($key) {
            return getQiNiuCdnLink() . $key;
        } else {
            return $name . " - asset is not in recorder.";
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