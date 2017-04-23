<h1 class="page-title"><?php echo __('Product Order Note details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($productOrderNote['ProductOrderNote']['id']); ?></dd>

	<dt><?php echo __('Product Order'); ?></dt>
	<dd>\<?php echo $this->Html->link($productOrderNote['ProductOrder']['id'], array('controller' => 'product_orders', 'action' => 'view', $productOrderNote['ProductOrder']['id'])); ?><dd>

	<dt><?php echo __('Note'); ?></dt>
	<dd><?php echo h($productOrderNote['ProductOrderNote']['note']); ?></dd>

	<dt><?php echo __('Created'); ?></dt>
	<dd><?php echo h($productOrderNote['ProductOrderNote']['created']); ?></dd>

</dl>
