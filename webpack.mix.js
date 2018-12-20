let mix = require('laravel-mix');

mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.sass$/,
                use: [
                    'vue-style-loader',
                    'css-loader',
                    {
                        loader: 'sass-loader',
                        options: {
                            indentedSyntax: true
                        }
                    }
                ]
            },

        ]
    }
});

mix.js('resources/assets/js/app.js', 'public/js')
.js('resources/assets/js/admin/app.js', 'public/js/admin')
.sass('resources/assets/sass/app.scss', 'public/css');
