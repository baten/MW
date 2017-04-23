<h1 class="page-title"><?php echo __('Attribute details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($attribute['Attribute']['id']); ?></dd>

	<dt><?php echo __('Type'); ?></dt>
	<dd>\<?php echo $this->Html->link($attribute['Type']['title'], array('controller' => 'types', 'action' => 'view', $attribute['Type']['id'])); ?><dd>

	<dt><?php echo __('Title'); ?></dt>
	<dd><?php echo h($attribute['Attribute']['title']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($attribute['Attribute']['status']); ?></dd>

</dl>
