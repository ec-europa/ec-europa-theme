<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_form_element(&$variables, $hook) {
  $element = &$variables['element'];
  if (!empty($element['#name'])) {
    $variables['theme_hook_suggestions'][] = 'form_element__' . $element['#name'];
  }

  $variables['theme_hook_suggestions'][] = 'form_element__' . $element['#id'];

  // Each function below proceeds specific pre-process related to the type of
  // form element or to the form element itself that is currently treated.
  // We proceed as it instead of implement a hook mechanism to weighing the
  // script execution and because in the Drupal theming system, it is not
  // possible to declare a "pre-process" function on a theme suggestion.
  _europa_preprocess_form_element__search_block_form($variables);
}

/**
 * Prepares the Search box form element for its specific display.
 *
 * It is related to the "search_bar" component.
 *
 * @see europa_preprocess_form_element()
 */
function _europa_preprocess_form_element__search_block_form(&$variables) {
  $element = &$variables['element'];
  if (empty($element['#name']) || $element['#name'] != 'search_block_form') {
    return;
  }

  if (isset($variables['label'])) {
    // Store the form element label in a easier accessible parameter.
    $variables['displayed_label'] = $variables['label']['element']['#title'];
  }
}
