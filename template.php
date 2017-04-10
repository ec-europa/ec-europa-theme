<?php

/**
 * @file
 * template.php
 */

atomium_include('atomium', 'includes/alter');

/**
 * Implements hook_form_BASE_FORM_ID_alter().
 */
function europa_form_views_exposed_form_alter(&$form, &$form_state, $form_id) {
  // Button value change on all the views exposed forms is due to a
  // design/ux requirement which uses the 'Refine results' label for all the
  // filter forms.
  $form['submit']['#value'] = t('Refine results');
  $form['submit']['#attributes']['class'][] = 'btn-primary';
  $form['submit']['#attributes']['class'][] = 'filters__btn-submit';
  $form['reset']['#attributes']['class'][] = 'filters__btn-reset';
}

/**
 * Implements hook_date_popup_process_alter().
 */
function europa_date_popup_process_alter(&$element, &$form_state, $context) {
  // Removing the description from the datepicker.
  unset($element['date']['#description']);
  unset($element['time']['#description']);
}

/**
 * Implements hook_bootstrap_colorize_text_alter().
 */
function europa_bootstrap_colorize_text_alter(&$texts) {
  $texts['contains'][t('Save')] = 'primary';
}

/**
 * Overrides theme_form_element().
 */
function europa_form_element(&$variables) {
  $element = &$variables['element'];
  $is_checkbox = FALSE;
  $is_radio = FALSE;
  $feedback_message = FALSE;

  // This function is invoked as theme wrapper, but the rendered form element
  // may not necessarily have been processed by form_builder().
  $element += [
    '#title_display' => 'before',
  ];

  // Add element #id for #type 'item'.
  if (isset($element['#markup']) && !empty($element['#id'])) {
    $attributes['id'] = $element['#id'];
  }

  // Check for errors and set correct error class.
  if (isset($element['#parents']) && form_get_error($element)) {
    $attributes['class'][] = 'has-error';
    if (in_array($element['#type'], ['radio', 'checkbox'])) {
      if ($element['#required']) {
        $feedback_message = '<div class="feedback-message is-error"><p>' . form_get_error($element) . '</p></div>';
      }
    }
    else {
      $feedback_message = '<div class="feedback-message is-error"><p>' . form_get_error($element) . '</p></div>';
    }
  }

  if (!empty($element['#type'])) {
    $attributes['class'][] = 'form-type-' . strtr($element['#type'], '_', '-');
  }

  if (!empty($element['#name'])) {
    $attributes['class'][] = 'form-item-' . strtr($element['#name'], [
      ' ' => '-',
      '_' => '-',
      '[' => '-',
      ']' => '',
    ]);
  }

  // Add a class for disabled elements to facilitate cross-browser styling.
  if (!empty($element['#attributes']['disabled'])) {
    $attributes['class'][] = 'form-disabled';
  }

  if (!empty($element['#autocomplete_path'])
    && drupal_valid_path($element['#autocomplete_path'])
  ) {
    $attributes['class'][] = 'form-autocomplete';
  }

  $attributes['class'][] = 'form-item';

  // See https://www.drupal.org/node/154137
  if (!empty($element['#id']) && $element['#id'] == 'edit-querytext') {
    $element['#children'] = str_replace('type="text"', 'type="search"', $element['#children']);
  }

  // See http://getbootstrap.com/css/#forms-controls.
  if (isset($element['#type'])) {
    switch ($element['#type']) {
      case "radio":
        $attributes['class'][] = 'radio';
        $is_radio = TRUE;
        break;

      case "checkbox":
        $attributes['class'][] = 'checkbox';
        $is_checkbox = TRUE;
        break;

      case "managed_file":
        $attributes['class'][] = 'file-upload';
        break;

      default:
        // Check if it is not our search form. Because we don't want the default
        // bootstrap class here.
        if (!in_array('form-item-QueryText', $attributes['class'])) {
          $attributes['class'][] = 'form-group';
          // Apply an extra wrapper class to our select list.
          if ($element['#type'] == 'select') {
            $attributes['class'][] = 'form-select';
          }
        }
    }
  }

  // Putting description into variable since it is not going to change.
  // Here Bootstrap tooltips have been removed since in current implemenation we
  // will use descriptions that are displayed under <label> element.
  if (!empty($element['#description'])) {
    $description = '<p class="help-block">' . $element['#description'] . '</p>';
  }

  $output = '<div' . drupal_attributes($attributes) . '>' . "\n";

  // If #title is not set, we don't display any label or required marker.
  if (!isset($element['#title'])) {
    $element['#title_display'] = 'none';
  }

  $prefix = '';
  $suffix = '';
  if (isset($element['#field_prefix']) || isset($element['#field_suffix'])) {
    // Determine if "#input_group" was specified.
    if (!empty($element['#input_group'])) {
      $prefix .= '<div class="input-group">';
      $prefix .= isset($element['#field_prefix']) ? '<span class="input-group-addon">' . $element['#field_prefix'] . '</span>' : '';
      $suffix .= isset($element['#field_suffix']) ? '<span class="input-group-addon">' . $element['#field_suffix'] . '</span>' : '';
      $suffix .= '</div>';
    }
    else {
      $prefix .= isset($element['#field_prefix']) ? $element['#field_prefix'] : '';
      $suffix .= isset($element['#field_suffix']) ? $element['#field_suffix'] : '';
    }
  }

  switch ($element['#title_display']) {
    case 'before':
    case 'invisible':
      $output .= ' ' . theme('form_element_label', array('element' => $variables));
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";

      if (!empty($description)) {
        $output .= $description;
      }

      $output .= $feedback_message;
      break;

    case 'after':
      if ($is_radio || $is_checkbox) {
        $output .= ' ' . $prefix . $element['#children'] . $suffix;
        unset($element['#children']);
      }
      else {
        $variables['#children'] = ' ' . $prefix . $element['#children'] . $suffix;
      }

      $output .= ' ' . theme('form_element_label', array('element' => $variables)) . "\n";
      $output .= $feedback_message;
      break;

    default:
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";

      // Output no label and no required marker, only the children.
      if (!empty($description)) {
        $output .= $description;
      }

      $output .= $feedback_message;
  }

  $output .= "</div>\n";

  return $output;
}

/**
 * Create the needed wrapper for menus in the footer.
 */
function _europa_menu_tree_footer($tree, $inline = FALSE) {
  $classes[] = 'footer__menu';

  if ($inline) {
    $classes[] = 'ul-list-inline';
  }

  return '<ul class="' . implode(' ', $classes) . '">' . $tree . '</ul>';
}

/**
 * Helper applying BEM to footer menu item links.
 *
 * @param array $variables
 *   Link render array.
 *
 * @return string
 *   HTML markup
 */
function _europa_menu_link__footer(array &$variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }

  $element['#attributes']['class'][] = 'footer__menu-item';

  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
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
 * Override theme_file_link().
 */
function europa_file_link($variables) {
  if (function_exists('_nexteuropa_formatters_file_markup')) {
    $file = $variables['file'];

    // Submit the language along witht the file.
    $langcode = $GLOBALS['language_content']->language;
    if (!empty($langcode)) {
      $file->language = $langcode;
    }

    return _nexteuropa_formatters_file_markup($file);
  }
}

/**
 * Implements hook_preprocess_image().
 *
 * @todo We need to investigate if there is a need to maintain this function
 * to add the class img-responsive, because it's confirmed that we already have
 * it in some cases.
 */
function europa_preprocess_image(&$variables) {
  // Fix issue between print module and bootstrap theme, print module put a
  // string instead of an array in $variables['attributes']['class'].
  if (theme_get_setting('bootstrap_image_responsive')) {
    if (isset($variables['attributes']['class'])
        && is_array($variables['attributes']['class'])
    ) {
      // This avoids having the class .img-responsive repeated in the element.
      if (!in_array('img-responsive', $variables['attributes']['class'])) {
        $variables['attributes']['class'][] = 'img-responsive';
      }
    }
    else {
      $variables['attributes']['class'] = !empty($variables['attributes']['class'])
          ? $variables['attributes']['class'] . ' img-responsive' : 'img-responsive';
    }
  }
}

/**
 * Implements hook_preprocess_views_view().
 */
function europa_preprocess_views_view(&$variables) {
  // Checking if exposed filters are set and add variable that stores active
  // filters.
  if (module_exists('dt_exposed_filter_data')) {
    $variables['active_filters'] = _dt_exposed_filter_data_get_exposed_filter_output();
  }
}

/**
 * Implements theme_pager().
 */
function europa_pager($variables) {
  global $pager_page_array, $pager_total;

  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $pager_items_quantity = 9;
  $pager_max_quantity = 7;
  $pager_min_quantity = 5;

  // Calculate various markers within this pager piece:
  // Current is the page we are currently paged to.
  $pager_current = $pager_page_array[$element] + 1;
  // Max is the maximum page number.
  $pager_max = $pager_total[$element];
  // Re-calculate quantity.
  $quantity = $pager_items_quantity;
  if ($pager_max > $pager_items_quantity) {
    $quantity = $pager_max_quantity;
    if ($pager_current > $pager_min_quantity && $pager_current <= $pager_max - $pager_min_quantity) {
      $quantity = $pager_min_quantity;
    }
  }
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // First is the first page listed by this pager piece (re quantity).
  $pager_first = $pager_current - $pager_middle + 1;
  // Last is the last page listed by this pager piece (re quantity).
  $pager_last = $pager_current + $quantity - $pager_middle;
  // Adjust $pager_first & $pager_last depending on $pager_current.
  if ($quantity == $pager_max_quantity) {
    if ($pager_current <= $pager_min_quantity) {
      $pager_first = 1;
      $pager_last = $pager_max_quantity;
    }
    elseif ($pager_current > $pager_max - $pager_min_quantity) {
      $pager_first = $pager_max - $pager_max_quantity + 1;
      $pager_last = $pager_max;
    }
  }

  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }

  $li_first = '';
  if ($i >= 2) {
    $li_first = theme('pager_first', [
      'text' => 1,
      'element' => $element,
      'parameters' => $parameters,
    ]);
  }
  $li_previous = theme('pager_previous', [
    'text' => t('‹ Previous'),
    'element' => $element,
    'interval' => 1,
    'parameters' => $parameters,
  ]);
  $li_next = theme('pager_next', [
    'text' => t('Next ›'),
    'element' => $element,
    'interval' => 1,
    'parameters' => $parameters,
  ]);

  $li_last = '';
  if ($pager_last < $pager_max) {
    $li_last = theme('pager_last', [
      'text' => $pager_max,
      'element' => $element,
      'parameters' => $parameters,
    ]);
  }

  if ($pager_total[$element] > 1) {
    if ($li_previous) {
      $items[] = [
        'class' => ['pager__item', 'pager__item--previous'],
        'data' => $li_previous,
      ];
    }
    if ($li_first) {
      $items[] = [
        'class' => ['pager__item', 'pager__item--first'],
        'data' => $li_first,
      ];
    }

    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
      if ($i > 2) {
        $items[] = [
          'class' => ['pager__item', 'pager__item--ellipsis'],
          'data' => '…',
        ];
      }
      // Now generate the actual pager piece.
      for (; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items[] = [
            'class' => ['pager__item'],
            'data' => theme('pager_previous', [
              'text' => $i,
              'element' => $element,
              'interval' => ($pager_current - $i),
              'parameters' => $parameters,
            ]),
          ];
        }
        if ($i == $pager_current) {
          $items[] = [
            'class' => [
              'pager__item',
              'pager__item--current' . ($i >= 100 ? ' pager__item--padding' : ''),
            ],
            'data' => '<span class="pager__item__text">' . t('Page') . ' </span>' . $i,
          ];
        }
        if ($i > $pager_current) {
          $items[] = [
            'class' => ['pager__item'],
            'data' => theme('pager_next', [
              'text' => $i,
              'element' => $element,
              'interval' => ($i - $pager_current),
              'parameters' => $parameters,
            ]),
          ];
        }
      }
      if ($i < $pager_max) {
        $items[] = [
          'class' => ['pager__item', 'pager__item--ellipsis'],
          'data' => '…',
        ];
      }
    }
    // End generation.
    if ($li_last) {
      $items[] = [
        'class' => ['pager__item', 'pager__item--last'],
        'data' => $li_last,
      ];
    }
    if ($li_next) {
      $items[] = [
        'class' => ['pager__item', 'pager__item--next'],
        'data' => $li_next,
      ];
    }

    $pager_markup = '<h2 class="sr-only">' . t('Pages') . '</h2>' . theme(
        'item_list',
        [
          'items' => $items,
          'attributes' => ['class' => ['pager']],
        ]);

    return '<div class="pager__wrapper">' . $pager_markup . '</div>';
  }
}

/**
 * Implements theme_pager_link().
 */
function europa_pager_link($variables) {
  $text = $variables['text'];
  $page_new = $variables['page_new'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $attributes = $variables['attributes'];

  $page = isset($_GET['page']) ? $_GET['page'] : '';
  if ($new_page = implode(',', pager_load_array($page_new[$element], $element, explode(',', $page)))) {
    $parameters['page'] = $new_page;
  }

  $query = [];
  if (count($parameters)) {
    $query = drupal_get_query_parameters($parameters, []);
  }
  if ($query_pager = pager_get_query_parameters()) {
    $query = array_merge($query, $query_pager);
  }

  // Set each pager link title.
  if (!isset($attributes['title'])) {
    static $titles = NULL;
    if (!isset($titles)) {
      $titles = [
        t('‹ Previous') => t('Go to previous page'),
        t('Next ›') => t('Go to next page'),
      ];
    }
    if (isset($titles[$text])) {
      $attributes['title'] = $titles[$text];
    }
    elseif (is_numeric($text)) {
      $attributes['title'] = t('Go to page @number', ['@number' => $text]);
    }
  }

  // @todo l() cannot be used here, since it adds an 'active' class based on the
  //   path only (which is always the current path for pager links). Apparently,
  //   none of the pager links is active at any time - but it should still be
  //   possible to use l() here.
  // @see http://drupal.org/node/1410574
  $attributes['href'] = url($_GET['q'], ['query' => $query]);

  return '<a' . drupal_attributes($attributes) . '>' . $text . '</a>';
}

/**
 * Implements theme_pager_first().
 */
function europa_pager_first($variables) {
  global $pager_page_array;

  $output = '';
  $text = $variables['text'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $attributes = isset($variables['attributes']) ? $variables['attributes'] : [];

  // If we are anywhere but the first page.
  if ($pager_page_array[$element] > 0) {
    $output = theme('pager_link', [
      'text' => $text,
      'page_new' => pager_load_array(0, $element, $pager_page_array),
      'element' => $element,
      'parameters' => $parameters,
      'attributes' => $attributes,
    ]);
  }

  return $output;
}

/**
 * Implements theme_pager_previous().
 */
function europa_pager_previous($variables) {
  global $pager_page_array;

  $output = '';
  $interval = $variables['interval'];
  $text = $variables['text'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $attributes = isset($variables['attributes']) ? $variables['attributes'] : [];

  // If we are anywhere but the first page.
  if ($pager_page_array[$element] > 0) {
    $page_new = pager_load_array($pager_page_array[$element] - $interval, $element, $pager_page_array);

    // If the previous page is the first page, mark the link as such.
    if ($page_new[$element] == 0) {
      $output = theme('pager_first', [
        'text' => $text,
        'element' => $element,
        'parameters' => $parameters,
        'attributes' => $attributes,
      ]);
    }
    // The previous page is not the first page.
    else {
      $output = theme('pager_link', [
        'text' => $text,
        'page_new' => $page_new,
        'element' => $element,
        'parameters' => $parameters,
        'attributes' => $attributes,
      ]);
    }
  }

  return $output;
}

/**
 * Implements theme_pager_next().
 */
function europa_pager_next($variables) {
  global $pager_page_array, $pager_total;

  $output = '';
  $interval = $variables['interval'];
  $text = $variables['text'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $attributes = isset($variables['attributes']) ? $variables['attributes'] : [];

  // If we are anywhere but the last page.
  if ($pager_page_array[$element] < ($pager_total[$element] - 1)) {
    $page_new = pager_load_array($pager_page_array[$element] + $interval, $element, $pager_page_array);
    // If the next page is the last page, mark the link as such.
    if ($page_new[$element] == ($pager_total[$element] - 1)) {
      $output = theme('pager_last', [
        'text' => $text,
        'element' => $element,
        'parameters' => $parameters,
        'attributes' => $attributes,
      ]);
    }
    // The next page is not the last page.
    else {
      $output = theme('pager_link', [
        'text' => $text,
        'page_new' => $page_new,
        'element' => $element,
        'parameters' => $parameters,
        'attributes' => $attributes,
      ]);
    }
  }

  return $output;
}

/**
 * Implements theme_pager_last().
 */
function europa_pager_last($variables) {
  global $pager_page_array, $pager_total;

  $output = '';
  $text = $variables['text'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $attributes = isset($variables['attributes']) ? $variables['attributes'] : [];

  // If we are anywhere but the n-5th page.
  if ($pager_page_array[$element] < ($pager_total[$element] - 1)) {
    $output = theme('pager_link', [
      'text' => $text,
      'page_new' => pager_load_array($pager_total[$element] - 1, $element, $pager_page_array),
      'element' => $element,
      'parameters' => $parameters,
      'attributes' => $attributes,
    ]);
  }

  return $output;
}

/**
 * Implements theme_file_widget().
 *
 * @todo Refactor the use of variable_get to use the field info instance
 * settings instead.
 */
function europa_file_widget($variables) {
  $output = '';
  $element = $variables['element'];
  $bundle = $element['#bundle'];
  $field_name = $element['#field_name'];

  // Checks if its to use the DT component in the front end.
  $check_use = variable_get('dt_shared_functions_dt_file_use_component_' . $bundle . '_' . $field_name, TRUE);
  if ($check_use) {
    $has_file = FALSE;
    if (!empty($element['#default_value']['fid'])) {
      $has_file = TRUE;
    }

    // Added the JS file to the element upload to be rendered.
    $element['upload']['#attached']['js'][] = drupal_get_path('theme', 'europa') . '/js/components/file-upload.js';

    // Immediately render hidden elements before the rest of the output.
    // The uploadprogress extension requires that the hidden identifier input
    // element appears before the file input element. They must also be siblings
    // inside the same parent element.
    // @see https://www.drupal.org/node/2155419
    $hidden_elements = [];
    $upload_button = [];
    foreach (element_children($element) as $child) {
      if ($element[$child]['#type'] === 'hidden') {
        $hidden_elements[$child] = $element[$child];
        unset($element[$child]);
      }
      elseif ($element[$child]['#type'] === 'submit') {
        $upload_button[$child] = $element[$child];
        $upload_button[$child]['#attributes']['class'][] = 'btn-primary';
        unset($element[$child]);
      }
    }

    // The "form-managed-file" class is required for proper Ajax functionality.
    $output .= '<div class="file-widget form-managed-file input-group clearfix">';

    $output .= render($hidden_elements);
    $output .= drupal_render_children($element);

    if (!$has_file) {
      $output .= '<div class="form-control file-upload__input form-file" tabindex="0">';
      $output .= '<span class="file-upload__message">' . t('No file selected.') . '</span>';
      $output .= '</div>';
    }
    $output .= '<span class="input-group-btn">';
    if (!$has_file) {
      $output .= '<label class="btn btn-default file-upload__label" for="' . $element['upload']['#id'] . '" tabindex="1">' . t('Browse') . '</label>';
    }

    // Checks if the upload button is to added to the front end.
    $check_upload = variable_get('dt_shared_functions_dt_file_show_upload_' . $bundle . '_' . $field_name, TRUE);
    if ($check_upload) {
      // The newline is to give the same space that we have in the style guide.
      $output .= "\n" . drupal_render($upload_button);
    }

    $output .= '</span>';
    $output .= '</div>';
  }

  return $output;
}

/**
 * Implements theme_file_upload_help().
 */
function europa_file_upload_help($variables) {
  // This is to avoid having the code duplicated from function
  // theme_file_upload_help and also to avoid the function
  // bootstrap_file_upload_help because we don't need popup's, just theme
  // this normally.
  // @codingStandardsIgnoreLine
  return theme_file_upload_help($variables);
}

/**
 * Implements hook_ds_pre_render_alter().
 *
 * Setting variables for non-node entities in the DS templates.
 */
function europa_ds_pre_render_alter(&$layout_render_array, $context, &$variables) {
  $entity = $variables['elements'];
  $entity_type = $entity['#entity_type'];

  switch ($entity_type) {
    case 'user':
      $uri = entity_uri($entity_type, $variables['elements']['#account']);
      $variables['node_url'] = url($uri['path']);

      if (!empty($entity['europa_user_fullname_first'])) {
        $title = $entity['europa_user_fullname_first'][0]['#markup'];
      }
      elseif (!empty($entity['europa_user_fullname_last'])) {
        $title = $entity['europa_user_fullname_last'][0]['#markup'];
      }
      else {
        $title = $variables['elements']['#account']->name;
      }

      // We get the value wrapped in a <p> tag.
      $variables['title'] = strip_tags($title);
      break;

    case 'taxonomy_term':
      $uri = entity_uri($entity_type, $variables['term']);
      $variables['node_url'] = url($uri['path']);
      $variables['title'] = $entity['#term']->name;
      break;

  }
}
