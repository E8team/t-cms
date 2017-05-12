const { mix } = require('laravel-mix');
let path = require('path');
mix.webpackConfig({
    module: {
        loaders: [
            {
                test: /\.js$/,
                loader: 'babel',
                exclude: /node_modules/
            },
            {
                test: /\.css$/,
                loader: 'style-loader!css-loader'
            }
        ]
    }
});
mix .setPublicPath('public/static/default')
    .js(path.join(__dirname, 'assets/js/app.js'), 'js/app.js')
    .js(path.join(__dirname, 'assets/js/phaser.js'), 'js/phaser.js')
    .less(path.join(__dirname, 'assets/less/app.less'), 'css/app.css')
    .copy('node_modules/bootstrap/dist/css/bootstrap.min.css', '../../public/static/default/css/bootstrap.min.css')
    .copy('node_modules/bootstrap/fonts', '../../public/static/default/fonts')
    .version();

