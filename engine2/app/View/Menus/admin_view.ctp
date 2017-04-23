<h1 class="page-title"><?php echo __('Menu details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($menu['Menu']['id']); ?></dd>

	<dt><?php echo __('Parent Menu'); ?></dt>
	<dd>\<?php echo $this->Html->link($menu['ParentMenu']['title'], array('controller' => 'menus', 'action' => 'view', $menu['ParentMenu']['id'])); ?><dd>

	<dt><?php echo __('Title'); ?></dt>
	<dd><?php echo h($menu['Menu']['title']); ?></dd>

	<dt><?php echo __('Slug'); ?></dt>
	<dd><?php echo h($menu['Menu']['slug']); ?></dd>

	<dt><?php echo __('Location'); ?></dt>
	<dd><?php echo h($menu['Menu']['location']); ?></dd>

	<dt><?php echo __('Type'); ?></dt>
	<dd><?php echo h($menu['Menu']['type']); ?></dd>

	<dt><?php echo __('Content'); ?></dt>
	<dd><?php echo h($menu['Menu']['content']); ?></dd>

	<dt><?php echo __('Is Deleteable'); ?></dt>
	<dd><?php echo h($menu['Menu']['is_deleteable']); ?></dd>

	<dt><?php echo __('Order'); ?></dt>
	<dd><?php echo h($menu['Menu']['order']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($menu['Menu']['status']); ?></dd>

</dl>
