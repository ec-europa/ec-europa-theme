# NextEuropa Core platform theme upgrade

  The release provides the components from the Digital Transformation in a drupal theme ready to use.

 ## How to upgrade
  Some blocks of content that you were using before have moved regions:
 
 ### Sitewide context
 
  * User menu: 
    - The user menu should be added to the 'Utility' region.
 
  * Service tools menu
    - The service tools menu should be removed from the 'Header top' region.
   
  * Language selector page
    - The selector provided by the custom module 'language_selector_page' is now included by default in the header.
  The block should be removed  'Header top" region.
   
   ## How to customise my site
   
   The list of components implemented in the theme can be viewed at '/atomium-overview'
   Once the theme is enabled, most of the components are already available for you to use.
   In order to facilitate the customisation of your content types, a new module `nexteuropa_formatters`is available that provides formatters for your fields.
   
    Example :

    Add a field of type link to the `basic page´ content type on admin/structure/types/manage/page/fields.
    Do not add any class during the "settings" step.
    Save your settings and move to the 'Manage display' tab.
    In the format select box facing the new field select "Link button call for action".
    Save your change and create a content with a link.
    The link is themed as a "Call to action" button.
