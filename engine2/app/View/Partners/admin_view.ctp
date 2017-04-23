<h1 class="page-title"><?php echo __('Partner details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($partner['Partner']['id']); ?></dd>

	<dt><?php echo __('Name'); ?></dt>
	<dd><?php echo h($partner['Partner']['name']); ?></dd>

	<dt><?php echo __('Email'); ?></dt>
	<dd><?php echo h($partner['Partner']['email']); ?></dd>

	<dt><?php echo __('Phone'); ?></dt>
	<dd><?php echo h($partner['Partner']['phone']); ?></dd>

	<dt><?php echo __('Address'); ?></dt>
	<dd><?php echo h($partner['Partner']['address']); ?></dd>

	<dt><?php echo __('Image Extension'); ?></dt>
	<dd><?php echo h($partner['Partner']['image_extension']); ?></dd>

</dl>
