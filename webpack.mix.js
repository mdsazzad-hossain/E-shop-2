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
    .sass('resources/sass/app.scss', 'public/css');


// mix.styles([
//     'resources/assets/css/bootstrap.css',
//     'resources/assets/css/admin.css',
//     'resources/assets/css/chartist.css',
//     'resources/assets/css/prism.css',
//     'resources/assets/css/icofont.css',
//     'resources/assets/css/flag-icon.css',
//     'resources/assets/css/fontawesome.css',

// ], 'public/css/app.css').version();

// mix.copyDirectory('resources/images', 'public/images');
// mix.copyDirectory('resources/fonts', 'public/fonts');
// mix.copyDirectory('resources/css/emoji', 'public/css/emoji');
// mix.copyDirectory('resources/videos', 'public/videos');



// mix.scripts([
//     'resources/assets/js/jquery-3.3.1.min.js',
//     'resources/assets/js/popper.min.js',
//     'resources/assets/js/bootstrap.js',
//     'resources/assets/js/icons/feather-icon/feather.min.js',
//     'resources/assets/js/icons/feather-icon/feather-icon.js',
//     'resources/assets/js/sidebar-menu.js',
//     'resources/assets/js/chart/chartist/chartist.js',
//     'resources/assets/js/chart/chartjs/chart.min.js',
//     'resources/assets/js/lazysizes.min.js',
//     'resources/assets/js/prism/prism.min.js',
//     'resources/assets/js/clipboard/clipboard.min.js',
//     'resources/assets/js/counter/jquery.waypoints.min.js',
//     'resources/assets/js/counter/jquery.counterup.min.js',
//     'resources/assets/js/counter/counter-custom.js',
//     'resources/assets/js/chart/peity-chart/peity.jquery.js',
//     'resources/assets/js/chart/sparkline/sparkline.js',
//     'resources/assets/js/admin-customizer.js',
//     'resources/assets/js/dashboard/default.js',
//     'resources/assets/js/chat-menu.js',
//     'resources/assets/js/height-equal.js',
//     'resources/assets/js/lazysizes.min.js',
//     'resources/assets/js/admin-script.js',

// ], 'public/js/app.js').version();
