<?php
// $Id: page.tpl.php,v 1.4 2009/07/13 23:52:58 andregriffin Exp $
$root_to_theme = base_path().path_to_theme();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" >
<head>
<title><?php print $head_title ?></title>
<?php print $head ?><?php print $styles ?>
<link href="<?php print base_path() . path_to_theme(); ?>/style-esportiva.css" rel="stylesheet" media="all" />
<?php print $scripts ?>
<!--[if lt IE 8]>
<script type="text/javascript" src="<?php print $root_to_theme?>/hack-zindex-ie7.js"></script>
<![endif]-->
<!--[if lte IE 7]><?php print framework_get_ie_styles(); ?><![endif]-->
<!--If Less Than or Equal (lte) to IE 7-->
</head>
<body<?php print framework_body_class($left, $right); ?>>
<!-- Layout -->
<div class="container">
  <!-- add "showgrid" class to display grid -->
  <?php include("header.php"); ?>
  <!-- /#header -->
  <div class="barra-nome-divisao"><a href="<?php print base_path(); ?>esportiva">Esportiva</a></div>
  <?php print $breadcrumb; ?>
  <?php if ($left): ?>
  <div id="sidebar-left" class="sidebar"> <?php print $left ?> </div>
  <!-- /#sidebar-left -->
  <?php endif; ?>
  <?php if ($right): ?>
  <div id="sidebar-right" class="sidebar"> <?php print $right ?> </div>
  <!-- /#sidebar-right -->
  <?php endif; ?>
  <div id="main">
    <?php
  if($node->nid != 28):
  ?>
    <?php if ($title): print '<h2 class="'. ($tabs ? 'with-tabs' : '') .' node-title-h2">'. $title .'</h2>'; endif; ?>
    <?php if ($tabs): print '<div id="tabs-wrapper" class="clear-block"><ul class="tabs primary">'. $tabs .'</ul>'; endif; ?>
    <?php if ($tabs2): print '<ul class="tabs secondary">'. $tabs2 .'</ul>'; endif; ?>
    <?php if ($tabs): print '<span class="clear"></span></div>'; endif; ?>
    <?php if ($show_messages && $messages): print $messages; endif; ?>
    <?php print $help; ?> <?php print $content ?>
    <?php
	else:
	?>
    <?php if ($show_messages && $messages): print $messages; endif; ?>
    <div id="main-front-page" class="esportiva">
       <div class="blocos borda">
        <div class="welcome"> <?php print $a_int; ?>
          <div class="mini-blocos"> <?php print $c_int; ?> </div>
          <!--<div class="mini-blocos-b"> <?php print $d_int; ?> </div>-->
        </div>
        <div class="destaque"> <?php print $b_int; ?> </div>
        <div class="clear"></div>
      </div>
      <div class="blocos"><?php print $e_int; ?> </div>
    </div>
    <?php
	endif;
	?>
  </div>
  <!-- /#main -->
</div>
<div><?php print $footer_message . $footer ?> <?php print $feed_icons ?></div>
<?php include("footer.php"); ?>
<!-- /#footer -->
<!-- /.container -->
<!-- /layout -->
<?php print $closure ?>
</body>
</html>