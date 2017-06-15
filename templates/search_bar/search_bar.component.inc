<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_HOOK().
 */
function europa_atomium_theme_search_bar() {
  return array(
    'search_bar' => array(
      'template' => 'search-bar',
      'variables' => array(
        'search_form' => module_invoke('nexteuropa_europa_search', 'block_view', 'nexteuropa_europa_search_form'),
      ),
    ),
  );
}

/**
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_search_bar() {
  return array(
    'label' => 'Site search bar',
    'description' => 'Site search bar.',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 *
 * The final display of search bar is managed by this component and a variant
 * of the form_element component.
 *
 * @see _europa_preprocess_form_element__QueryText()
 * @see _europa_preprocess_textfield__QueryText()
 */
function europa_preprocess_search_bar(&$variables) {
  // If the "nexteuropa_europa_search" module is disabled, no need to continue
  // the hook process.
  if (!module_exists('nexteuropa_europa_search')) {
    return;
  }

  $block_search_input = &$variables['search_form']['content']['search_input_group'];

  // Remove incompatible container from the form.
  unset($block_search_input['#prefix']);
  unset($block_search_input['#suffix']);

  // Add ccs to the form tag.
  $variables['search_form']['content']['#attributes']['class'][] = 'ecl-search-form';

  // Add css in search button.
  $submit_classes = &$block_search_input['europa_search_submit']['#attributes']['class'];
  $submit_classes[] = 'ecl-button--form';
  $submit_classes[] = 'ecl-search-form__button';
}
