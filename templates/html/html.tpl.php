<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or
 *   'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see bootstrap_preprocess_html()
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 *
 * @ingroup themeable
 */
?><!DOCTYPE html>
<!--[if IE 8 ]>
  <html class="no-js ie8" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" prefix="<?php print $rdf_namespaces;?>">
<![endif]-->
<!--[if (gt IE 8)|!(IE)]><!-->
  <html class="no-js" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" prefix="<?php print $rdf_namespaces;?>">
<!--<![endif]-->
<head profile="<?php print $grddl_profile; ?>">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <!-- HTML5 element support for IE6-8 -->
  <!--[if lte IE 9]>
    <script src="<?php print $theme_path . '/js/libraries/matchMedia/matchMedia.js'; ?>"></script>
    <script src="<?php print $theme_path . '/js/libraries/matchMedia/matchMedia.addListener.js'; ?>"></script>
  <![endif]-->
  <!--[if lt IE 9]>
    <script src="<?php print $theme_path . '/js/libraries/html5shiv.min.js'; ?>"></script>
    <script src="<?php print $theme_path . '/js/libraries/respond.min.js'; ?>"></script>
  <![endif]-->
  <?php print $scripts; ?>
</head>
<body<?php print $attributes;?>>
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>
</html>
