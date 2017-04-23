<h1 class="page-title"><?php echo __('Social Network details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($socialNetwork['SocialNetwork']['id']); ?></dd>

	<dt><?php echo __('Title'); ?></dt>
	<dd><?php echo h($socialNetwork['SocialNetwork']['title']); ?></dd>

	<dt><?php echo __('Slug'); ?></dt>
	<dd><?php echo h($socialNetwork['SocialNetwork']['slug']); ?></dd>

	<dt><?php echo __('Short Description'); ?></dt>
	<dd><?php echo h($socialNetwork['SocialNetwork']['short_description']); ?></dd>

	<dt><?php echo __('Url'); ?></dt>
	<dd><?php echo h($socialNetwork['SocialNetwork']['url']); ?></dd>

	<dt><?php echo __('Order'); ?></dt>
	<dd><?php echo h($socialNetwork['SocialNetwork']['order']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($socialNetwork['SocialNetwork']['status']); ?></dd>

	<dt><?php echo __('Created'); ?></dt>
	<dd><?php echo h($socialNetwork['SocialNetwork']['created']); ?></dd>

	<dt><?php echo __('Modified'); ?></dt>
	<dd><?php echo h($socialNetwork['SocialNetwork']['modified']); ?></dd>

</dl>
