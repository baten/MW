<h1 class="page-title"><?php echo __('Attribute Value details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($attributeValue['AttributeValue']['id']); ?></dd>

	<dt><?php echo __('Attribute'); ?></dt>
	<dd>\<?php echo $this->Html->link($attributeValue['Attribute']['title'], array('controller' => 'attributes', 'action' => 'view', $attributeValue['Attribute']['id'])); ?><dd>

	<dt><?php echo __('Value'); ?></dt>
	<dd><?php echo h($attributeValue['AttributeValue']['value']); ?></dd>

	<dt><?php echo __('Has Price'); ?></dt>
	<dd><?php echo h($attributeValue['AttributeValue']['has_price']); ?></dd>

</dl>
