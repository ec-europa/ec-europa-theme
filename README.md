# Ec-Europa theme
Repository containing the drupal theme for the NextEuropa platform.

The Ec-Europa theme is a Drupal 7 theme, implementing the styling defined for 
the Digital Transformation of the European Commission.
This theme is based on a component driven design. 

Table of content:
=================
- [Installation](#a-installation)
- [Styleguide](#styleguide)
- [Helper tools](#helper-tools)
- [Developers notes](#developers-notes)

## 1. Installation

Place the content of this repository into a folder in sites/all/themes and enable the theme going to admin/appearance.
The Ec-Europa-theme uses atomium as the base theme, so you need to have also 
this theme, you can get it here: https://www.drupal.org/project/atomium .

## 2. Styleguide

The styleguide called [Europa component library](https://ec-europa.github.io/europa-component-library)
 is to be used as a reference when building your website.

## 3. Helper tools

All the templates are provided inside the theme:
 - component templates
 - views templates
 - display suite templates

The NextEuropa platform provides two modules to facilitate building your site and integrate
with views and display suite. 
More information about their usage can be found in their respective README files.

### nexteuropa_core_views

The module allows to set a component layout of your choice to a views row.

### nexteuropa_fields_formatters

The module allows to set a component layout to a field of your choice, in views 
or in the content type 'Manage fields' screen of display suite.

## 4. Developer notes

The theme implementation is a sub-theme of Atomium and follows its implementation logic.
For more information, please consult its [project page](https://www.drupal.org/project/atomium).

This theme includes a particular mechanism in order to format contents that involve HTML elements; I.E.:
* "Long text" and "Text with summary" fields;
* Custom blocks containing a markup ("body").

This mechanism is based on a namespacing CSS class put on the field value container (see "europa_preprocess_block()"
and "europa_preprocess_field()").
This css class is "ecl-editor".
