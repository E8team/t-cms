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
mix .setPublicPath('public/static/jsj')
    .setResourceRoot('/static/jsj/')
    .js(path.join(__dirname, 'assets/js/app.js'), 'js/app.js')
    .less(path.join(__dirname, 'assets/less/app.less'), 'css/app.css')
    .copy('node_modules/bootstrap/dist/css/bootstrap.min.css', '../../public/static/jsj/css/bootstrap.min.css')
    .copy('node_modules/bootstrap/fonts', '../../public/static/jsj/fonts')
    .copy(path.join(__dirname, 'assets/resources/images'), '../../public/static/jsj/images')
    .version();
