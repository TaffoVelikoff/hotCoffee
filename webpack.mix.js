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

mix.setPublicPath('public');

//===== ADMIN =====//
mix.styles([
	'resources/css/admin/argon.css',
	'resources/css/admin/admin.css',
	'resources/vendor/animate.css',
	'resources/vendor/croppie/croppie.css',
], 'public/css/admin.min.css').version();

mix.js([
    'resources/js/admin/argon.js',
    'resources/js/admin/admin.js',
], 'public/js/admin.min.js').version();

mix.scripts([
	'resources/vendor/jquery/dist/jquery.min.js',
	'resources/vendor/bootstrap/dist/js/bootstrap.bundle.min.js',
	'resources/vendor/notify.min.js',
	'resources/vendor/croppie/croppie.min.js',
    'resources/vendor/exif.js',
    'resources/vendor/chart.js/dist/Chart.min.js',
    'resources/vendor/chart.js/dist/Chart.extension.js',
    'resources/vendor/jquery-ui.js'
], 'public/js/admin-vendor.min.js').version();

//===== FRONTEND =====//
/*mix.js([
], 'public/assets/js/app.min.js').version();*/