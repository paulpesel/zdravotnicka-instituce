# Zdravotnická Instituce

## Installation
- Run `npm install` to install dependencies

## Gulp functions

In case gulp command is not found try
`npm install --global gulp-cli`

All commands use in console
- `gulp watch` = browsersync + scss to css compiling
- `gulp minifycss` = minify all css files to one 'main-style.min.css'
- `gulp minifyjs` = minify all js files to one 'main-js.min.js'
- `gulp deletecss` = delete 'main-style.min.css' use before next minifycss
- `gulp deletejs` = delete 'main-js.min.js' use before next minifyjs