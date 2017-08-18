# Blendid WP

A WordPress starter theme based on [Blendid](https://github.com/vigetlabs/blendid) and [Timber Starter Theme](https://github.com/timber/starter-theme)

## Features

- Blendid's awesome asset pipeline setup with Gulp and Webpack.
- Twig template languange with [Timber](https://github.com/timber/timber).
- Dependency management with [Composer](https://getcomposer.org/) and [Yarn](https://yarnpkg.com/).

## Recommended setup

- [WP-CLI](https://github.com/wp-cli/wp-cli) Command-line interface for WordPress.
- [Valet](https://laravel.com/docs/5.4/valet) Laravel development environment perfect for WordPress sites.
- [Composer](https://getcomposer.org/download/) PHP dependency management with Composer.
- [Node Version Manager](https://github.com/creationix/nvm). At least Node version 6.
- [Yarn](https://yarnpkg.com) Fast and secure dependency manegement for node modules. We use Yarn instead of npm.

## Get started

1. Install [Valet](https://laravel.com/docs/5.4/valet) and follow the instructions. Create a new site for example blendid-wp.dev. Download and install WordPress there.

2. Install [ACF Pro](https://www.advancedcustomfields.com/pro/) to `wp-content/plugins` and activate it.

3. Clone this repository to `wp-content/themes`.

```bash
git clone https://github.com/alexanderalmstrom/blendid-wp.git blendid-wp
cd blendid-wp
```

4. Activate the theme in Appearance > Themes.

5. We use "name" in `package.json` to fix corrent paths and proxy. Change this to your corresponding domain name. For example domain name `blendid-wp.app` and theme name `blendid-wp`. (I use .app instead of .dev with Valet. It´s up to you what you prefer.)

Note: Domain name and theme folder name has to be the same. Otherwise you need to change browserSync proxy and publicPath in `config/task-config.js`

6. Install required node and composer dependencies.

```bash
yarn install && composer install
```

7. Start watching, compiling and live updating our files. We use BrowserSync for this.

```bash
yarn run start
```

8. That's it!

### Build for production

Compiles files for production. Filenames will be revisioned. This is where assets gets optimized and minified.

```bash
yarn run build
```

## What's here?

`src/` is where you can keep your front-end scripts, styles, and images. In other words, your Sass files, JS files, fonts, and SVGs would live here.

`templates/` contains all of your Twig templates.

`inc/` contains all needed theme files included by functions.php

## SVG Sprites

Generate SVG Sprites from svg files in `src/icons`. Blendid includes a helper whiches generates the required svg markup in `templates/macros/helpers.twig`, so you can just do:

```twig
{{ sprite(icons_path, 'my-icon') }}
```

`icons_path` is a variable defined in `inc/timber.php` and added to Timber context. This generates the icons path.

## Other Resources

[Timber Docs](https://timber.github.io/docs/)

[Twig for Timber Cheatsheet](http://notlaura.com/the-twig-for-timber-cheatsheet/)