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


mix.sass('resources/assets/sass/app.scss', 'public/css/build/app.css')
    .js('resources/assets/js/app.js', 'public/js/build/app.js')
    // .scripts(jsList, 'public/js/build/packages.js')
    // .styles(CssList, 'public/css/build/packages.css')
    .version();

