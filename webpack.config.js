var path = require('path')
var LodashModuleReplacementPlugin = require('lodash-webpack-plugin');
var webpack = require('webpack')
var ManifestPlugin = require('webpack-manifest-plugin');

module.exports = {
  entry: {
    service_modal: [
      './resources/assets/js/service_modal.js',
    ],
    service_scrapper: [
      './resources/assets/js/service_scrapper.js',
    ],
  },
  output: {
    path: path.resolve(__dirname, './public/dist/js'),
    filename: "[name].js"
  },
  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: 'vue-loader',
        options: {
          loaders: {
          }
          // other vue-loader options go here
        }
      },
      {
        test: /\.js$/,
        loader: 'babel-loader',
        exclude: /node_modules/
      },
      {
        test: /\.(png|jpg|gif|svg)$/,
        loader: 'file-loader',
        options: {
          name: '[name].[ext]?[hash]'
        }
      },
      {
        test: /\.css$/,
        loaders: [ 'style-loader', 'css-loader' ]
      }
    ]
  },
  'plugins': [
    new LodashModuleReplacementPlugin,
    // new webpack.optimize.UglifyJsPlugin,
    new ManifestPlugin()
  ],
  resolve: {
    alias: {
      'vue$': 'vue/dist/vue.esm.js'
    }
  },
  devServer: {
    historyApiFallback: true,
    noInfo: true
  },
  performance: {
    hints: false
  }
}

if (process.env.NODE_ENV === 'production') {
  // module.exports.devtool = '#source-map'
  // http://vue-loader.vuejs.org/en/workflow/production.html
  module.exports.output = {
    path: path.resolve(__dirname, './public/js/'),
    filename: "[name]-[chunkhash:8].js"
  };

  // module.exports.plugins = (module.exports.plugins || []).concat([
  //   new webpack.DefinePlugin({
  //     'process.env': {
  //       NODE_ENV: '"production"'
  //     },
  //   }),
  //   new webpack.optimize.UglifyJsPlugin({
  //     sourceMap: false,
  //     compress: {
  //       warnings: false
  //     }
  //   }),
  //   new webpack.LoaderOptionsPlugin({
  //     minimize: true
  //   })
  // ])
}
