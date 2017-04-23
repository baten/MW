<h1 class="page-title"><?php echo __('Sport details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($sport['Sport']['id']); ?></dd>

	<dt><?php echo __('Title'); ?></dt>
	<dd><?php echo h($sport['Sport']['title']); ?></dd>

	<dt><?php echo __('Meta Keys'); ?></dt>
	<dd><?php echo h($sport['Sport']['meta_keys']); ?></dd>

	<dt><?php echo __('Meta Description'); ?></dt>
	<dd><?php echo h($sport['Sport']['meta_description']); ?></dd>

	<dt><?php echo __('Description'); ?></dt>
	<dd><?php echo h($sport['Sport']['description']); ?></dd>

	<dt><?php echo __('Image Extension'); ?></dt>
	<dd><?php echo h($sport['Sport']['image_extension']); ?></dd>

	<dt><?php echo __('Order'); ?></dt>
	<dd><?php echo h($sport['Sport']['order']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($sport['Sport']['status']); ?></dd>

	<dt><?php echo __('Is Featured'); ?></dt>
	<dd><?php echo h($sport['Sport']['is_featured']); ?></dd>

</dl>
