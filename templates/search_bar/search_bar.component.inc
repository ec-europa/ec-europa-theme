<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_hook().
 */
function europa_atomium_theme_search_bar() {
  return array(
    'search_bar' => array(
      'template' => 'search-bar',
      'variables' => array(
        'search_form' => NULL,
      ),
    ),
  );
}

/**
 * Implements hook_atomium_definition_hook().
 */
function europa_atomium_definition_search_bar() {
  return array(
    'label' => 'Search bar',
    'description' => 'Search bar.',
  );
}

/**
 * Implements hook_preprocess_hook().
 *
 * The final display of search bar is managed by this component and a variant
 * of the form_element component.
 *
 * @see _europa_preprocess_form_element__QueryText()
 * @see _europa_preprocess_textfield__QueryText()
 */
function europa_preprocess_search_bar(&$variables, $hook) {
  // If "nexteuropa_europa_search" module is disabled,
  // no need to continue the hook process.
  if (!module_exists('nexteuropa_europa_search')) {
    return;
  }

  // Generate the search form.
  $variables['search_form'] = drupal_get_form('nexteuropa_europa_search_search_form');

  // Add CSS to the form tag.
  $variables['search_form']['#attributes']['class'][] = 'ecl-search-form';

  // Shortcut.
  $block_search_input = &$variables['search_form']['search_input_group'];

  // Remove incompatible container from the form.
  unset($block_search_input['#prefix']);
  unset($block_search_input['#suffix']);

  // Add CSS in search button.
  $submit_classes = &$block_search_input['europa_search_submit']['#attributes']['class'];
  $submit_classes[] = 'ecl-button--form';
  $submit_classes[] = 'ecl-search-form__button';
}
