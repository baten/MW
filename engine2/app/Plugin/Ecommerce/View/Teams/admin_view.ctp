<h1 class="page-title"><?php echo __('Team details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($team['Team']['id']); ?></dd>

	<dt><?php echo __('Title'); ?></dt>
	<dd><?php echo h($team['Team']['title']); ?></dd>

	<dt><?php echo __('Slug'); ?></dt>
	<dd><?php echo h($team['Team']['slug']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($team['Team']['status']); ?></dd>

</dl>
