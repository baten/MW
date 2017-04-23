<h1 class="page-title"><?php echo __('Purchase details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($purchase['Purchase']['id']); ?></dd>

	<dt><?php echo __('Product'); ?></dt>
	<dd>\<?php echo $this->Html->link($purchase['Product']['title'], array('controller' => 'products', 'action' => 'view', $purchase['Product']['id'])); ?><dd>

	<dt><?php echo __('Unit Price'); ?></dt>
	<dd><?php echo h($purchase['Purchase']['unit_price']); ?></dd>

	<dt><?php echo __('Quantity'); ?></dt>
	<dd><?php echo h($purchase['Purchase']['quantity']); ?></dd>

	<dt><?php echo __('Created'); ?></dt>
	<dd><?php echo h($purchase['Purchase']['created']); ?></dd>

</dl>
