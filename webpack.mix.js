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

// webpack.mix.js
mix.autoload({
    'vue': ['Vue','window.Vue'],
    'moment': ['moment','window.moment'],
  });

mix.js('node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js', 'public/js');
mix.js('node_modules/bootstrap-daterangepicker/daterangepicker.js', 'public/js');
mix.js('node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css', 'public/css');
mix.js('node_modules/bootstrap-daterangepicker/daterangepicker.css', 'public/css');
mix.js('node_modules/select2/dist/js/select2.full.min.js', 'public/js');
mix.js('node_modules/select2/dist/css/select2.min.css', 'public/css');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
