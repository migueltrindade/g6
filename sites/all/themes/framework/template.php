<?php
// $Id: template.php,v 1.4 2009/07/13 23:52:57 andregriffin Exp $

/**
 * Sets the body-tag class attribute.
 *
 * Adds 'sidebar-left', 'sidebar-right' or 'sidebars' classes as needed.
 */
function framework_body_class($left, $right) {
  $class = array();

  if ($left != '' && $right != '') {
    $class[] = 'sidebars';
  }
  elseif ($left != '') {
    $class[] = 'sidebar-left';
  }
  elseif ($right != '') {
    $class[] = 'sidebar-right';
  }

  if (arg(0) == 'admin') {
    $class[] = 'admin';
  }

  if ($class) {
    print ' class="' . implode(' ', $class) . '"';
  }
}

/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
 

function phptemplate_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
		$breadcrumb[] = drupal_get_title();
    return '<div class="breadcrumb"><span>Você está aqui:</span> '. implode(' » ', $breadcrumb) .'</div>';
  }
}

/**
 * Allow themable wrapping of all comments.
 */
function framework_comment_wrapper($content, $node) {
  if (!$content || $node->type == 'forum') {
    return '</p>
    <div id="comments">'. $content .'</div>';
  }
  else {
    return '<div id="comments"><h2 class="comments">'. t('Comments') .'</h2>'. $content .'</div>';
  }
}

/**
 * Override or insert PHPTemplate variables into the templates.
 */
function framework_preprocess_page(&$vars) {
	
	/*$nid = $vars['node']->nid;
	if($nid == 29) {
		$breadcrumb[] = l('Início', null);
		$breadcrumb[] .= t('treinamentos');
	} elseif($nid == 28){
		$breadcrumb[] = l('Início', null);
		$breadcrumb[] .= t('esportiva');
	} elseif($nid == 16){
		$breadcrumb[] = l('Início', null);
		$breadcrumb[] .= t('profissional');
	}
	drupal_set_breadcrumb($breadcrumb);
	$breadcrum = drupal_get_breadcrumb();
	$vars['breadcrumb'] = theme('breadcrumb',$breadcrum);*/
	
	
	$vars['tabs2'] = menu_secondary_local_tasks();
	
	if (module_exists('path')) {
		$alias = drupal_get_path_alias(str_replace('/edit', '', $_GET['q']));
		
		 $suggestions = array();
		 $template_filename = 'page';
		 foreach (explode('/', $alias) as $path_part) {
			 $template_filename = $template_filename .'-'. $path_part;
			 $suggestions[] = $template_filename;
		 }

		$vars['template_files'] = $suggestions;
	}
	
	return $vars;
}


/**
 * Returns the rendered local tasks. The default implementation renders
 * them as tabs. Overridden to split the secondary tasks.
 *
 * @ingroup themeable
 */
function phptemplate_menu_local_tasks() {
  return menu_primary_local_tasks();
}

function framework_comment_submitted($comment) {
  return t('by <strong>!username</strong> | !datetime',
    array(
      '!username' => theme('username', $comment),
      '!datetime' => format_date($comment->timestamp)
    ));
}

function phptemplate_node_submitted($node) {
  return t('!datetime | by <strong>!username</strong>',
    array(
      '!username' => theme('username', $node),
      '!datetime' => format_date($node->created),
    ));
}

/**
 * Override or insert variables into the block templates.
	*
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function framework_preprocess_block(&$vars, $hook) {
  $block = $vars['block'];
  //var_dump($block);

  // Special classes for blocks.
  $classes = array('block');
  $classes[] = 'block-' . $block->module;
  $classes[] = 'block-'. $block->bid;
  $classes[] = 'region-' . $vars['block_zebra'];
  $classes[] = $vars['zebra'];
  $classes[] = 'region-count-' . $vars['block_id'];
  $classes[] = 'count-' . $vars['id'];

  $vars['edit_links_array'] = array();
  $vars['edit_links'] = '';
  /*if (user_access('administer blocks')) {
    include_once './' . drupal_get_path('theme', 'framework') . '/template.block-editing.inc';
    framework_preprocess_block_editing($vars, $hook);
    $classes[] = 'with-block-editing';
  }*/

  // Render block classes.
  $vars['classes'] = implode(' ', $classes);
}

/**
 * Generates IE CSS links.
 */
function framework_get_ie_styles() {
  $iecss = '<link type="text/css" rel="stylesheet" media="all" href="'. base_path() . path_to_theme() .'/ie.css" />';
  return $iecss;
}

function framework_get_ie6_styles() {
  $iecss = '<link type="text/css" rel="stylesheet" media="all" href="'. base_path() . path_to_theme() .'/ie6.css" />';
  return $iecss;
}

/**
 * Adds even and odd classes to <li> tags in ul.menu lists
 */ 
function phptemplate_menu_item($link, $has_children, $menu = '', $in_active_trail = FALSE, $extra_class = NULL) {
  static $zebra = FALSE;
  $zebra = !$zebra;
  $class = ($menu ? 'expanded' : ($has_children ? 'collapsed' : 'leaf'));
  if (!empty($extra_class)) {
    $class .= ' '. $extra_class;
  }
  if ($in_active_trail) {
    $class .= ' active-trail';
  }
  if ($zebra) {
    $class .= ' even';
  }
  else {
    $class .= ' odd';
  }
  return '<li class="'. $class .'">'. $link . $menu ."</li>\n";
}


/**
 * Colocar um <span> ao redor do texto do link
 * Função util para manipular uma imagem atraves do :hover do link
 */
function framework_links($links, $attributes = array('class' => 'links')) {
  $output = '';

  if (count($links) > 0) {
    $output = '<ul'. drupal_attributes($attributes) .'>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $class = $key;

      // Add first, last and active classes to the list of links to help out themers.
      if ($i == 1) {
        $class .= ' first';
      }
      if ($i == $num_links) {
        $class .= ' last';
      }
      if (isset($link['href']) && $link['href'] == $_GET['q']) {
        $class .= ' active';
      }
      $output .= '<li class="'. $class .'">';

      if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
        $link['html'] = TRUE;
        $output .= l('<span>'. $link['title'] .'</span>', $link['href'], $link);
      }
      else if (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span'. $span_attributes .'>'. $link['title'] .'</span>';
      }

      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
}

function framework_preprocess_node(&$vars) {
	//dsm($vars);
  $node = $vars['node'];
  $vars['template_files'][] = 'node-' . $vars['type'] . '-'. $node->nid;  
	return $vars;
}

function framework_theme() {
	return array(
		'contact_mail_page' => array(
			'arguments' => array('form' => NULL),
			'template' => 'contact-form'					
		)
	);
}

function framework_preprocess_contact_mail_page(&$vars) {
	
	//dsm($vars);
	if(arg(1) != '') {
		$vars['template_files'] = array('contact-form-' . arg(1));
		switch(arg(1)) {
			case 'treinamentos':
				$vars['form']['cid']['#default_value'] = 2;
			  $vars['form']['cid']['#value'] = 2;
				break;
				
			case 'profissional':
				$vars['form']['cid']['#default_value'] = 3;
			  $vars['form']['cid']['#value'] = 3;
				break;
				
			case 'esportiva':
				$vars['form']['cid']['#default_value'] = 4;
			  $vars['form']['cid']['#value'] = 4;
				break;
				
			case 'eventos':
				$vars['form']['cid']['#default_value'] = 5;
			  $vars['form']['cid']['#value'] = 5;
				break;
		}
		
	}

	$vars['cf_cid'] = drupal_render($vars['form']['cid']);
	
	$vars['cf_intro_message'] = drupal_render($vars['form']['contact_information']);	
	
	$vars['cf_nome'] = drupal_render($vars['form']['name']);
	
	$vars['cf_email'] = drupal_render($vars['form']['mail']);
	
	$vars['cf_fone'] = drupal_render($vars['form']['fone']);
	
	$vars['cf_empresa'] = drupal_render($vars['form']['empresa']);
	
	$vars['cf_assunto'] = drupal_render($vars['form']['subject']);
	
	$vars['cf_mensagem'] = drupal_render($vars['form']['message']);
	
	$vars['cf_copia'] = drupal_render($vars['form']['copy']);
	
	$vars['cf_enviar'] = drupal_render($vars['form']['submit']);
}

function framework_webform_mail_fields($cid, $value, $node, $indent = "") {
  $component = $cid ? $node->webform['components'][$cid] : null;

  // Check if this component needs to be included in the email at all.
  if ($cid && !$component['email'] && !in_array($component['type'], array('markup', 'fieldset', 'pagebreak'))) {
    return '';
  }

  // First check for component-level themes.
  $themed_output = theme('webform_mail_'. $component['type'], $value, $component);

  $message = '';
  if ($themed_output) {
    // Indent the output and add to message.
    $message .= $indent;
    $themed_output = rtrim($themed_output, "<br>");
    $message .= str_replace("<br>", "<br>". $indent, $themed_output);
    $message .= "<br>";
  }
  // Generic output for single values.
  elseif (!is_array($value)) {
    // Note that newlines cannot be preceeded by spaces to display properly in some clients.
    if ($component['name']) {
      // If text is more than 60 characters, put it on a new line with space after.
      $long = (drupal_strlen($indent . $component['name'] . $value)) > 60;
      $message .= $indent . $component['name'] .':'. (empty($value) ? "<br>" : ($long ? "<br>$value<br><br>" : " $value<br>"));
    }
  }
  // Else use a generic output for arrays.
  else {
    if ($cid != 0) {
      $message .= $indent . $component['name'] .":<br>";
    }
    foreach ($value as $k => $v) {
      foreach ($node->webform['components'] as $local_key => $local_value) {
        if ($local_value['form_key'] == $k && $local_value['pid'] == $cid) {
          $form_key = $local_key;
          break;
        }
      }
      $message .= theme('webform_mail_fields', $form_key, $v, $node, $indent .'  ');
    }
  }

  return ($message);
}