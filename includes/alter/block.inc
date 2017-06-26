<?php

/**
 * @file
 * block.inc
 */

/**
 * Implements hook_block_view().
 */
function europa_block_view_alter(&$data, $block) {
  switch ($block->delta) {
    case 'create-content-button':
      $data['content'] = _europa_create_button_contextual_links();
      break;
  }
}

/**
 * Helper function to fetch the links.
 */
function _europa_create_button_contextual_links() {
  global $base_url;

  $items = menu_get_item('node/add');
  $content = system_admin_menu_block($items);

  if (!empty($content)) {

    $select = array(
      '#title' => t('Create content'),
      '#type' => 'select',
      '#description' => t('Create content'),
      '#options' => array('#' => t('Create content')),
    );

    $links = array();
    foreach ($content as $content_type) {
      $links[$base_url . '/' . $content_type['link_path']] = t($content_type['link_title']);
    }
    $select['#options'] = array_merge( $select['#options'], $links);
    $output = form_select_options($select);

    return $output;
  }
}