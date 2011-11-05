<div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="block block-<?php print $block->module ?> block-<?php print $block->bid ?>">

  <?php if (!empty($block->subject)): ?>
  <h3><?php print $block->subject ?></h3>
  <?php endif;?>

  <div class="content">
    <?php //print $edit_links; ?>
    <?php print $block->content ?>
  </div>

</div>
