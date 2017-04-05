<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_field() {
  return array(
    'label' => 'Field',
    'description' => 'Field.',
    'preview' => array(
      'label_display' => TRUE,
      'field_name' => 'my_field',
      'field_type' => 'textfield',
      'bundle' => 'page',
      'label' => 'Label',
      'items' => array(
        array(
          '#markup' => 'Item 1',
        ),
        array(
          '#markup' => 'Item 2',
        ),
      ),
      array(
        '#markup' => 'Item 1',
      ),
      array(
        '#markup' => 'Item 2',
      ),
    ),
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_field(&$variables) {
  if (isset($variables['element']['#label'])) {
    $variables['label'] = $variables['element']['#label'];
  }

 //@TODO refactor Add the tpl classes here
  // Changing label for the field to display stripped out values.
  switch ($variables['element']['#field_name']) {
    case 'field_core_social_network_links':
      $variables['element']['before'] = t('Follow the latest progress and get involved.');
      $variables['element']['after'] = l(t('Other social networks'), variable_get('dt_core_other_social_networks_link', 'http://europa.eu/contact/social-networks/index_en.htm'));
      break;
  }
  if ($variables['element']['#field_type'] <> 'ds') {
    // Get more field information.
    $field = field_info_field($variables['element']['#field_name']);
    // Initialize parameter.
    $allow_attribute = TRUE;
    // If it is not a tranlateable entityreference field we should continue.
    if ($field['type'] == "entityreference" && $field['translatable'] == 0) {
      $allow_attribute = FALSE;
    }
    if ($allow_attribute) {
      // The default language code.
      $content_langcode = $GLOBALS['language_content']->language;
      // When the language is different from content.
      if (isset($variables['element']['#language'])
        && $variables['element']['#language'] <> LANGUAGE_NONE
        && $variables['element']['#language'] <> $content_langcode
      ) {
        $variables['attributes_array']['lang'] = $variables['element']['#language'];
      }
    }
  }
  // Set the attributes to the element.
  $variables['attributes'] = (empty($variables['attributes_array']) ? '' : drupal_attributes($variables['attributes_array']));

}

