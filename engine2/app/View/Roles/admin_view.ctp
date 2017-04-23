<h1 class="page-title"><?php echo __('Role details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($role['Role']['id']); ?></dd>

	<dt><?php echo __('Title'); ?></dt>
	<dd><?php echo h($role['Role']['title']); ?></dd>

	<dt><?php echo __('Description'); ?></dt>
	<dd><?php echo h($role['Role']['description']); ?></dd>

	<dt><?php echo __('Permissions'); ?></dt>
	<dd><?php echo h($role['Role']['permissions']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($role['Role']['status']); ?></dd>

	<dt><?php echo __('Created'); ?></dt>
	<dd><?php echo h($role['Role']['created']); ?></dd>

</dl>
