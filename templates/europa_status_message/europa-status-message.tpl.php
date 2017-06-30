<?php

/**
 * @file
 * Contains the markup for the message block.
 */
?>

<div class="ecl-messages <?php print $message_classes; ?>">
  <span class="ecl-sr-only"><?php print $message_type; ?> </span>
  <button type="button" class="ecl-message__dismiss" aria-label="Dismiss this alert">&times;</a>

  <?php if ($message_title): ?>
      <div class="ecl-message__title"><?php print $message_title; ?></div>
  <?php else: ?>
    <?php print ($message_type ? '<span class="sr-only">' . $message_type . ':</span>' : ''); ?>
  <?php endif; ?>

  <?php if ($message_body): ?>
    <p class="ecl-message__body">
      <?php print render($message_body); ?>
    </p>
  <?php endif; ?>

</div>
