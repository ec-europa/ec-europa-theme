<?php

/**
 * @file
 * Contains template file.
 */
?>
<?php foreach ($status_messages['status_messages'] as $status_message): ?>
  <div class="ecl-message<?php
  if (!empty($status_message['modifier'])) {
    print ' ecl-message--' . $status_message['modifier'];
  }
  ?>" role="alert">
    <?php if (!empty($status_message['status_heading'])): ?>
      <span class="ecl-sr-only"><?php  print render($status_message['status_heading']) ?></span>
    <?php endif; ?>
    <button type="button" class="ecl-message__dismiss" aria-label="Dismiss this alert">&times;</button>
    <?php print render($status_message['messages']); ?>
  </div>
<?php endforeach; ?>
