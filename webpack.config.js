var webpack = require('webpack');

module.exports = {
  entry: {
    app: ['babel-polyfill', './resources/assets/js/app.js']
  },

  plugins: [
    new webpack.ProvidePlugin({
      $: "jquery",
      jQuery: "jquery",
      "windows.jQuery": "jquery",
      'window.$': 'jquery',
    }),
  ]
};