var path = require('path')
var packageJSON = require('../package.json')

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

    publicPath: path.join('/wp-content/themes', packageJSON.name, 'public/javascripts'),

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
        "./node_modules/bourbon/app/assets/stylesheets",
        "./node_modules/bootstrap/scss",
        "./node_modules/slick-carousel/slick",
        "./node_modules/font-awesome/scss",
        "./node_modules/tooltipster/src/css",
        "./node_modules/tooltipster/src/css/plugins/tooltipster/sideTip"
      ]
    }
  },

  browserSync: {
    proxy: packageJSON.name + ".app",
    files: ["templates", "inc"]
  },

  production: {
    rev: true
  }
}
