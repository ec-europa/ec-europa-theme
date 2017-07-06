# EC Europa Theme

[![Build Status](https://travis-ci.org/ec-europa/ec-europa-theme.svg?branch=europa-atomium)](https://travis-ci.org/ec-europa/ec-europa-theme)

Repository containing the drupal theme for the NextEuropa platform.

The EC Europa Theme is a Drupal 7 theme, implementing the styling defined for 
the Digital Transformation of the European Commission.
This theme is based on a component driven design. 

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

The platform provides the following two modules to facilitate building your site and integrate with Views and Display Suite:
 
 - **NeextEuropa Core Views `nexteuropa_core_views`**: The module allows to set a component layout of your choice to a views row.
More information about their usage can be found in their respective README files.
- **NextEuropa Fields Formatters `nexteuropa_fields_formatters`**: The module allows to set a component layout to a field of your choice, in views 
or in the content type 'Manage fields' screen of display suite.

## Tests

Writing tests specific to the EC Europa Theme project is optional (at the moment). Developers that would like to use
Behat to test their work can do that by setting up a vanilla Drupal 7 site and installing the theme and its dependencies.

The full list of steps can be found in the `before_script:` section of [.travis.yml](.travis.yml), although setup might
vary depending on each developer's environment.

Tests can be ran via:

```
$ ./vendor/bin/behat
```
