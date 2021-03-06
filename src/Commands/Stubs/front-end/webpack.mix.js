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

mix
    .options({
        processCssUrls: false,
    })
    .sourceMaps(false, 'inline-source-map')
    .js('resources/js/app/app.js', 'public/js')
    .js('resources/js/admin/admin.js', 'public/js')
    .vue()
    .sass('resources/sass/admin/admin.scss', 'public/css')
    .sass('resources/sass/app/app.scss', 'public/css')
    .copy("node_modules/@fortawesome/fontawesome-free/webfonts", "public/webfonts");

if (mix.inProduction()) {
    mix.version();
}