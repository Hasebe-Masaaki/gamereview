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

mix.js('resources/js/app.js', 'public/js')
  .js('resources/js/components/modal.js', 'public/js')
  .js('resources/js/components/jquery.rateit.min.js', 'public/js')
  .js('resources/js/components/rateit.event.js', 'public/js')
  .js('resources/js/components/report.js', 'public/js')
  .js('resources/js/components/review.update.js', 'public/js')
  .js('resources/js/components/profile.update.js', 'public/js')
  .js('resources/js/components/game.update.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .sass('resources/sass/front.scss', 'public/css');
