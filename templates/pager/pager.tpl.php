<?php

/**
 * @file
 * Contains template file.
 */
?>
<div class="ecl-pager__wrapper">
  <ul class="ecl-pager">

    <?php if (isset($links['pager_previous'])): ?>
      <li class="ecl-pager__item ecl-pager__item--previous">
        <a class="ecl-pager__link" title="<?php t('Go to previous page') ?>" href="<?php print $links['pager_previous']['url'] ?>">‹ <?php print t('Previous')?></a>
      </li>
    <?php endif ?>

    <?php for ($cursor = $pager_first; $cursor <= $pager_last; $cursor++): ?>

      <?php if (($pager_last - $quantity > 1) && $cursor == $pager_first): ?>
        <li class="ecl-pager__item ecl-pager__item--first">
          <a class="ecl-pager__link" title="<?php t('Go to page !page', array('!page' => 1)) ?>" href="<?php print $links['pager_first']['url'] ?>">1</a>
        </li>
        <li class="ecl-pager__item ecl-pager__item--ellipsis">…</li>
      <?php endif ?>

      <?php if ($cursor == $pager_current): ?>
        <li class="ecl-pager__item ecl-pager__item--current"><span class="ecl-pager__item-text"><?php print t('Page') ?></span> <?php print $pager_current ?></li>
      <?php else: ?>
        <li class="ecl-pager__item">
          <a class="ecl-pager__link" title="<?php t('Go to page !page', array('!page' => $links['pager_link__' . $cursor]['label'])) ?>" href="<?php print $links['pager_link__' . $cursor]['url'] ?>"><?php print $links['pager_link__' . $cursor]['label'] ?></a>
        </li>
      <?php endif ?>

      <?php if (($pager_first + $quantity < $pager_max) && $cursor == $pager_last): ?>
        <li class="ecl-pager__item ecl-pager__item--ellipsis">…</li>
        <li class="ecl-pager__item ecl-pager__item--last">
          <a class="ecl-pager__link" title="<?php t('Go to page !page', array('!page' => $pager_max)) ?>" href="<?php print $links['pager_last']['url'] ?>"><?php print $pager_max ?></a>
        </li>
      <?php endif ?>

    <?php endfor ?>

    <?php if (isset($links['pager_next'])): ?>
      <li class="ecl-pager__item ecl-pager__item--next">
        <a class="ecl-pager__link" title="<?php t('Go to next page') ?>" href="<?php print $links['pager_next']['url'] ?>"><?php print t('Next') ?> ›</a>
      </li>
    <?php endif ?>
  </ul>
</div>
