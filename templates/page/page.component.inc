<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_page(&$variables, $hook) {
  // Small fix to maxe the link to the start page use the alias with language.
  $variables['front_page'] = url('<front>');

  // Add information about the number of sidebars.
  if (!empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = 'ecl-col-6';
  }
  elseif (!empty($variables['page']['sidebar_first']) || !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = 'ecl-col-9';
  }
  else {
    $variables['content_column_class'] = 'ecl-col-12';
  }

  $variables['page_logo_title'] = t('Home - @sitename', ['@sitename' => variable_get('site_name', 'European Commission')]);

  $node = &$variables['node'];

  if (isset($node)) {
    // Adding generic introduction field to be later rendered in page template.
    $introduction = variable_get('ec_europa_introduction_field', FALSE);

    $variables['ec_europa_introduction'] = isset($node->{$introduction})
      ? field_view_field('node', $node, $introduction, ['label' => 'hidden']) : NULL;

    // Check if Display Suite is handling node.
    if (module_exists('ds')) {
      $layout = ds_get_layout('node', $node->type, 'full');
      if ($layout && isset($layout['is_nexteuropa']) && $layout['is_nexteuropa'] == TRUE) {
        // If our display suite layout has a header region.
        if (isset($layout['regions']['left_header'])) {
          // Move the header_bottom to the node.
          $variables['node']->header_bottom = $variables['page']['header_bottom'];
          unset($variables['page']['header_bottom']);
        }
        if (isset($variables['page']['utility'])) {
          // Move the utility to the node.
          $variables['node']->utility = $variables['page']['utility'];
          unset($variables['page']['utility']);
        }
        ctools_class_add($layout['layout']);

        if (isset($node->ds_switch) && $node->ds_switch != 'college') {
          $variables['node']->header_bottom_modifier = 'page-bottom-header--full-grey';
        }

        // This disables message-printing on ALL page displays.
        $variables['show_messages'] = FALSE;

        // Add tabs to node object so we can put it in the DS template instead.
        if (isset($variables['tabs'])) {
          $node->local_tabs = drupal_render($variables['tabs']);
        }

        // Use page__ds_node.tpl unless it is an exception.
        $custom_page_templates = ['page__gallery'];
        if (empty(array_intersect($variables['theme_hook_suggestions'], $custom_page_templates))) {
          $variables['theme_hook_suggestions'][] = 'page__ds_node';
        }
      }
    }
  }
  $variables['site_header'] = array('#theme' => array('site_header'));
  $variables['messages'] = $variables['show_messages'] ? array('#theme' => array('status_messages')) : '';
  $variables['footer'] = array(
    '#theme' => array('footer'),
    '#footer_left' => $variables['page']['footer_left'],
    '#footer_right' => $variables['page']['footer_right'],
    '#footer_middle' => $variables['page']['footer_middle'],
    '#footer_bottom' => $variables['page']['footer_bottom'],
    '#footer_improved' => $variables['page']['footer_improved'],
  );
}
