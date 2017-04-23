<h1 class="page-title"><?php echo __('City details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($city['City']['id']); ?></dd>

	<dt><?php echo __('Country'); ?></dt>
	<dd>\<?php echo $this->Html->link($city['Country']['name'], array('controller' => 'countries', 'action' => 'view', $city['Country']['id'])); ?><dd>

	<dt><?php echo __('Title'); ?></dt>
	<dd><?php echo h($city['City']['title']); ?></dd>

</dl>
