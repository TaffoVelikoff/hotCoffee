let mix = require('laravel-mix');

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

mix.setPublicPath('src/public');

//===== ADMIN =====//
mix.styles([
	'src/resources/css/admin/argon.css',
	'src/resources/css/admin/admin.css',
	'src/resources/vendor/animate.css',
	'src/resources/vendor/croppie/croppie.css',
], 'src/public/css/admin.min.css').version();

mix.js([
    'src/resources/js/admin/argon.js',
    'src/resources/js/admin/admin.js',
], 'src/public/js/admin.min.js').version();

mix.scripts([
	'src/resources/vendor/jquery/dist/jquery.min.js',
	'src/resources/vendor/bootstrap/dist/js/bootstrap.bundle.min.js',
	'src/resources/vendor/notify.min.js',
	'src/resources/vendor/croppie/croppie.min.js',
    'src/resources/vendor/exif.js',
    'src/resources/vendor/chart.js/dist/Chart.min.js',
    'src/resources/vendor/chart.js/dist/Chart.extension.js'
], 'src/public/js/admin-vendor.min.js').version();

//===== FRONTEND =====//
/*mix.js([
], 'public/assets/js/app.min.js').version();*/