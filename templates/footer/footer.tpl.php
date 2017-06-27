<?php

/**
 * @file
 * Contains template file.
 */
?>

<footer class="ecl-footer">
  <?php if (!empty($footer_improved)): ?>
  <div class="ecl-footers__site-identity">
    <div class="ecl-container">
      <div class="ecl-row">
        <?php print render($footer_improved); ?>
      </div>
    </div>
  </div> 
  <?php endif; ?>
  <div class="ecl-footers__site-corporate">
    <div class="ecl-container">
      <div class="ecl-row">
        <div class="ecl-col-sm ecl-footers__column">
          <?php print render($footer_left); ?>
        </div>
        <div class="ecl-col-sm ecl-footers__column">
          <?php print render($footer_middle); ?>
        </div>
        <div class="ecl-col-sm ecl-footers__column">
          <?php print render($footer_right); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="ecl-footers__ec">
  <div class="ecl-container">
    <div class="ecl-row">
      <div class="ecl-col-sm">
        <?php print render($footer_bottom); ?>
      </div>
    </div>
  </div>
</div>
</footer>
