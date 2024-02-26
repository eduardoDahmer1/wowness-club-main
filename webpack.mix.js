const mix = require('laravel-mix');

mix.js('public/assets/front/js/amityfunctions.js', 'public/js')
mix.js('resources/js/app.js', 'public/js')
    .react()
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-custom-properties')
    ]);
