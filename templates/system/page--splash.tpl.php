<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 * - $field_introduction: field that should be available in most of the
 *   content types.
 *
 * Regions:
 * - $page['header']:         Displayed in the right part of the
 *                            header -> logo, search box, ...
 * - $page['header_bottom']:  Displayed below the header, take full width of
 *                            site -> main menu, global information,
 *                            breadcrumb...
 * - $page['highlighted']:    Displayed in a big visible box -> important
 *                            message, contextual information, ...
 * - $page['help']:           Displayed between page title and
 *                            content -> information about the page,
 *                            contextual help, ...
 * - $page['sidebar_first']:  Small sidebar displayed on left of the content,
 *                            if not empty -> navigation, pictures, ...
 * - $page['sidebar_second']: Large sidebar displayed on right of the content,
 *                            if not empty -> two column layout
 * - $page['content']:        The main content of the current page.
 * - $page['footer']:         Displayed at bottom of the page, on full
 *                            width -> latest update, copyright, ...
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>
<section class="main-content splash-page">

  <a id="main-content" tabindex="-1"></a>

  <header class="site-header splash-page__site-header" role="banner">
    <div class="container">
      <span class="<?php print $logo_classes; ?>"></span>
    </div>
  </header>

  <div class="page-content splash-page__content">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <?php print render($page['content']); ?>
        </div>
      </div>
    </div>
  </div>
</section>
