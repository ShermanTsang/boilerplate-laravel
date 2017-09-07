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

let CssList = [
    'public/vendor/toastr/toastr.min.css',
    'public/vendor/autoMenu/autoMenu.css',
    'public/vendor/highlight/highlight.min.css',
    'public/vendor/fancyBox3/jquery.fancybox.min.css'
];

let jsList = [
    'public/vendor/jquery/jquery-3.2.1.min.js',
    'public/vendor/toastr/toastr.min.js',
    'public/vendor/autoMenu/autoMenu.js',
    'public/vendor/highlight/highlight.min.js',
    'public/vendor/fancyBox3/jquery.fancybox.min.js'
];

mix.sass('resources/assets/sass/app.scss', 'public/css/app.css')
    .scripts(jsList, 'public/js/packages.js')
    .styles(CssList, 'public/css/packages.css')
    .version();

