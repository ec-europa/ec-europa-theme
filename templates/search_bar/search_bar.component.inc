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
        'search_form' => module_invoke('search', 'block_view'),
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
 * @see _europa_preprocess_form_element__search_block_form()
 */
function europa_preprocess_search_bar(&$variables) {
  // Add ccs to the form tag.
  $variables['search_form']['content']['#attributes']['class'][] = 'ecl-search-form';

  // Add css in search button and remove is container.
  $submit_classes = &$variables['search_form']['content']['actions']['submit']['#attributes']['class'];
  $submit_classes[] = 'ecl-button--form';
  $submit_classes[] = 'ecl-search-form__button';

  unset($variables['search_form']['content']['actions']['#theme_wrappers']);
}
