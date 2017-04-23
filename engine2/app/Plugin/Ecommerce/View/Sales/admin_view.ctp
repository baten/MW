<h1 class="page-title"><?php echo __('Sale details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($sale['Sale']['id']); ?></dd>

	<dt><?php echo __('Product'); ?></dt>
	<dd>\<?php echo $this->Html->link($sale['Product']['title'], array('controller' => 'products', 'action' => 'view', $sale['Product']['id'])); ?><dd>

	<dt><?php echo __('Quantity'); ?></dt>
	<dd><?php echo h($sale['Sale']['quantity']); ?></dd>

	<dt><?php echo __('Created'); ?></dt>
	<dd><?php echo h($sale['Sale']['created']); ?></dd>

</dl>
