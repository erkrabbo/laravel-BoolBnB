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
 .js('resources/js/home.js', 'public/js')
 .js('resources/js/braintree.js', 'public/js')
 .js('resources/js/hidingForm.js', 'public/js')
 .js('resources/js/search.js', 'public/js')
 .js('resources/js/createValidation.js', 'public/js')
 .js('resources/js/validationForm.js', 'public/js')
 .js('resources/js/validationFormEdit.js', 'public/js')
 .js('resources/js/deleteHouse.js', 'public/js')
 .js('resources/js/stats.js', 'public/js')
 .sass('resources/sass/app.scss', 'public/css')
 .copy(
     'node_modules/@fortawesome/fontawesome-free/webfonts',
     'public/webfonts'
 );
