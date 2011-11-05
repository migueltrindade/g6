<div id="header" class="clearfix">
  <?php if ($search_box): ?>
  <?php print $search_box ?>
  <?php endif; ?>
  <div id="logo"> <a href="<?php print check_url($front_page); ?>" title="<?php print check_plain($site_name); ?>"> <img src="<?php print check_url($logo); ?>" alt="<?php print check_plain($site_name); ?>" /> </a>
    <h1><?php print check_plain($site_name); ?></h1>
  </div>
  <?php 
	if($menu_principal) {
	?>
  <div id="menu-principal">
    <div class="left"></div>
    <div class="bg"><?php print $menu_principal; ?></div>
    <div class="right"></div>
  </div>
  <?php } ?>
  <?php print $header; ?> 
</div>
