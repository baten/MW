<h1 class="page-title"><?php echo __('Comment details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($comment['Comment']['id']); ?></dd>

	<dt><?php echo __('User'); ?></dt>
	<dd><?php echo h($comment['Comment']['user']); ?></dd>

	<dt><?php echo __('Blog.post'); ?></dt>
	<dd>\<?php echo $this->Html->link($comment['Blog.Post']['title'], array('controller' => 'posts', 'action' => 'view', $comment['Blog.Post']['id'])); ?><dd>

	<dt><?php echo __('Comment'); ?></dt>
	<dd><?php echo h($comment['Comment']['comment']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($comment['Comment']['status']); ?></dd>

	<dt><?php echo __('Created'); ?></dt>
	<dd><?php echo h($comment['Comment']['created']); ?></dd>

	<dt><?php echo __('Modified'); ?></dt>
	<dd><?php echo h($comment['Comment']['modified']); ?></dd>

</dl>
