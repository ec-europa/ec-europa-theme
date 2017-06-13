<?php

/**
 * @file
 * Contains texfield component file.
 */

/**
 * Implements hook_preprocess_HOOK() for the form textfield.
 */
function europa_preprocess_textfield(&$variables, $hook) {
  $element = &$variables['element'];
  _europa_form_set_css_class($element, array('ecl-text-input'));

  $variables['attributes_array'] = drupal_array_merge_deep($variables['attributes_array'], $element['#attributes']);
}
