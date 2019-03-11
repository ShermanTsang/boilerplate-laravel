<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title'){{config('siteName') ?? ''}}</title>
    <meta name="keywords" content="{{config('siteKeywords') ?? ''}},@yield('keywords')">
    <meta name="description" content="{{config('siteDescription') ?? ''}} @yield('description')">
    <link rel="stylesheet" type="text/css" href="{{mix('/css/build/app.css') ?? ''}}">
    <script>if (typeof module === 'object') {window.jQuery = window.$ = module.exports;}</script>
    @yield('header')
    @stack('header')
</head>
<body id="body">
<header>
    @include('layout.header')
</header>
<main>
    @yield('content')
</main>
<footer>
    @include('layout.footer')
</footer>
<script type="text/javascript" src="{{mix('/js/build/app.js')}}"></script>
@include('component.notify')
@yield('footer')
@stack('footer')
</body>
</html>
