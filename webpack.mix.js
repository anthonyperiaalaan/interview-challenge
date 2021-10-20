const mix = require('laravel-mix')
const config = require('./webpack.config')

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
  .sass('resources/css/app.scss', 'public/css')
  .options({
    postCss: [
      require('postcss-easy-import'),
      require('tailwindcss'),
      require('autoprefixer'),
    ],
  })
  .vue()
  .sourceMaps(false)
  .version()
  .webpackConfig(config)
