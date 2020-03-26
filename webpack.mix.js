let mix = require('laravel-mix');

// JS files
mix.js('resources/js/app.js', 'public/js')

// Tailwind with purgeCSS
mix.postCss('resources/css/main.css', 'public/css', [
    require('tailwindcss'),
    require('autoprefixer'),
    ...process.env.NODE_ENV === 'production' ? [
        require('@fullhuman/postcss-purgecss')({

            // Specify the paths to all of the template files in your project
            content: [
                './resources/views/**/*.blade.php',
            ],

            // Include any special characters you're using in this regular expression
            defaultExtractor: content => content.match(/[\w-/:]+(?<!:)/g) || []
        })
    ] : [],
]);

if (mix.inProduction()) {
    mix.version();
}
