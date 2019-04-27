<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('getQiNiuCdnLink')) {
    function getQiNiuCdnLink($type = null)
    {
        if ($type) {
            if (strtoupper($type) === 'DEFAULT') {
                return env('QINIU_DEFAULT_DOMAIN') ? 'http://' . env('QINIU_DEFAULT_DOMAIN') . '/' : '[ env -> QINIU_DEFAULT_DOMAIN is empty ]';
            }
            if (strtoupper($type) === 'HTTPS') {
                return env('QINIU_HTTPS_DOMAIN') ? 'https://' . env('QINIU_HTTPS_DOMAIN') . '/' : '[ env -> QINIU_HTTPS_DOMAIN is empty ]';
            }
            if (strtoupper($type) === 'CUSTOM') {
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

if (!function_exists('isIncludeBaseUrl')) {
    function isIncludeBaseUrl($originPath)
    {
        return preg_match('/(^http:\/\/)|(^https:\/\/)|(^\/\/)/i', $originPath);
    }
}

if (!function_exists('getCleanAssetUrl')) {
    function getCleanAssetUrl($originPath)
    {
        return isIncludeBaseUrl($originPath) ?
            preg_replace('/((^http:\/\/)|(^https:\/\/)|(^\/\/))(.*?\/)/i', '', $originPath) :
            $originPath;
    }
}

if (!function_exists('getQiNiuCdnAsset')) {
    function getQiNiuCdnAsset($path)
    {
        return getQiNiuCdnLink() . getCleanAssetUrl($path);
    }
}

if (!function_exists('getFileAsset')) {
    function getFileAsset($key)
    {
        $key = DB::table('admin_file_assets')->where('key', $key)->value('url');
        if ($key) {
            return getQiNiuCdnLink() . $key;
        } else {
            return $key . " - file asset is not in recorder.";
        }
    }
}

if (!function_exists('getImageAsset')) {
    function getImageAsset($key)
    {
        $key = DB::table('admin_image_assets')->where('key', $key)->value('url');
        if ($key) {
            return getQiNiuCdnLink() . getCleanAssetUrl($key);
        } else {
            return $key . " - image asset is not in recorder.";
        }
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