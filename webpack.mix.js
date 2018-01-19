const { mix } = require("laravel-mix");

mix
    .js("resources/assets/js/app.js", "public/js/gardens.js")
    .sass("resources/assets/sass/app.scss", "public/css/gardens.css");
