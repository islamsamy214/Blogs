const mix = require('laravel-mix');

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

mix.webpackConfig({
    stats: {
            children: true,
        },
    }).options({
        terser: {
            extractComments: false,
        },
    }).js('resources/js/app.js', 'public/js')
    .vue({ version: 2 })
    .postCss("resources/css/app.css", "public/css")
    .version();