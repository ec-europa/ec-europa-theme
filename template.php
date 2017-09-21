<?php

/**
 * @file
 * template.php
 */

/**
 * Implements hook_js_alter().
 */
function europa_js_alter(&$js) {
  $base_theme_path = drupal_get_path('theme', 'bootstrap');
  $path_fancybox = libraries_get_path('fancybox');

  unset(
    $js[$base_theme_path . '/js/misc/ajax.js'],
    $js[$path_fancybox . '/jquery.fancybox.pack.js'],
    $js[$path_fancybox . '/helpers/jquery.fancybox-thumbs.js'],
    $js[$path_fancybox . '/helpers/jquery.fancybox-buttons.js'],
    $js[$path_fancybox . '/helpers/jquery.fancybox-media.js'],
    $js['profiles/multisite_drupal_standard/themes/bootstrap/js/bootstrap.js']
  );
}

/**
 * Implements hook_css_alter().
 */
function europa_css_alter(&$css) {
  $path_fancybox = libraries_get_path('fancybox');
  // Prevent our css from being aggregate (ie9 requirement).
  $path_base = drupal_get_path('theme', 'europa') . '/css/style-sass-base.css';
  $css[$path_base]['preprocess'] = FALSE;

  unset(
    $css[drupal_get_path('module', 'date') . '/date_api/date.css'],
    $css[$path_fancybox . '/helpers/jquery.fancybox-buttons.css'],
    $css[$path_fancybox . '/helpers/jquery.fancybox-thumbs.css'],
    $css[$path_fancybox . '/jquery.fancybox.css']
  );
}

/**
 * Implements hook_theme().
 */
function europa_theme($existing, $type, $theme, $path) {
  return [
    'europa_status_message' => [
      'template' => 'status_message',
      'path' => $path . '/templates',
      'variables' => [
        'message_classes' => '',
        'message_title' => '',
        'message_type' => '',
        'message_body' => '',
      ],
    ],
  ];
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_europa_status_message(&$variables) {
  if (!empty($variables['message_classes']) && is_array($variables['message_classes'])) {
    $variables['message_classes'] = ' ' . implode(' ', $variables['message_classes']);
  }
}

/**
 * Overrides theme_form_required_marker().
 */
function europa_form_required_marker($variables) {
  // This is also used in the installer, pre-database setup.
  $t = get_t();
  $attributes = [
    'class' => 'form-required text-danger',
    'title' => $t('This field is required.'),
  ];
  return '<span' . drupal_attributes($attributes) . '>*</span>';
}

/**
 * Implements hook_form_BASE_FORM_ID_alter().
 */
function europa_form_views_exposed_form_alter(&$form, &$form_state, $form_id) {
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
 * Bootstrap theme wrapper function for the primary menu links.
 */
function europa_menu_tree__secondary(&$variables) {
  return '<ul class="menu nav navbar-nav secondary">' . $variables['tree'] . '</ul>';
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

        if (isset($element['#title'])) {
          $element['#title'] = filter_xss($element['#title']);
          // Supports anchors inside the checkbox label.
          if (preg_match('/<a\b[^>]*>(.*?)<\/a>/is', $element['#title'], $link)) {
            $anchor = $link[0];
            // Get the clean label text.
            $element['#title'] = trim(str_replace($anchor, '', $element['#title']));
            // Adds target _blank if not in place.
            if (!preg_match('/<a.*?target=[^>]*?>/is', $anchor)) {
              $anchor = preg_replace('/<a([^>]+)>/is', '<a$1 target="_blank">', $anchor);
            }

            $attributes['class'][] = 'checkbox--with-link';
          }
        }
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
      $output .= ' ' . theme('form_element_label', $variables);
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

      $output .= ' ' . theme('form_element_label', $variables) . "\n";
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
  // @todo This would be better handled in a theme_form_element_label override.
  if (!empty($anchor)) {
    // Add the link.
    $output .= $anchor;

    if (!empty($variables['element']['#required'])) {
      // Find the form-required span and put it after the link.
      preg_match('/<span class="form-required\b[^>]*>(.*?)<\/span>/is', $output, $required);
      $output = str_replace($required[0], '', $output) . $required[0];
    }
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
 * Europa theme wrapper function for the service tools menu links.
 *
 * @see theme_menu_tree()
 */
function europa_menu_tree__menu_nexteuropa_service_links(&$variables) {
  return _europa_menu_tree_footer($variables['tree'], TRUE);
}

/**
 * Europa theme wrapper function for the EC menu links.
 *
 * @see theme_menu_tree()
 */
function europa_menu_tree__menu_nexteuropa_social_media(&$variables) {
  return _europa_menu_tree_footer($variables['tree'], TRUE);
}

/**
 * Europa theme wrapper function for the EC menu links.
 *
 * @see theme_menu_tree()
 */
function europa_menu_tree__menu_nexteuropa_inst_links(&$variables) {
  return _europa_menu_tree_footer($variables['tree']);
}

/**
 * Europa theme wrapper function for the EC menu links.
 *
 * @see theme_menu_tree()
 */
function europa_menu_tree__menu_nexteuropa_site_links(&$variables) {
  return _europa_menu_tree_footer($variables['tree']);
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
 * Override theme_menu_link().
 */
function europa_menu_link__menu_nexteuropa_service_links(&$variables) {
  return _europa_menu_link__footer($variables);
}

/**
 * Override theme_menu_link().
 */
function europa_menu_link__menu_nexteuropa_social_media(&$variables) {
  return _europa_menu_link__footer($variables);
}

/**
 * Override theme_menu_link().
 */
function europa_menu_link__menu_nexteuropa_inst_links(&$variables) {
  return _europa_menu_link__footer($variables);
}

/**
 * Override theme_menu_link().
 */
function europa_menu_link__menu_nexteuropa_site_links(&$variables) {
  return _europa_menu_link__footer($variables);
}

/**
 * Override hook_html_head_alter().
 */
function europa_html_head_alter(&$head_elements) {
  // Creating favicons links and meta tags for the html header.
  $europa_theme_png_path = base_path() . drupal_get_path('theme', 'europa') . '/images/png/favicon/';
  $elements = [
    [
      '#tag' => 'link',
      '#attributes' => [
        'rel' => 'apple-touch-icon',
        'sizes' => '57x57',
        'href' => 'apple-touch-icon-57x57.png',
      ],
    ],
    [
      '#tag' => 'link',
      '#attributes' => [
        'rel' => 'apple-touch-icon',
        'sizes' => '60x60',
        'href' => 'apple-touch-icon-60x60.png',
      ],
    ],
    [
      '#tag' => 'link',
      '#attributes' => [
        'rel' => 'apple-touch-icon',
        'sizes' => '114x114',
        'href' => 'apple-touch-icon-114x114.png',
      ],
    ],
    [
      '#tag' => 'link',
      '#attributes' => [
        'rel' => 'apple-touch-icon',
        'sizes' => '120x120',
        'href' => 'apple-touch-icon-120x120.png',
      ],
    ],
    [
      '#tag' => 'link',
      '#attributes' => [
        'rel' => 'apple-touch-icon',
        'sizes' => '144x144',
        'href' => 'apple-touch-icon-144x144.png',
      ],
    ],
    [
      '#tag' => 'link',
      '#attributes' => [
        'rel' => 'apple-touch-icon',
        'sizes' => '152x152',
        'href' => 'apple-touch-icon-152x152.png',
      ],
    ],
    [
      '#tag' => 'link',
      '#attributes' => [
        'rel' => 'apple-touch-icon',
        'sizes' => '180x180',
        'href' => 'apple-touch-icon-180x180.png',
      ],
    ],
    [
      '#tag' => 'link',
      '#attributes' => [
        'rel' => 'icon',
        'type' => 'image/png',
        'sizes' => '32x32',
        'href' => 'favicon-32x32.png',
      ],
    ],
    [
      '#tag' => 'link',
      '#attributes' => [
        'rel' => 'icon',
        'type' => 'image/png',
        'sizes' => '192x192',
        'href' => 'android-chrome-192x192.png',
      ],
    ],
    [
      '#tag' => 'link',
      '#attributes' => [
        'rel' => 'icon',
        'type' => 'image/png',
        'sizes' => '96x96',
        'href' => 'favicon-96x96.png',
      ],
    ],
    [
      '#tag' => 'link',
      '#attributes' => [
        'rel' => 'icon',
        'type' => 'image/png',
        'sizes' => '16x16',
        'href' => 'favicon-16x16.png',
      ],
    ],
    [
      '#tag' => 'meta',
      '#attributes' => [
        'name' => 'msapplication-TileColor',
        'content' => '#034ea1',
      ],
    ],
    [
      '#tag' => 'meta',
      '#attributes' => [
        'name' => 'msapplication-TileImage',
        'content' => $europa_theme_png_path . 'mstile-144x144.png',
      ],
    ],
    [
      '#tag' => 'meta',
      '#attributes' => [
        'name' => 'theme-color',
        'content' => '#034ea1',
      ],
    ],
    [
      '#tag' => 'meta',
      '#attributes' => [
        'name' => 'msapplication-square70x70logo',
        'content' => $europa_theme_png_path . 'mstile-70x70.png',
      ],
    ],
    [
      '#tag' => 'meta',
      '#attributes' => [
        'name' => 'msapplication-square150x150logo',
        'content' => $europa_theme_png_path . 'mstile-150x150.png',
      ],
    ],
    [
      '#tag' => 'meta',
      '#attributes' => [
        'name' => 'msapplication-wide310x150logo',
        'content' => $europa_theme_png_path . 'mstile-310x150.png',
      ],
    ],
    [
      '#tag' => 'meta',
      '#attributes' => [
        'name' => 'msapplication-square310x310logo',
        'content' => $europa_theme_png_path . 'mstile-310x310.png',
      ],
    ],
  ];
  foreach ($elements as $element) {
    $element['#type'] = 'html_tag';
    if (isset($element['#attributes']['href'])) {
      $element['#attributes']['href'] = $europa_theme_png_path . $element['#attributes']['href'];
    }
    $head_elements[] = $element;
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
 * Generate the first breadcrumb items basing on a custom menu.
 */
function _europa_breadcrumb_menu(&$variables) {
  global $language;
  $menu = theme_get_setting('ec_europa_breadcrumb_menu');
  $menu_links = menu_tree($menu);
  $new_items = [];
  $front = drupal_is_front_page();

  if (!empty($menu_links)) {
    $i = 0;
    foreach ($menu_links as $key => $menu_item) {
      if (is_numeric($key)) {
        // We don't want to show the home link in the home page.
        if (!($front && $menu_item['#href'] == '<front>')) {
          $options = ['language' => $language];
          $title = token_replace($menu_item['#title'], $menu_item, $options);
          $new_items[] = _easy_breadcrumb_build_item($title, [], $menu_item['#href']);
          $i++;
        }
      }
    }

    if (!empty($new_items)) {
      // The menu is used as the starting point of the breadcrumb.
      $variables['breadcrumb'] = array_merge($new_items, $variables['breadcrumb']);
      // Alter the number of segments in the breadcrumb.
      $variables['segments_quantity'] += $i;
    }
  }
}

/**
 * Override theme_easy_breadcrumb().
 */
function europa_easy_breadcrumb(&$variables) {
  if (drupal_is_front_page() && !theme_get_setting('ec_europa_breadcrumb_home')) {
    return;
  }

  _europa_breadcrumb_menu($variables);
  $breadcrumb = $variables['breadcrumb'];
  $segments_quantity = $variables['segments_quantity'];
  $html = '';

  if ($segments_quantity > 0) {
    $html .= '<nav id="breadcrumb" class="breadcrumb" role="navigation" aria-label="breadcrumbs">';
    $html .= '<span class="element-invisible">' . t('You are here') . ':</span>';
    $html .= '<ol class="breadcrumb__segments-wrapper">';

    for ($i = 0, $s = $segments_quantity; $i < $segments_quantity; ++$i) {
      $item = $breadcrumb[$i];

      // Removing classes from $item['class'] array and adding BEM classes.
      $classes = $item['class'];
      $classes[] = 'breadcrumb__segment';

      $attributes = [
        'class' => ['breadcrumb__link'],
      ];

      if ($i == 0) {
        $classes[] = 'breadcrumb__segment--first';
        $attributes['class'][] = 'is-internal';
        $attributes += ['rel' => 'home'];
      }
      elseif ($i == ($s - 1)) {
        $classes[] = 'breadcrumb__segment--last';
      }

      $content = '<span class="breadcrumb__text">' . check_plain(decode_entities($item['content'])) . '</span>';
      $class = implode(' ', $classes);
      if (isset($item['url'])) {
        $full_item = l($content, $item['url'], [
          'attributes' => $attributes,
          'html' => TRUE,
        ]);
      }
      else {
        $full_item = '<span class="' . $class . '">' . $content . '</span>';
      }

      // TODO: Check if the active class actually appears.
      $element_visibility = in_array('active', $classes) ? ' element-invisible' : '';
      $html .= '<li class="' . $class . $element_visibility . '">' . $full_item . '</li>';
    }

    $html .= '</ol></nav>';

    drupal_add_js(drupal_get_path('theme', 'europa') . '/js/components/breadcrumb.js');
  }
  return $html;
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
 * Implements hook_preprocess_block().
 */
function europa_preprocess_block(&$variables) {
  $block = $variables['block'];
  $variables['theme_hook_suggestions'][] = 'block__' . $block->module . '__' . str_replace('-', '_', $block->delta) . '_' . $block->region;

  switch ($block->delta) {
    case 'nexteuropa_feedback':
      $variables['classes_array'][] = 'block--full-width';
      break;

    case 'menu-nexteuropa-service-links':
      $block->subject = '';
      break;

    case 'views_related_links':
      $variables['classes_array'][] = 'link-block';
      $variables['title_attributes_array']['class'][] = 'link-block__title';
      break;

    case 'language_selector_site':
      $variables['lang_code'] = $variables['elements']['code']['#markup'];
      $variables['lang_name'] = $variables['elements']['label']['#markup'];
      // Add class to block.
      $variables['classes_array'][] = 'lang-select-site';
      $variables['link'] = url('splash') . '?destination=' . drupal_get_destination()['destination'];
      break;
  }

  // Page-level language switcher.
  if (isset($block->bid) && $block->bid === 'language_selector_page-language_selector_page') {
    global $language;

    // selectify.js is the library to convert between ul and select.
    drupal_add_js(drupal_get_path('theme', 'europa') . '/js/selectify.js');
    drupal_add_js(drupal_get_path('theme', 'europa') . '/js/components/lang-switcher.js');

    // Initialize variables.
    $not_available = '';
    $served = '';
    $other = '';

    if (!empty($variables['elements']['not_available']['#markup'])) {
      $not_available = '<li class="lang-select-page__option lang-select-page__unavailable">' . $variables['elements']['not_available']['#markup']->native . '</li>';
    }

    if (!empty($variables['elements']['served']['#markup'])) {
      $served = '<li class="lang-select-page__option is-selected">' . $variables['elements']['served']['#markup']->native . '</li>';
    }

    if (!empty($variables['elements']['other']['#markup'])) {
      foreach ($variables['elements']['other']['#markup'] as $code => $lang) {
        $options = [];
        $options['query'] = drupal_get_query_parameters();
        $options['query']['2nd-language'] = $code;
        $options['attributes']['lang'] = $code;
        $options['attributes']['hreflang'] = $code;
        $options['attributes']['rel'] = 'alternate';
        $options['language'] = $language;

        $other .= '<li class="lang-select-page__option lang-select-page__other">' . l($lang->native, current_path(), $options) . '</li>';
      }
    }

    // Add class to block.
    $variables['classes_array'][] = 'lang-select-page lang-select-page--transparent';

    // Add content to block.
    $content = "<span class='lang-select-page__icon icon icon--generic-lang'></span>";
    $content .= "<ul class='lang-select-page__list'>" . $not_available . $served . $other . '</ul>';

    $variables['content'] = $content;
  }

  // Site-level language switcher.
  if (theme_get_setting('ec_europa_multilingual', 'europa')
    && !empty($block->bid)
    && $block->bid === 'language_selector_site-language_selector_site'
  ) {
    // Add the js to make it function.
    drupal_add_js(drupal_get_path('theme', 'europa') . '/js/components/lang-select-site.js');
  }

  // Replace block-title class with block__title in order to keep BEM structure
  // of classes.
  if (!empty($variables['title_attributes_array']['class'])) {
    $block_title_class = array_search('block-title', $variables['title_attributes_array']['class']);
    if ($block_title_class !== FALSE) {
      unset($variables['title_attributes_array']['class'][$block_title_class]);
    }
  }

  $variables['title_attributes_array']['class'][] = 'block__title';

  if (isset($block->bid)) {
    // Check if the block is a exposed form.
    // This is checked by looking at the $block->bid which in case
    // of views exposed filters, always contains 'views--exp-' string.
    if (strpos($block->bid, 'views--exp-') !== FALSE
      || (!empty($block->info) && strpos($block->info, 'Exposed form') !== FALSE)) {
      if (isset($block->context) && $context = context_load($block->context)) {
        // @todo Find a different way for doing this, we shouldn't hardcode the title here.
        $block->subject = t('Filter by');

        // If our block is the first, we set the subject. This way, if we expose
        // a second block for the same view, we will not duplicate the title.
        if (array_search($block->bid, array_keys($context->reactions['block']['blocks'])) === 0) {
          $variables['classes_array'][] = 'filters';
          $variables['title_attributes_array']['class'][] = 'filters__title';

          // Passing block id to Drupal.settings in order to pass it through
          // data attribute in the collapsible panel.
          drupal_add_js(['europa' => ['exposedBlockId' => $variables['block_html_id']]], 'setting');

          // Adding filters.js file.
          drupal_add_js(drupal_get_path('theme', 'europa') . '/js/components/filters.js');
        }
      }
    }
  }

  if ($block->delta == 'inline_navigation') {
    $variables['classes_array'][] = 'inpage-nav__wrapper';
    $variables['title_attributes_array']['class'][] = 'inpage-nav__block-title';
  }
}

/**
 * Implements hook_preprocess_bootstrap_tabs().
 */
function europa_preprocess_bootstrap_fieldgroup_nav(&$variables) {
  drupal_add_js(drupal_get_path('theme', 'europa') . '/js/libraries/jquery-accessible-tabs.js');
  $group = &$variables['group'];

  $variables['nav_classes'] = '';

  switch ($group->format_settings['instance_settings']['bootstrap_nav_type']) {
    case 'tabs':
      $variables['nav_classes'] .= ' nav-tabs nav-tabs--with-content';
      break;

    case 'pills':
      $variables['nav_classes'] .= ' nav-pills';
      break;

    default:
  }

  if ($group->format_settings['instance_settings']['bootstrap_stacked']) {
    $variables['nav_classes'] .= ' nav-stacked';
  }

  $i = 0;
  foreach ($variables['items'] as $item) {
    // Check if item is not empty and we have access to it.
    if ($item && (!isset($item['#access']) || $item['#access'])) {

      $id = 'bootstrap-fieldgroup-nav-item--' . drupal_html_id($item['#title']);

      // Is an explicit nav item?
      if (!empty($item['#type']) && 'bootstrap_fieldgroup_nav_item' == $item['#type']) {
        $classes = $item['#group']->classes;
      }
      // Otherwise, just a regular field under the nav.
      else {
        $classes = '';
      }

      $variables['navs'][$i] = [
        'content' => l(
          $item['#title'],
          NULL,
          [
            'attributes' => [
              'data-toggle' => 'tab',
              'class' => ['js-tablist__link'],
            ],
            'fragment' => $id,
            'external' => TRUE,
            'html' => TRUE,
          ]
        ),
        'classes' => $classes,
      ];

      $variables['panes'][$i]['id'] = $id;
      $variables['panes'][$i]['title'] = check_plain($item['#title']);
      $i++;
    }
  }
}

/**
 * Implements hook_preprocess_field().
 */
function europa_preprocess_field(&$variables) {
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
 * Implements hook_preprocess_html().
 */
function europa_preprocess_html(&$variables) {
  $this_theme_path = drupal_get_path('theme', 'europa');
  $variables['theme_path'] = base_path() . $this_theme_path;
  $language = $variables['language'];

  if (isset($language->prefix)) {
    $variables['classes_array'][] = 'language-' . $language->prefix;
  }

  // Add the ie9 only css.
  drupal_add_css($this_theme_path . '/css/ie9.css', [
    'browsers' => [
      'IE' => 'IE 9',
      '!IE' => FALSE,
    ],
  ]
  );
  // Add conditional js.
  $ie9_js = [
    '#tag' => 'script',
    '#attributes' => [
      'src' => $this_theme_path . '/js/ie9.js',
    ],
    '#prefix' => '<!--[if IE 9]>',
    '#suffix' => '</script><![endif]-->',
  ];
  drupal_add_html_head($ie9_js, 'ie9_js');

  // For some reason, the front page handles tokens different.
  if (drupal_is_front_page()) {
    $data = ['node' => menu_get_object('node')];
    $last_modified = [
      '#tag' => 'meta',
      '#attributes' => [
        'name' => 'last-modified',
        'content' => token_replace('[dt_tokens:dt_update_date]', $data),
      ],
    ];
    drupal_add_html_head($last_modified, 'last_modified');
  }

  // Override splash screen title.
  $menu_item = menu_get_item();
  if (!empty($menu_item['path'])
    && $menu_item['path'] === 'splash'
    && !variable_get('splash_screen_title_value', FALSE)
  ) {
    $site_name = variable_get('site_name');
    $variables['head_title'] = $site_name;
    drupal_set_title($site_name);
  }
}

/**
 * Implements hook_preprocess_node().
 */
function europa_preprocess_node(&$variables) {
  // Add default section component to the entity regions.
  $variables['left_classes'] = 'col-md-3 col-sm-12 section region-sidebar-first';
  $variables['right_classes'] = 'col-md-3 col-sm-12 section region-sidebar-last';
  $variables['central_classes'] = 'col-sm-12 section';

  // Add information about the number of sidebars.
  if (!empty($variables['left']) && !empty($variables['right'])) {
    $variables['central_classes'] .= ' col-md-6 col-md-pull-3';
    $variables['left_classes'] .= ' col-md-pull-3';
    $variables['right_classes'] .= ' col-md-push-9';
  }
  elseif (!empty($variables['left']) && empty($variables['right'])) {
    $variables['central_classes'] .= ' col-md-9';
  }
  elseif (empty($variables['left']) && !empty($variables['right'])) {
    $variables['central_classes'] .= ' col-md-9 col-md-pull-3';
    $variables['right_classes'] .= ' col-md-push-9';
  }
  elseif (empty($variables['left']) && empty($variables['right'])) {
    $variables['central_classes'] .= ' col-md-12';
  }

  $variables['site_name'] = variable_get('site_name');
  $variables['theme_hook_suggestions'][] = 'node__' . $variables['view_mode'];
  $variables['theme_hook_suggestions'][] = 'node__' . $variables['type'] . '__' . $variables['view_mode'];
  $variables['submitted'] = '';
  if (theme_get_setting('display_submitted')) {
    $variables['submitted'] = t('Submitted by !username on !datetime', [
      '!username' => $variables['name'],
      '!datetime' => $variables['date'],
    ]);
  }
  $variables['messages'] = theme('status_messages');

  // Override node_url if Legacy Link is set.
  if (isset($variables['legacy'])) {
    $variables['node_url'] = $variables['legacy'];
  }
  // We have our custom element to add comments.
  if (!empty($variables['content']['links']['comment']['#links'])) {
    unset($variables['content']['links']['comment']['#links']['comment-add']);
  }

  // Add the language attribute.
  $variables['attributes_array']['lang'] = entity_translation_get_existing_language('node', $variables['node']);
}

/**
 * Implements hook_preprocess_taxonomy_term().
 */
function europa_preprocess_taxonomy_term(&$variables) {
  // Add tabs to node object so we can put it in the DS template instead.
  if ($variables['view_mode'] == 'full' && user_is_logged_in()) {
    $tasks = menu_local_tasks();

    if (!empty($tasks)) {
      $tasks['#prefix'] = '<ul class="tabs--primary nav nav-tabs">';
      $tasks['#suffix'] = '</ul>';
      $variables['local_tabs'] = drupal_render($tasks);
    }
  }

  // Add default section component to the entity regions.
  $variables['left_classes'] = 'section';
  $variables['right_classes'] = 'section';
  $variables['central_classes'] = 'section';

  // Add information about the number of sidebars.
  if (!empty($variables['left']) && !empty($variables['right'])) {
    $variables['content_column_class'] = 'col-md-6';
  }
  elseif (!empty($variables['left']) || !empty($variables['right'])) {
    $variables['content_column_class'] = 'col-md-9';
  }
  else {
    $variables['content_column_class'] = 'col-md-12';
  }

  $variables['site_name'] = variable_get('site_name');
}

/**
 * Implements hook_preprocess_page().
 */
function europa_preprocess_page(&$variables) {
  // Disable the region holding the breadcrumb if settings say so.
  if (drupal_is_front_page() && !(theme_get_setting('ec_europa_breadcrumb_home'))) {
    $variables['page']['header_bottom'] = [];
  }

  // Small fix to maxe the link to the start page use the alias with language.
  $variables['front_page'] = url('<front>');

  $variables['theme_settings'] = [
    'header_home' => theme_get_setting('ec_europa_site_header_home', 'europa'),
    'improved' => theme_get_setting('ec_europa_improved_website', 'europa'),
    'improved_header' => theme_get_setting('ec_europa_improved_website_header', 'europa'),
    'identification_home' => theme_get_setting('ec_europa_improved_website_home', 'europa'),
  ];

  // Add information about the number of sidebars.
  if (!empty($variables['page']['sidebar_first'])
    && !empty($variables['page']['sidebar_second'])
  ) {
    $variables['content_column_class'] = 'col-md-6';
  }
  elseif (!empty($variables['page']['sidebar_first'])
    || !empty($variables['page']['sidebar_second'])
  ) {
    $variables['content_column_class'] = 'col-md-9';
  }
  else {
    $variables['content_column_class'] = 'col-md-12';
  }

  // Set footer region column classes.
  $variables['footer_column_class'] = (!empty($variables['page']['footer_right']) ? 'col-sm-8' : 'col-sm-12');

  $variables['page_logo_title'] = t('Home - @sitename', ['@sitename' => variable_get('site_name', 'European Commission')]);

  $node = &$variables['node'];

  if (isset($node)) {
    // Adding generic introduction field to be later rendered in page template.
    $introduction = variable_get('ec_europa_introduction_field', FALSE);

    $variables['ec_europa_introduction'] = isset($node->{$introduction})
        ? field_view_field('node', $node, $introduction, ['label' => 'hidden']) : NULL;

    // Check if Display Suite is handling node.
    if (module_exists('ds')) {
      $layout = ds_get_layout('node', $node->type, 'full');
      if ($layout && isset($layout['is_nexteuropa']) && $layout['is_nexteuropa'] == TRUE) {
        // If our display suite layout has a header region.
        if (isset($layout['regions']['left_header'])) {
          // Move the header_bottom to the node.
          $variables['node']->header_bottom = $variables['page']['header_bottom'];
          unset($variables['page']['header_bottom']);
        }
        ctools_class_add($layout['layout']);

        if (isset($node->ds_switch) && $node->ds_switch != 'college') {
          $variables['node']->header_bottom_modifier = 'page-bottom-header--full-grey';
        }

        // This disables message-printing on ALL page displays.
        $variables['show_messages'] = FALSE;

        // Add tabs to node object so we can put it in the DS template instead.
        if (isset($variables['tabs'])) {
          $node->local_tabs = drupal_render($variables['tabs']);
        }

        // Use page__ds.tpl.php unless it is an exception.
        $custom_page_templates = ['page__gallery'];
        if (empty(array_intersect($variables['theme_hook_suggestions'], $custom_page_templates))) {
          $variables['theme_hook_suggestions'][] = 'page__ds';
        }
      }
    }
  }
  // Default ds template for taxonomy term pages using display suite.
  if (arg(1) == 'term' && is_numeric(arg(2))) {
    $type = taxonomy_term_load(arg(2))->vocabulary_machine_name;
    $ds_layout = ds_get_layout('taxonomy_term', $type, 'full');

    if (module_exists('ds') && $ds_layout) {
      $variables['theme_hook_suggestions'][] = 'page__ds';
      $main = !empty($ds_layout['settings']['regions']['left']) ? 'col-md-9 col-md-offset-3' : 'col-md-12';
      // Default drupal taxonomy page outputs this message
      // when no nodes are associated with the current term.
      if (!empty($variables['page']['content']['system_main']['no_content'])) {
        $variables['page']['content']['system_main']['no_content']['#prefix'] = '<div class="container-fluid"><p>';
        $variables['page']['content']['system_main']['no_content']['#suffix'] = '</p></div>';
      }

      if (!empty($variables['page']['content']['system_main']['term_heading'])) {
        if (!empty($variables['page']['content']['system_main']['nodes'])) {
          $variables['page']['content']['system_main']['nodes']['#main'] = $main;
          $variables['page']['content']['system_main']['nodes']['#pre_render'] = ['_europa_term_heading'];
        }
      }
    }
  }

  $variables['logo_classes'] = 'logo site-header__logo';
}

/**
 * Pre-render function for taxonomy pages.
 */
function _europa_term_heading($element) {
  $element['#prefix'] = '<div class="container-fluid"><div class="' . $element['#main'] . '">';
  $element['#suffix'] = '</div></div>';
  return $element;
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
 * Implements form_alter().
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
 * Implements theme_status_messages().
 */
function europa_status_messages($variables) {
  $display = $variables['display'];
  $output = [];

  $status_heading = [
    'status' => t('Success'),
    'error' => t('Error'),
    'warning' => t('Warning'),
    'info' => t('Information'),
  ];

  foreach (drupal_get_messages($display) as $type => $messages) {
    $body = '';
    foreach ($messages as $message) {
      $body .= '  <p>' . $message . "</p>\n";
    }

    $output[] = [
      '#theme' => 'europa_status_message',
      '#message_classes' => [
        $type,
        'alert',
      ],
      '#message_title' => $status_heading[$type],
      '#message_type' => $type . ' message',
      '#message_body' => $body,
    ];
  }

  return drupal_render($output);
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

/**
 * Implements template_preprocess_comment_wrapper().
 */
function europa_preprocess_comment_wrapper(&$variables) {
  $variables['comment_count'] = '';
  if ($variables['node']->comment_count > 0) {
    $variables['comment_count'] = $variables['node']->comment_count;
  }
}

/**
 * Implements template_preprocess_comment().
 */
function europa_preprocess_comment(&$variables) {
  $comment = $variables['elements']['#comment'];
  $variables['created'] = format_date($comment->created, 'ec_date');
  $variables['submitted'] = t('!username', ['!username' => $variables['author']]) . '<span class="submitted-date">' . $variables['created'] . '</span>';
  $variables['title'] = check_plain($comment->subject);
  $variables['permalink'] = t('Permalink');
  $variables['title_attributes_array']['class'] = 'comment__title';
}
