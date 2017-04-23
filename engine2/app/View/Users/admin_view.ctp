<h1 class="page-title"><?php echo __('User details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($user['User']['id']); ?></dd>

	<dt><?php echo __('Username'); ?></dt>
	<dd><?php echo h($user['User']['username']); ?></dd>

	<dt><?php echo __('Password'); ?></dt>
	<dd><?php echo h($user['User']['password']); ?></dd>

	<dt><?php echo __('Personal Details'); ?></dt>
	<dd><?php echo h($user['User']['personal_details']); ?></dd>

	<dt><?php echo __('Role'); ?></dt>
	<dd>\<?php echo $this->Html->link($user['Role']['title'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?><dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($user['User']['status']); ?></dd>

	<dt><?php echo __('Created'); ?></dt>
	<dd><?php echo h($user['User']['created']); ?></dd>

</dl>
