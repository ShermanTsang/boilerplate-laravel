<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('getQiNiuCdnLink')) {
    function getQiNiuCdnLink($type = null)
    {
        if ($type) {
            if (strtoupper($type) === 'DEFAULT') {
                return config('services.qiniu.domain.default') ? 'http://' . config('services.qiniu.domain.default') . '/' : '[ env -> QINIU_DEFAULT_DOMAIN is empty ]';
            }
            if (strtoupper($type) === 'HTTPS') {
                return config('services.qiniu.domain.https') ? 'https://' . config('services.qiniu.domain.https') . '/' : '[ env -> QINIU_HTTPS_DOMAIN is empty ]';
            }
            if (strtoupper($type) === 'CUSTOM') {
                return config('services.qiniu.domain.custom') ? 'http://' . config('services.qiniu.domain.custom') . '/' : '[ env -> QINIU_CUSTOM_DOMAIN is empty ]';
            }
            return ' invalid parameter.';
        } else {
            if (config('services.qiniu.domain.https')) {
                return 'https://' . config('services.qiniu.domain.https') . '/';
            }
            if (config('services.qiniu.domain.custom')) {
                return '//' . config('services.qiniu.domain.custom') . '/';
            }
            if (config('services.qiniu.domain.default')) {
                return 'http://' . config('services.qiniu.domain.default') . '/';
            }
            return '[ Please set QiNiuCDN link.]';
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