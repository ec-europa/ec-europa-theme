# EC Europa Theme

[![Build Status](https://travis-ci.org/ec-europa/ec-europa-theme.svg?branch=europa-atomium)](https://travis-ci.org/ec-europa/ec-europa-theme)

Repository containing the drupal theme for the NextEuropa platform.

The Ec-Europa theme is a Drupal 7 theme, implementing the styling defined for
the Digital Transformation of the European Commission.
This theme is based on a component driven design.

Table of content:
=================
- [Installation](#a-installation)
- [Styleguide](#styleguide)
- [Tests](#tests)
- [Helper tools](#helper-tools)
- [Developers notes](#developers-notes)

## Installation

Place the content of this repository into a folder in sites/all/themes and enable the theme going to admin/appearance.
The EC Europa Theme uses atomium as the base theme, so you need to have also 
this theme, you can get it here: https://www.drupal.org/project/atomium .

## Style guide

The style guide called [Europa component library](https://ec-europa.github.io/europa-component-library)
 is to be used as a reference when building your website.

## Helper tools

All the templates are provided inside the theme:

 - component templates
 - views templates
 - display suite templates

The platform provides the following modules to facilitate building your site and to integrate with Views and Fields:

#### NextEuropa Formatters (nexteuropa_formatters)

This module provides default theme implementations for custom ECL formatters.

#### NextEuropa Formatters - Views (nexteuropa_formatters_views)

This module extends nexteuropa_formatters with custom view plugins that
render content using ECL formatters.

#### NextEuropa Formatters - Fields (nexteuropa_formatters_fields)

This module extends nexteuropa_formatters with custom field formatters that
render field value using ECL formatters.

## Tests

Writing tests specific to the EC Europa Theme project is optional (at the moment). Developers that would like to use
Behat to test their work can do that by setting up a vanilla Drupal 7 site and installing the theme and its dependencies.

The full list of steps can be found in the `before_script:` section of [.travis.yml](.travis.yml), although setup might
vary depending on each developer's environment.

Tests can be ran via:

```
$ ./vendor/bin/behat
```

## Developer notes

### Introduction

The theme implementation is a sub-theme of Atomium and follows its implementation logic.
For more information, please consult its [project page](https://www.drupal.org/project/atomium).

### WYSIWYG content formatter

This theme includes a particular mechanism in order to format contents that involve HTML elements; I.E.:
* "Long text" and "Text with summary" fields;
* Custom blocks containing a markup ("body").

This mechanism is based on a namespacing CSS class put on the field value container (see "europa_preprocess_block()"
and "europa_preprocess_field()").
This css class is "ecl-editor".

If you need to implement some specific content formats in the rich texts in your sub-theme and you want to reflect them in the WYSIWYG widget,
you just have to insert them in an "editor.css" file.<br />
This file is to be put in a repository named "wysiwyg" placed at the root of the sub-theme.

### Compile ECL

Requirements:

- [Node.js](https://nodejs.org/en/): `>= 6.9.5`
- [Yarn](https://yarnpkg.com/en/): `>= 0.20.3`

Setup your environment by running:

```
$ npm install
```

Build it by running:

```
$ npm run build
```

This will:

1. Compile ECL SASS to `./assets/css/ecl.css`
2. Transpile ECL JavaScript dependencies from `./assets/js/entry.js` to `./assets/js/ecl.js`
3. Copy ECL fonts to `./assets/fonts/`
4. Copy ECL images to `./assets/images/`

For more details about these build steps, check [`ecl-builder` documentation](https://www.npmjs.com/package/@ec-europa/ecl-builder)

## Update ECL

Update the ECL by changing the `@ec-europa/ecl-components-preset-base` version in `package.json` and running:

```
$ npm run build
```

This will update assets such as images and fonts and re-compile CSS, resulting changes are meant to be committed to this
repository since we cannot require theme users and/or deployment procedures to build the theme locally.
