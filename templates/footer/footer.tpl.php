<?php

/**
 * @file
 * Contains template file.
 */
?>

<footer class="ecl-footer">
    <div class="ecl-footers__site-corporate">
        <div class="ecl-container">
          <?php if (!empty($footer_improved)): ?>
              <div class="ecl-row">
                <?php print render($footer_improved); ?>
              </div>
          <?php endif; ?>
            <div class="ecl-row">
              <?php if (!empty($footer_left)): ?>
                  <div class="ecl-col-sm ecl-footers__column">
                    <?php print render($footer_left); ?>
                  </div>
              <?php endif; ?>

              <?php if (!empty($footer_middle)): ?>
                  <div class="ecl-col-sm ecl-footers__column">
                    <?php print render($footer_middle); ?>
                  </div>
              <?php endif; ?>

              <?php if (!empty($footer_right)): ?>
                  <div class="ecl-col-sm ecl-footers__column">
                    <?php print render($footer_right); ?>
                  </div>
              <?php endif; ?>
            </div>
        </div>
    </div>
  <?php if (!empty($footer_bottom)): ?>
      <div class="ecl-footers__ec">
          <div class="ecl-container">
              <div class="ecl-row">
                  <div class="ecl-col-sm">
                    <?php print render($footer_bottom); ?>
                  </div>
              </div>
          </div>
      </div>
  <?php endif; ?>
</footer>
