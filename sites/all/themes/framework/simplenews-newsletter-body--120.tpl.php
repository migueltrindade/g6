<?php
// $Id: simplenews-newsletter-body.tpl.php,v 1.1.2.4 2009/01/02 11:59:33 sutharsan Exp $

/**
 * @file
 * Default theme implementation to format the simplenews newsletter body.
 *
 * Copy this file in your theme directory to create a custom themed body.
 * Rename it to simplenews-newsletter-body--<tid>.tpl.php to override it for a 
 * newsletter using the newsletter term's id.
 *
 * Available variables:
 * - node: Newsletter node object
 * - $body: Newsletter body (formatted as plain text or HTML)
 * - $title: Node title
 * - $language: Language object
 *
 * @see template_preprocess_simplenews_newsletter_body()
 */
?>
<table width="600" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td align="left" valign="middle"><a href="http://www.grade6.com.br" target="_blank"><img src="http://www.migueltrindade.com.br/grade6/sites/all/themes/framework/logo.png" alt="Grade6" /></a></td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td><a href="http://www.grade6.com.br/esportiva" title="Esportiva | Grade6"><img src="http://www.migueltrindade.com.br/grade6/sites/all/themes/framework/images/barra-newsletter-esportiva.jpg" alt="" width="600" height="53" /></a></td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td style="padding:20px;">
<h2><?php print $title; ?></h2>
<?php print $body; ?>
