<h1 class="page-title"><?php echo __('Product Stock details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($productStock['ProductStock']['id']); ?></dd>

	<dt><?php echo __('Product'); ?></dt>
	<dd>\<?php echo $this->Html->link($productStock['Product']['title'], array('controller' => 'products', 'action' => 'view', $productStock['Product']['id'])); ?><dd>

	<dt><?php echo __('Attributes'); ?></dt>
	<dd><?php echo h($productStock['ProductStock']['attributes']); ?></dd>

	<dt><?php echo __('AttributeValues'); ?></dt>
	<dd><?php echo h($productStock['ProductStock']['attributeValues']); ?></dd>

	<dt><?php echo __('Quantity'); ?></dt>
	<dd><?php echo h($productStock['ProductStock']['quantity']); ?></dd>

	<dt><?php echo __('Sold'); ?></dt>
	<dd><?php echo h($productStock['ProductStock']['sold']); ?></dd>

</dl>
