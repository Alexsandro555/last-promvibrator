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

mix.js('resources/js/app.js', 'public/js').sourceMaps().version();
mix.js('resources/js/main.js', 'public/js').sourceMaps().version();
mix.sass('resources/sass/app.scss', 'public/css', [
  require('autoprefixer')({
    browsers: ['last 40 versions']
  })
]).version();

mix.webpackConfig({
  resolve: {
    extensions: ['.js', '.vue', '.json', '.scss'],
    alias: {
      '@': __dirname + '/resources/js',
      '@product': __dirname + '/Modules/Product/Resources/assets/js',
      '@file': __dirname + '/Modules/Files/Resources/assets/js',
      '@initializer': __dirname + '/Modules/Initializer/Resources/assets/js',
      '@auth': __dirname + '/Modules/Auth/Resources/assets/js',
      '@article': __dirname + '/Modules/Article/Resources/assets/js',
      '@news': __dirname + '/Modules/News/Resources/assets/js',
      '@pages': __dirname + '/Modules/Page/Resources/assets/js',
      '@cart': __dirname + '/Modules/Cart/Resources/assets/js',
      '@callback': __dirname + '/Modules/Callback/Resources/assets/js',
      cartScss: path.resolve(__dirname + '/Modules/Cart/Resources/assets/scss'),
      articleScss: path.resolve(__dirname + '/Modules/Article/Resources/assets/sass')
    }
  }
})
