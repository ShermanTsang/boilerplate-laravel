<?php

use Symfony\Component\HttpFoundation\Response;

if (!function_exists('api_stored')) {
    /**
     * 创建资源成功后响应
     *
     * @param $data
     * @param string $message
     * @return Illuminate\Http\JsonResponse
     */
    function api_stored($data, $message = '创建成功')
    {
        return api_respond($data, $message);
    }
}

if (!function_exists('api_updated')) {
    /**
     * 更新资源成功后响应
     *
     * @param $data
     * @param string $message
     * @return Illuminate\Http\JsonResponse
     */
    function api_updated($data, $message = '更新成功')
    {
        return api_respond($data, $message);
    }
}

if (!function_exists('api_deleted')) {
    /**
     * 删除资源成功后响应
     *
     * @param string $message
     * @return Illuminate\Http\JsonResponse
     */
    function api_deleted($message = '删除成功')
    {
        return api_message($message, Response::HTTP_OK);
    }
}

if (!function_exists('api_accepted')) {
    /**
     * 请求已被放入任务队列响应
     *
     * @param string $message
     * @return Illuminate\Http\JsonResponse
     */
    function api_accepted($message = '请求已接受，等待处理')
    {
        return api_message($message, Response::HTTP_ACCEPTED);
    }
}

if (!function_exists('api_notFound')) {
    /**
     * 未找到资源响应
     *
     * @param string $message
     * @return Illuminate\Http\JsonResponse
     */
    function api_notFound($message = '您访问的资源不存在')
    {
        return api_message($message, Response::HTTP_NOT_FOUND);
    }
}

if (!function_exists('api_internalError')) {
    /**
     * 服务器端位置错误响应
     *
     * @param $message
     * @param int $code
     * @return Illuminate\Http\JsonResponse
     */
    function api_internalError($message = '未知错误导致请求失败', $code = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return api_message($message, $code);
    }
}

if (!function_exists('api_failed')) {
    /**
     * 错误的请求响应
     *
     * @param $message
     * @param int $code
     * @return Illuminate\Http\JsonResponse
     */
    function api_failed($message, $code = Response::HTTP_BAD_REQUEST)
    {
        return api_message($message, $code);
    }
}

if (!function_exists('api_success')) {
    /**
     * 成功响应
     *
     * @param $data
     * @param $withPaginator
     * @return Illuminate\Http\JsonResponse
     */
    function api_success($data, $withPaginator = false)
    {
        return $withPaginator ? api_respond_paginator($data) : api_respond($data);
    }
}

if (!function_exists('api_message')) {
    /**
     * 消息响应
     *
     * @param $message
     * @param int $code
     * @return Illuminate\Http\JsonResponse
     */
    function api_message($message, $code = Response::HTTP_OK)
    {
        return api_respond([], $message, $code);
    }
}

if (!function_exists('api_respond')) {
    /**
     * 生成响应体
     *
     * @param array $data
     * @param string $message
     * @param int $code
     * @param array $header
     * @return Illuminate\Http\JsonResponse
     */
    function api_respond($data = [], $message = '请求成功', $code = Response::HTTP_OK, array $header = [])
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data ? $data : []
        ], $code, $header);
    }
}

if (!function_exists('api_respond_paginator')) {
    /**
     * 生成响应体(带分页)
     *
     * @param array $data
     * @param string $message
     * @param int $code
     * @param array $header
     * @return Illuminate\Http\JsonResponse
     */
    function api_respond_paginator($data = [], $message = '请求成功', $code = Response::HTTP_OK, array $header = [])
    {
        $additional = [
            'code' => $code,
            'message' => $message
        ];
        return $data->additional($additional);
    }
}