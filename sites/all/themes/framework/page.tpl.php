<?php
// $Id: page.tpl.php,v 1.4 2009/07/13 23:52:58 andregriffin Exp $
$root_to_theme = base_path().path_to_theme();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>">
<head>
<title><?php print $head_title ?></title>
<?php print $head; ?><?php print $styles; ?><?php print $scripts; ?>
<!--[if lt IE 8]>
<script type="text/javascript" src="<?php print $root_to_theme?>/hack-zindex-ie7.js"></script>
<![endif]-->
<!--[if lte IE 7]><?php print framework_get_ie_styles(); ?><![endif]-->
<!--If Less Than or Equal (lte) to IE 7-->
</head>
<body<?php print framework_body_class($left, $right); ?>>
<!-- Layout -->
<div class="container">
  <?php include("header.php"); ?>
  <!-- /#header -->
  <div class="wrap-destaque-home">
    <div id="pager"></div>
    <ul id="displayDestaque">
      <li>
        <div class="destaque-home destaque-treinamentos">
          <div class="bgmenu bgmenu-treinamentos">
            <?php print $md_treinamentos; ?>
          </div>
        </div>
      </li>
      <li>
        <div class="destaque-home destaque-profissional">
          <div class="bgmenu bgmenu-profissional">
            <?php print $md_profissional; ?>
          </div>
        </div>
      </li>
      <li>
        <div class="destaque-home destaque-esportiva">
          <div class="bgmenu bgmenu-esportiva">
            <?php print $md_esportiva; ?>
          </div>
        </div>
      </li>
      <!--<li>
        <div class="destaque-home destaque-projetos">
          <div class="bgmenu bgmenu-projetos">
            <?php print $md_eventos; ?>
          </div>
        </div>
      </li>-->
    </ul>
  </div>
  <?php print $breadcrumb; ?>
  <?php if ($show_messages && $messages): print $messages; endif; ?>
  <?php print $help; ?>
  <?php 
	
	if(!$is_front){ 
	
		if($left) { 
	?>
  <div id="sidebar-left" class="sidebar"> <?php print $left ?>
    <div class="clear"></div>
  </div>
  <!-- /#sidebar-left -->
  <?php } 
		if($right){ ?>
  <div id="sidebar-right" class="sidebar"> <?php print $right ?>
    <div class="clear"></div>
  </div>
  <!-- /#sidebar-right -->
  <?php 
		}
	} 
	?>
  <div id="main">
    <?php if($is_front) { ?>
    <div id="col-left-home">
      <div id="block-sobre-nos-home">
        <div id="foto-empresa-home"></div>
        <div id="mission"><h3>Sobre n&oacute;s</h3><?php include("missao.php"); ?></div>
      </div>
      <div id="a_home"><?php print $a_home; ?> </div>
      <div id="b_home"><?php print $b_home; ?> </div>
      <div id="c_home"><?php print $c_home; ?> </div>
      <div class="clear"></div>
    </div>
    <div id="col-right-home"> <?php print $direita; ?> </div>
    <div class="clear"></div>
    <?php } else { ?>
    <?php if ($title): print '<h2 class="'. ($tabs ? 'with-tabs' : '') .' node-title-h2">'. $title .'</h2>'; endif; ?>
    <?php if ($tabs): print '<div id="tabs-wrapper" class="clear-block"><ul class="tabs primary">'. $tabs .'</ul>'; endif; ?>
    <?php if ($tabs2): print '<ul class="tabs secondary">'. $tabs2 .'</ul>'; endif; ?>
    <?php if ($tabs): print '<span class="clear"></span></div>'; endif; ?>
    <?php print $content;?>
    <?php } ?>
  </div>
  <!-- /#main -->
</div>
<div><?php print $footer_message ?></div>
<?php include("footer.php"); ?>
<!-- /#footer -->
<!-- /.container -->
<!-- /layout -->
<?php print $closure ?>
</body>
</html>