<h1 class="page-title"><?php echo __('Product details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($product['Product']['id']); ?></dd>

	<dt><?php echo __('Title'); ?></dt>
	<dd><?php echo h($product['Product']['title']); ?></dd>

	<dt><?php echo __('Slug'); ?></dt>
	<dd><?php echo h($product['Product']['slug']); ?></dd>

	<dt><?php echo __('Meta Keys'); ?></dt>
	<dd><?php echo h($product['Product']['meta_keys']); ?></dd>

	<dt><?php echo __('Meta Description'); ?></dt>
	<dd><?php echo h($product['Product']['meta_description']); ?></dd>

	<dt><?php echo __('Description'); ?></dt>
	<dd><?php echo h($product['Product']['description']); ?></dd>

	<dt><?php echo __('Images'); ?></dt>
	<dd><?php echo h($product['Product']['images']); ?></dd>

	<dt><?php echo __('Options'); ?></dt>
	<dd><?php echo h($product['Product']['options']); ?></dd>

	<dt><?php echo __('Categories'); ?></dt>
	<dd><?php echo h($product['Product']['categories']); ?></dd>

	<dt><?php echo __('Brands'); ?></dt>
	<dd><?php echo h($product['Product']['brands']); ?></dd>

	<dt><?php echo __('Price'); ?></dt>
	<dd><?php echo h($product['Product']['price']); ?></dd>

	<dt><?php echo __('Order'); ?></dt>
	<dd><?php echo h($product['Product']['order']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($product['Product']['status']); ?></dd>

	<dt><?php echo __('Created'); ?></dt>
	<dd><?php echo h($product['Product']['created']); ?></dd>

	<dt><?php echo __('Modified'); ?></dt>
	<dd><?php echo h($product['Product']['modified']); ?></dd>

</dl>
