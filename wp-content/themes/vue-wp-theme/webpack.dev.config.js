const path = require('path')
const webpack = require('webpack')
const { VueLoaderPlugin } = require("vue-loader");

module.exports = {
  entry: path.resolve(__dirname, 'src/app.js'),
  mode: 'development',
  devServer: {
    hot: true,
    headers: { "Access-Control-Allow-Origin": "*" },
    port: 8085,
    https: false,
    disableHostCheck: true,
    publicPath: '',
    host: 'localhost',
  },
  output: {
    path: path.resolve(__dirname, 'dist'),
    publicPath: 'http://localhost:8085/',
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
          'vue-style-loader',
          'css-loader',
        ]
      },
      {
        test: /\.(postcss)$/,
        use: [
          'vue-style-loader',
          { loader: 'css-loader', options: { importLoaders: 1 } },
          'postcss-loader'
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
  plugins: [
    new webpack.DefinePlugin({
      // Определяем все необходимые флаги
      __VUE_OPTIONS_API__: JSON.stringify(true),
      __VUE_PROD_DEVTOOLS__: JSON.stringify(true), // или true, если нужны инструменты разработки
      __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: JSON.stringify(false)
    }),
    new VueLoaderPlugin(),
    new webpack.HotModuleReplacementPlugin()
  ],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './src'),
      vue: "@vue/runtime-dom"
    },
    extensions: ['*', '.js', '.vue', '.json']
  }
}
