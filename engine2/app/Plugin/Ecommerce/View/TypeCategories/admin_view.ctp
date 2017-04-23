<h1 class="page-title"><?php echo __('Type Category details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($typeCategory['TypeCategory']['id']); ?></dd>

	<dt><?php echo __('Type'); ?></dt>
	<dd>\<?php echo $this->Html->link($typeCategory['Type']['title'], array('controller' => 'types', 'action' => 'view', $typeCategory['Type']['id'])); ?><dd>

	<dt><?php echo __('Category'); ?></dt>
	<dd>\<?php echo $this->Html->link($typeCategory['Category']['title'], array('controller' => 'categories', 'action' => 'view', $typeCategory['Category']['id'])); ?><dd>

</dl>
