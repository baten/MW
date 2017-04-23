<h1 class="page-title"><?php echo __('Channel details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($channel['Channel']['id']); ?></dd>

	<dt><?php echo __('Country'); ?></dt>
	<dd>\<?php echo $this->Html->link($channel['Country']['name'], array('controller' => 'countries', 'action' => 'view', $channel['Country']['id'])); ?><dd>

	<dt><?php echo __('City'); ?></dt>
	<dd>\<?php echo $this->Html->link($channel['City']['title'], array('controller' => 'cities', 'action' => 'view', $channel['City']['id'])); ?><dd>

	<dt><?php echo __('Zip'); ?></dt>
	<dd><?php echo h($channel['Channel']['zip']); ?></dd>

	<dt><?php echo __('Price'); ?></dt>
	<dd><?php echo h($channel['Channel']['price']); ?></dd>

</dl>
