const webpack = require('webpack') //sistema de modulos que node entende
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')

module.exports = {
    mode: 'development',
    entry: "./src/app.jsx",
    output: {
        path: __dirname + '/public',
        filename: 'app.jsx'
    },
    // // module:{
    // //     rules:[{
    // //         loader: 'babel-loader',
    // //         test: '/\.(js|jsx)$/',
    // //         exclude: /node_modules/
    // //     }]
    // // },
    // // devtool: 'cheap-module-eval-source-map',
    // devServer: {
    //     port:3000,
    //     contentBase: __dirname+ '/public'
    // },
    // resolve: {
    //     extensions: [' ', '.js', '.jsx'],
    //     alias: {
    //         modules: __dirname+'/node_modules',
    //         jquery: 'modules/admin-lte/plugins/jquery/jquery.min',
    //         boostrap: 'modules/bootstrap/dist/js/bootstrap.js'
    //     }
    // },
    plugins: [
        new MiniCssExtractPlugin({
            filename: "estilo.css"
        }),
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery'
        }),
        new ExtractTextPlugin('app.css')
    ],
    module: {
        rules: [{
            test: /.js[x]?$/,
            loader: 'babel-loader',
            exclude: /node_modules/,
            // query: {
            //     presets: ['es2015', 'react'],
            //     plugins: ['transform-object-rest-spread']
            // }
        }, {
            test: /\.css$/,
            loader: ExtractTextPlugin.extract(
                // 'style-loader',
                'css-loader',
                MiniCssExtractPlugin)
        }, {
            test: /\.woff|.woff2|.ttf|.eot|.svg|.png|.jpg*.*$/,
            loader: 'file'
        }]
    }
}