<?php

/**
 * @file
 * Contains form alter functions.
 */

/**
 * Implements hook_FORM_ID_alter().
 */
function europa_form_search_block_form_alter(&$form, &$form_state, $form_id) {
  $form['#attributes']['class'][] = 'search-block';
  $form['search_block_form']['#attributes']['class'][] = 'search-form__textfield form-control';
  $form['actions']['submit']['#attributes']['class'][] = 'btn-search search-form__btn btn btn-primary';
}
