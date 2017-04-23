<h1 class="page-title"><?php echo __('Web Page Detail details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($webPageDetail['WebPageDetail']['id']); ?></dd>

	<dt><?php echo __('Web Page'); ?></dt>
	<dd>\<?php echo $this->Html->link($webPageDetail['WebPage']['title'], array('controller' => 'web_pages', 'action' => 'view', $webPageDetail['WebPage']['id'])); ?><dd>

	<dt><?php echo __('Question'); ?></dt>
	<dd><?php echo h($webPageDetail['WebPageDetail']['question']); ?></dd>

	<dt><?php echo __('Answer'); ?></dt>
	<dd><?php echo h($webPageDetail['WebPageDetail']['answer']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($webPageDetail['WebPageDetail']['status']); ?></dd>

</dl>
