<div id="simplemeta-admin-settings">
	<div id="simplemeta-admin-settings-left">
		<div id="simplemeta-admin-settings-left-search">
			<input alt="<?php echo t('Enter path here') ?>" value="<?php echo t('Enter path here') ?>" type="text" id="simplemeta-admin-settings-left-search-field" class="gray"/>
		</div>
		<div id="simplemeta-admin-settings-left-results">
			<div id="simplemeta-admin-settings-left-results-up" class="disabled"><div></div></div>
			<div id="simplemeta-admin-settings-left-results-container"></div>
			<div id="simplemeta-admin-settings-left-results-down" class="disabled"><div></div></div>
		</div>
	</div>
	<div id="simplemeta-admin-settings-right">
		<div id="simplemeta-admin-settings-right-status">
		</div>
		<div id="simplemeta-admin-settings-right-form" class="form-item">
			<label><?php echo t('Path') ?>:</label>
			<input class="simplemeta-path" type="text"/>
			<div class="description">
				<?php echo t('Specify the existing path you wish to alias. For example: node/28, forum/1, taxonomy/term/1.') ?>
			</div>
			
			<label><?php echo t('Title') ?>:</label>
			<input class="simplemeta-title" type="text"/>
			<div class="description">
				<?php echo t('Enter a short abstract. Typically it is one sentence.') ?>
			</div>
			
			<label><?php echo t('Keywords') ?>:</label>
			<input class="simplemeta-keywords" type="text"/>
			<div class="description">
				<?php echo t('Enter a comma separated list of keywords.
				Avoid duplication of words as this will lower your search engine ranking.') ?>
			</div>
			
			<label><?php echo t('Description') ?>:</label>
			<textarea class="simplemeta-description" type="text"></textarea>
			<div class="description">
				<?php echo t('Enter a description.
				Limit your description to about 20 words.
				It should not contain any HTML tags or other formatting.') ?>
			</div>
			
			<input class="simplemeta-id" type="hidden"/>
		</div>
	</div>
	
	<div id="simplemeta-admin-settings-right-menu-new" title="<?php echo t('New') ?>"></div>
	<div id="simplemeta-admin-settings-right-menu-save" class="disabled" title="<?php echo t('Save') ?>"></div>
	<div id="simplemeta-admin-settings-right-menu-delete" class="disabled" title="<?php echo t('Delete') ?>"></div>
	<div style="clear: both"></div>
</div>