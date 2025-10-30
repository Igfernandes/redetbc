const mix = require("laravel-mix");

mix.sass("public/sass/app.scss", "public/dist/frontend/css/")
    .options({
        processCssUrls: false,
        clearConsole: false
    })
    .sourceMaps();

mix.sass("public/themes/mytravel/sass/app.scss", "public/themes/mytravel/dist/frontend/css")
    .options({
        processCssUrls: false,
        clearConsole: false
    })
    .sourceMaps();

mix.webpackConfig({
    stats: {
        warningsFilter: [/^Deprecation Warning: Sass @import/]
    }
});
