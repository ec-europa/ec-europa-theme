<?php

/**
 * @file
 * form.inc
 */

/**
 * Implements hook_form_alter().
 */
function europa_form_alter(&$form, &$form_state, $form_id) {
  if (isset($form['views_bulk_operations'])) {
    $children = element_children($form['views_bulk_operations']);
    foreach ($children as $child) {
      if ($form['views_bulk_operations'][$child]['#type'] == 'checkbox') {
        $form['views_bulk_operations'][$child]['#title'] = ' ';
      }
    }
  }
}

/**
 * A search_form alteration.
 */
function europa_form_nexteuropa_europa_search_search_form_alter(&$form, &$form_state, $form_id) {
  $form['search_input_group']['europa_search_submit']['#prefix'] = '<span class="input-group-btn search-form__btn-wrapper">';
  $form['search_input_group']['europa_search_submit']['#suffix'] = '</span>';
  $form['search_input_group']['europa_search_submit']['#attributes']['class'][] = 'search-form__btn';
  $form['search_input_group']['QueryText']['#prefix'] = '<label class="search-form__textfield-wrapper"><span class="sr-only">' . t('Search this website') . '</span>';
  $form['search_input_group']['QueryText']['#suffix'] = '</label>';
  $form['search_input_group']['QueryText']['#attributes']['class'][] = 'search-form__textfield';
  $form['search_input_group']['QueryText']['#attributes']['title'] = t('Search');

  unset($form['search_input_group']['QueryText']['#attributes']['placeholder']);
  unset($form['search_input_group']['europa_search_submit']['#attributes']['tabindex']);
}

/**
 * Implements hook_FORM_ID_alter().
 */
function europa_form_search_block_form_alter(&$form, &$form_state, $form_id) {
  $form['#attributes']['class'][] = 'search-block';
  $form['search_block_form']['#attributes']['class'][] = 'search-form__textfield form-control';
  $form['actions']['submit']['#attributes']['class'][] = 'btn-search search-form__btn btn btn-primary';
}
