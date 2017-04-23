<h1 class="page-title"><?php echo __('Product Order details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($productOrder['ProductOrder']['id']); ?></dd>

	<dt><?php echo __('Client Detail'); ?></dt>
	<dd><?php echo h($productOrder['ProductOrder']['client_detail']); ?></dd>

	<dt><?php echo __('Order Detail'); ?></dt>
	<dd><?php echo h($productOrder['ProductOrder']['order_detail']); ?></dd>

	<dt><?php echo __('Payment Detail'); ?></dt>
	<dd><?php echo h($productOrder['ProductOrder']['payment_detail']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($productOrder['ProductOrder']['status']); ?></dd>

	<dt><?php echo __('Order Date'); ?></dt>
	<dd><?php echo h($productOrder['ProductOrder']['order_date']); ?></dd>

	<dt><?php echo __('Complete Date'); ?></dt>
	<dd><?php echo h($productOrder['ProductOrder']['complete_date']); ?></dd>

</dl>
