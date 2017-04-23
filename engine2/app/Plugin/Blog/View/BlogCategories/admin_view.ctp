<h1 class="page-title"><?php echo __('Category details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($category['Category']['id']); ?></dd>

	<dt><?php echo __('Parent Category'); ?></dt>
	<dd>\<?php echo $this->Html->link($category['ParentCategory']['title'], array('controller' => 'categories', 'action' => 'view', $category['ParentCategory']['id'])); ?><dd>

	<dt><?php echo __('Title'); ?></dt>
	<dd><?php echo h($category['Category']['title']); ?></dd>

	<dt><?php echo __('Slug'); ?></dt>
	<dd><?php echo h($category['Category']['slug']); ?></dd>

	<dt><?php echo __('Meta Keys'); ?></dt>
	<dd><?php echo h($category['Category']['meta_keys']); ?></dd>

	<dt><?php echo __('Meta Description'); ?></dt>
	<dd><?php echo h($category['Category']['meta_description']); ?></dd>

	<dt><?php echo __('Description'); ?></dt>
	<dd><?php echo h($category['Category']['description']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($category['Category']['status']); ?></dd>

</dl>
