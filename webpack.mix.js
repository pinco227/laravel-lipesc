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

mix.js('resources/js/app.js', 'public/js').sourceMaps();
mix.sass('resources/sass/app.scss', 'public/css');
mix.copy('resources/js/custom.js', 'public/js/custom.js');
mix.copy('resources/js/landing-page.js', 'public/js/landing-page.js');
mix.copy('resources/js/cart.js', 'public/js/cart.js');
mix.copy('node_modules/card/dist/jquery.card.js', 'public/js/jquery.card.js');
mix.copy('node_modules/card/dist/card.css', 'public/css/card.css');
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');
