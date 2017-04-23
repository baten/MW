<h1 class="page-title"><?php echo __('Product Attribute details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($productAttribute['ProductAttribute']['id']); ?></dd>

	<dt><?php echo __('Product'); ?></dt>
	<dd>\<?php echo $this->Html->link($productAttribute['Product']['title'], array('controller' => 'products', 'action' => 'view', $productAttribute['Product']['id'])); ?><dd>

	<dt><?php echo __('Attribute Value'); ?></dt>
	<dd>\<?php echo $this->Html->link($productAttribute['AttributeValue']['id'], array('controller' => 'attribute_values', 'action' => 'view', $productAttribute['AttributeValue']['id'])); ?><dd>

	<dt><?php echo __('Value'); ?></dt>
	<dd><?php echo h($productAttribute['ProductAttribute']['value']); ?></dd>

</dl>
