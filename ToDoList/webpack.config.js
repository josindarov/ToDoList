const path = require('path');
const VueLoaderPlugin = require('vue-loader/lib/plugin');

module.exports = {
    entry: './resources/js/app.js',

    output: {
        filename: 'bundle.js',
        path: path.resolve(__dirname, 'public/js'),
    },

    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader',
            },
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env'],
                    },
                },
            },
            {
                test: /\.scss$/,
                use: [
                    'vue-style-loader',
                    'scss-loader',
                    'sass-loader',
                ],
            },
            {
                test: /\.css$/,
                use: [
                    'vue-style-loader',
                    'scss-loader',
                ],
            },
        ],
    },

    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            vue$: 'vue/dist/vue.esm.js',
            '@': path.resolve('resources/js'),
        },
    },

    plugins: [
        new VueLoaderPlugin(),
    ],
};
