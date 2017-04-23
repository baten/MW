<h1 class="page-title"><?php echo __('Web Page details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($webPage['WebPage']['id']); ?></dd>

	<dt><?php echo __('Title'); ?></dt>
	<dd><?php echo h($webPage['WebPage']['title']); ?></dd>

	<dt><?php echo __('Slug'); ?></dt>
	<dd><?php echo h($webPage['WebPage']['slug']); ?></dd>

	<dt><?php echo __('Meta Keys'); ?></dt>
	<dd><?php echo h($webPage['WebPage']['meta_keys']); ?></dd>

	<dt><?php echo __('Meta Description'); ?></dt>
	<dd><?php echo h($webPage['WebPage']['meta_description']); ?></dd>

	<dt><?php echo __('Description'); ?></dt>
	<dd><?php echo h($webPage['WebPage']['description']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($webPage['WebPage']['status']); ?></dd>

</dl>
