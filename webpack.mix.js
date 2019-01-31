let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

const CssList = [
    'public/vendor/toastr/toastr.min.css',
    'public/vendor/autoMenu/autoMenu.css',
    'public/vendor/highlight/highlight.min.css'
];

const jsList = [
    'public/vendor/jquery/jquery-3.2.1.min.js',
    'public/vendor/toastr/toastr.min.js',
    'public/vendor/autoMenu/autoMenu.js',
    'public/vendor/highlight/highlight.min.js',
    'public/vendor/lazyload/jquery.lazyload.min.js'
];

const markdownVendorList = [
    'public/vendor/laravel-admin-ext/editormd/editormd-1.5.0/lib/marked.min.js',
    'public/vendor/laravel-admin-ext/editormd/editormd-1.5.0/lib/prettify.min.js',
    'public/vendor/laravel-admin-ext/editormd/editormd-1.5.0/lib/raphael.min.js',
    'public/vendor/laravel-admin-ext/editormd/editormd-1.5.0/lib/underscore.min.js',
    'public/vendor/laravel-admin-ext/editormd/editormd-1.5.0/lib/sequence-diagram.min.js',
    'public/vendor/laravel-admin-ext/editormd/editormd-1.5.0/lib/flowchart.min.js',
    'public/vendor/laravel-admin-ext/editormd/editormd-1.5.0/lib/jquery.flowchart.min.js',
    'public/vendor/laravel-admin-ext/editormd/editormd-1.5.0/js/editormd.min.js',
];

mix.sass('resources/assets/sass/app.scss', 'public/css/build/app.css')
    .scripts(jsList, 'public/js/packages.js')
    .styles(CssList, 'public/css/packages.css')
    .scripts(markdownVendorList, 'public/js/build/markdown-support.js')
    .version();

