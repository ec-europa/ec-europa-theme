<?php

/**
 * @file
 * Contains texfield component file.
 */

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_textfield(&$variables, $hook) {
  $element = &$variables['element'];
  _europa_form_set_css_class($element, array('ecl-text-input'));

  // Each function below proceeds specific pre-process related to the type of
  // textfield or to the textfield itself that is currently treated.
  // We proceed as it instead of implement a hook mechanism to weighing the
  // script execution and because in the Drupal theming system, it is not
  // possible to declare a "pre-process" function on a theme suggestion.
  _europa_preprocess_textfield__query_text($variables);

  $variables['attributes_array'] = drupal_array_merge_deep($variables['attributes_array'], $element['#attributes']);
}

/**
 * Prepares the Search box textfield (QueryText) for its specific display.
 *
 * It is related to the "search_bar" component.
 *
 * @see europa_preprocess_textfield()
 */
function _europa_preprocess_textfield__query_text(&$variables) {
  $element = &$variables['element'];
  if (empty($element['#name']) || $element['#name'] != 'QueryText') {
    return;
  }

  $element['#attributes']['class'][] = 'ecl-search-form__textfield';
  $element['#attributes']['size'] = 60;
  $element['#size'] = 60;
}
