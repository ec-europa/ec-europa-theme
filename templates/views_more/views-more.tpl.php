<?php

/**
 * @file
 * Theme the more link.
 *
 * Variables:
 * - $view: The view object.
 * - $more_url: the url for the more link.
 * - $link_text: the text for the more link.
 *
 * @ingroup views_templates
 */
?>
<?php
// TODO: This must be done in a preprocess.
// Sometimes we have a special url and in these cases we manually replace it.
// We strictly limit it, because this is not replacing substitutions.
$available_blocks = ['latest_block', 'block'];
if ($view->name == 'announcements'
    && in_array($view->current_display, $available_blocks)
    && $view->display[$view->current_display]->handler->options['link_display'] == 'custom_url'):
  $more_url = $view->display[$view->current_display]->handler->options['link_url'];
endif;
?>
<div class="ecl-clearfix" style="width: 50%">
  <a href="<?php print $more_url; ?>" class="ecl-link ecl-link--all"><?php print $link_text; ?></a>
</div>
