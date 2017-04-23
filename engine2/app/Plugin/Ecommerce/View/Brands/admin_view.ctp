<h1 class="page-title"><?php echo __('Brand details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($brand['Brand']['id']); ?></dd>

	<dt><?php echo __('Title'); ?></dt>
	<dd><?php echo h($brand['Brand']['title']); ?></dd>

	<dt><?php echo __('Meta Keys'); ?></dt>
	<dd><?php echo h($brand['Brand']['meta_keys']); ?></dd>

	<dt><?php echo __('Meta Description'); ?></dt>
	<dd><?php echo h($brand['Brand']['meta_description']); ?></dd>

	<dt><?php echo __('Description'); ?></dt>
	<dd><?php echo h($brand['Brand']['description']); ?></dd>

	<dt><?php echo __('Images'); ?></dt>
	<dd><?php echo h($brand['Brand']['images']); ?></dd>

	<dt><?php echo __('Order'); ?></dt>
	<dd><?php echo h($brand['Brand']['order']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($brand['Brand']['status']); ?></dd>

</dl>
