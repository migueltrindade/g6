<?php
// $Id: search-theme-form.tpl.php,v 1.1 2007/10/31 18:06:38 dries Exp $

/**
 * @file search-theme-form.tpl.php
 * Default theme implementation for displaying a search form directly into the
 * theme layout. Not to be confused with the search block or the search page.
 *
 * Available variables:
 * - $search_form: The complete search form ready for print.
 * - $search: Array of keyed search elements. Can be used to print each form
 *   element separately.
 *
 * Default keys within $search:
 * - $search['search_theme_form']: Text input area wrapped in a div.
 * - $search['submit']: Form submit button.
 * - $search['hidden']: Hidden form elements. Used to validate forms when submitted.
 *
 * Since $search is keyed, a direct print of the form element is possible.
 * Modules can add to the search form so it is recommended to check for their
 * existance before printing. The default keys will always exist.
 *
 *   <?php if (isset($search['extra_field'])): ?>
 *     <div class="extra-field">
 *       <?php print $search['extra_field']; ?>
 *     </div>
 *   <?php endif; ?>
 *
 * To check for all available data within $search, use the code below.
 *
 *   <?php print '<pre>'. check_plain(print_r($search, 1)) .'</pre>'; ?>
 *
 * @see template_preprocess_search_theme_form()<?php print $search_form; ?>
 */
?>
<?php
print $search['search_theme_form'];
print $search['hidden'];
?>
<div class="input-submit-search-topo">
<input type="image" src="<?php print base_path().path_to_theme(); ?>/images/bt-ok-search.gif" name="op" id="edit-submit-1" />
</div>
<div class="divisor-search-icons">
<img src="<?php print base_path().path_to_theme(); ?>/images/divisor-busca.gif" alt="" /></div>
<div class="icons"><a href="<?php print base_path(); ?>rss.xml" title="rss"><img src="<?php print base_path().path_to_theme(); ?>/images/icon-rss.gif" alt="rss" /></a>
<a href="http://www.twitter.com/Grade_6" target="_blank" title="Twitter"><img src="<?php print base_path().path_to_theme(); ?>/images/icon-twitter.gif" alt="Twitter" /></a>
</div>