var path = require('path')

module.exports = {
  html        : false,
  images      : true,
  fonts       : true,
  static      : true,
  svgSprite   : true,
  ghPages     : false,
  stylesheets : true,

  javascripts: {
    entry: {
      // files paths are relative to
      // javascripts.dest in path-config.json
      app: ["./app.js"]
    },

    publicPath: '/wp-content/themes/blendid-wp/public/js',

    babelLoader: {
      loader: 'babel-loader',
      exclude: /node_modules\/(?!(foundation-sites)\/).*/
    },

    provide: {
      $: "jquery",
      jQuery: "jquery",
      "window.jQuery": "jquery",
      Tether: "tether",
      "window.Tether": "tether",
      i18next: "i18next"
    }
  },

  stylesheets: {
    sass: {
      "includePaths": [
        "./node_modules"
      ]
    }
  },

  browserSync: {
    proxy: "zp.local",
    files: ["templates", "templates/views", "inc"],
    ghostMode: false
  },

  production: {
    rev: true
  }
}
