# Ec-Europa theme
Repository containing the drupal theme for the NextEuropa platform.

The Ec-Europa theme is a Drupal 7 theme, implementing the styling defined for 
the Digital Transformation of the European Commission.
This theme is based on a component driven design. 

### 1. Installation

Place the content of this repository into a folder in sites/all/themes and enable the theme going to admin/appearance.
The Ec-Europa-theme uses atomium as the base theme, so you need to have also 
this theme, you can get it here: https://www.drupal.org/project/atomium .

### 2. Styleguide

The styleguide called [Europa component library](https://ec-europa.github.io/europa-component-library)
 is to be used as a reference when building your website.

### 3. Helper tools

All the templates are provided inside the theme:
 - component templates
 - views templates
 - display suite templates

The platform provides two modules to facilitate building your site and integrate
with views and display suite. 
More information about their usage can be found in their respective README files.

#### nexteuropa_formatters

This module provides default theme implementations for custom ECL formatters

#### nexteuropa_formatters_views

This module extends nexteuropa_formatters with custom view plugins that
render content using ECL formatters

###nexteuropa_fields_formatters

The module allows to set a component layout to a field of your choice, in views 
or in the content type 'Manage fields' screen of display suite.