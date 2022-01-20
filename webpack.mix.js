const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/about_us.js', 'public/js')
    .js('resources/js/contact.js', 'public/js')
    .js('resources/js/my_order.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
