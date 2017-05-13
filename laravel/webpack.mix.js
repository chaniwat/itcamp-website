const path = require('path');
const { mix } = require('laravel-mix');

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
  output: {
    path: path.resolve(__dirname, '../public_html')
  }
});

// mix.sass('resources/assets/sass/backend/backend.scss', 'assets/backend/css/app.css');
