<h1 class="page-title"><?php echo __('Post details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($post['Post']['id']); ?></dd>

	<dt><?php echo __('Categories'); ?></dt>
	<dd><?php echo h($post['Post']['categories']); ?></dd>

	<dt><?php echo __('User'); ?></dt>
	<dd><?php echo h($post['Post']['user']); ?></dd>

	<dt><?php echo __('Title'); ?></dt>
	<dd><?php echo h($post['Post']['title']); ?></dd>

	<dt><?php echo __('Slug'); ?></dt>
	<dd><?php echo h($post['Post']['slug']); ?></dd>

	<dt><?php echo __('Meta Keys'); ?></dt>
	<dd><?php echo h($post['Post']['meta_keys']); ?></dd>

	<dt><?php echo __('Meta Description'); ?></dt>
	<dd><?php echo h($post['Post']['meta_description']); ?></dd>

	<dt><?php echo __('Description'); ?></dt>
	<dd><?php echo h($post['Post']['description']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($post['Post']['status']); ?></dd>

	<dt><?php echo __('Created'); ?></dt>
	<dd><?php echo h($post['Post']['created']); ?></dd>

	<dt><?php echo __('Modified'); ?></dt>
	<dd><?php echo h($post['Post']['modified']); ?></dd>

</dl>
