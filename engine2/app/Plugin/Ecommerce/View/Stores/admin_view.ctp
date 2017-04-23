<h1 class="page-title"><?php echo __('Store details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($store['Store']['id']); ?></dd>

	<dt><?php echo __('Details'); ?></dt>
	<dd><?php echo h($store['Store']['details']); ?></dd>

	<dt><?php echo __('Order'); ?></dt>
	<dd><?php echo h($store['Store']['order']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($store['Store']['status']); ?></dd>

</dl>
