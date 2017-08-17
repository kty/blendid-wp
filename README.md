# Blendid WP

A WordPress starter theme based on [Blendid](https://github.com/vigetlabs/blendid) and [Timber Starter Theme](https://github.com/timber/starter-theme)

## Features

- Blendid's awesome asset pipeline setup with Gulp and Webpack.
- Twig template languange with [Timber](https://github.com/timber/timber)

## Recommended setup

- [WP-CLI](https://github.com/wp-cli/wp-cli) Command-line interface for WordPress.
- [Valet](https://laravel.com/docs/5.4/valet) Laravel development environment perfect for WordPress sites.
- [Node Version Manager](https://github.com/creationix/nvm). At least Node version 6.
- [Yarn](https://yarnpkg.com) Fast and secure dependency manegement. We use Yarn instead of npm.

## Get started

Install [Valet](https://laravel.com/docs/5.4/valet) and follow the instructions. Create a new site for example blendid-wp.dev. Download and install WordPress there.

Install [ACF Pro](https://www.advancedcustomfields.com/pro/) to `wp-content/plugins` and activate it.

Clone this repository to `wp-content/themes`.

```bash
git clone https://github.com/alexanderalmstrom/blendid-wp.git blendid-wp
cd blendid-wp
```

Activate the theme in Appearance > Themes.

Change BrowserSync proxy to corresponding domain name, for example blendid-wp.dev. Also change publicPath to correct theme path. You find these settings in `config/task-config.js`.

Install required node and composer dependencies.

```bash
yarn install && composer install
```

Start watching, compiling and live updating our files. We use BrowserSync for this.

```bash
yarn run start
```

That's it!

### Build for production

Compiles files for production. Filenames will be revisioned. This is where assets gets optimized and minified.

```bash
yarn run build
```

## What's here?

`src/` is where you can keep your front-end scripts, styles, and images. In other words, your Sass files, JS files, fonts, and SVGs would live here.

`templates/` contains all of your Twig templates.

`inc/` contains all needed theme files included by functions.php

## Other Resources

[Timber Docs](https://timber.github.io/docs/)
[Twig for Timber Cheatsheet](http://notlaura.com/the-twig-for-timber-cheatsheet/)