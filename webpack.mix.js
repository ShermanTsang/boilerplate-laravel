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

const CssList = [];

const jsList = [];

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
    .js('resources/assets/js/app.js', 'public/js/build/js.app')
    // .scripts(jsList, 'public/js/build/packages.js')
    // .styles(CssList, 'public/css/build/packages.css')
    // .scripts(markdownVendorList, 'public/js/build/markdown-support.js')
    .version();

