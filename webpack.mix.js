const { mix } = require('laravel-mix');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
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
  plugins: [
    new BrowserSyncPlugin({
      open: 'external',
      host: 'localhost',
      proxy: '/deploy/public',
      files: ['resources/views/**/*.php', 'app/**/*.php', 'routes/**/*.php']
    })
  ]
});
mix.js('resources/assets/js/app.js', 'public/js')
.sass('resources/assets/sass/app.scss', 'public/css');
