const path = require('path')
const { VueLoaderPlugin } = require("vue-loader");
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const TerserPlugin = require('terser-webpack-plugin');

module.exports = {
  entry: path.resolve(__dirname, 'src/app.js'),
  mode: 'production',
  output: {
    path: path.resolve(__dirname, 'dist'),
    publicPath: '/wp-content/themes/vue-cok/dist/',
    filename: 'vue-wordpress.js'
  },
  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: 'vue-loader'
      },
      {
        test: /\.css$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader'
        ]
      },
      {
        test: /\.(jpg|png|gif|woff|eot|ttf|svg)/,
        use: {
          loader: 'url-loader', // this need file-loader
          options: {
            limit: 50000
          }
        }
      }
    ]
  },
  optimization: {
    minimizer: [
      new CssMinimizerPlugin(),
      new TerserPlugin({
        terserOptions: {
          compress: {
            drop_console: false, // Удаляет console.log
          },
          output: {
            comments: false, // Удаляет комментарии
          },
        },
      }),
    ],
  },
  plugins: [
    new VueLoaderPlugin(),
    new MiniCssExtractPlugin({
      filename: 'vue-wordpress.css'
    })
  ],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './src'),
      vue: "@vue/runtime-dom"
    },
    extensions: ['*', '.js', '.vue', '.json']
  }
}
