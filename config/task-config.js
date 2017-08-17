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

    publicPath: "/wp-content/themes/blendid-starter/public/javascripts",

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
    proxy: "blendid-starter.app",
    files: ["templates", "inc"]
  },

  production: {
    rev: true
  }
}
