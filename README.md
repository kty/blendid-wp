
# Blendid Starter Theme

## Installing theme

1. Download the zip for this theme (or clone it) and move it to `wp-content/themes` in your WordPress installation. Also make sure to install ACF Pro.
2. Rename the folder to something that makes sense for your website (generally no spaces and all lowercase). You could keep the name `blendid-starter` but the point of a starter theme is to make it your own!
3. Install all needed dependecies. We are using Composer and Yarn for this. Open terminal and cd into your new folder. Run ```composer install && yarn install```
4. Activate the theme in Appearance >  Themes.
5. Run ```yarn run blendid``` to run development task, witch starts compiling, watching and live updating all our files as we change them.
6. Do your thing! And read [the docs](http://timber.github.io/timber/).

## Build theme

Build files for production with ```yarn run build```. This compiles all files to desination folder. Filenames will be hashed if rev is set to true.

## What's here?

`src/` is where you can keep your front-end scripts, styles, and images. In other words, your Sass files, JS files, fonts, and SVGs would live here.

`templates/` contains all of your Twig templates. These pretty much correspond 1 to 1 with the PHP files that respond to the WordPress template hierarchy. At the end of each PHP template, you'll notice a `Timber::render()` function whose first parameter is the Twig file where that data (or `$context`) will be used. Just an FYI.

`inc/` contains all needed theme files included by functions.php

## Other Resources

The [main Timber Wiki](http://timber.github.io/timber/) is super great, so reference those often. Also, check out these articles and projects for more info:

* [Twig for Timber Cheatsheet](http://notlaura.com/the-twig-for-timber-cheatsheet/)
* [Timber and Twig Reignited My Love for WordPress](https://css-tricks.com/timber-and-twig-reignited-my-love-for-wordpress/) on CSS-Tricks
* [Timber Video Tutorials](http://timber.github.io/timber/#video-tutorials) and [an incomplete set of screencasts](https://www.youtube.com/playlist?list=PLuIlodXmVQ6pkqWyR6mtQ5gQZ6BrnuFx-) for building a Timber theme from scratch.
