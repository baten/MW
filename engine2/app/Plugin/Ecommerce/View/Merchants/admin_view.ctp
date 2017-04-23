<h1 class="page-title"><?php echo __('Merchant details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($merchant['Merchant']['id']); ?></dd>

	<dt><?php echo __('FullName'); ?></dt>
	<dd><?php echo h($merchant['Merchant']['fullName']); ?></dd>

	<dt><?php echo __('Phone'); ?></dt>
	<dd><?php echo h($merchant['Merchant']['phone']); ?></dd>

	<dt><?php echo __('Email'); ?></dt>
	<dd><?php echo h($merchant['Merchant']['email']); ?></dd>

	<dt><?php echo __('Address'); ?></dt>
	<dd><?php echo h($merchant['Merchant']['address']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($merchant['Merchant']['status']); ?></dd>

	<dt><?php echo __('Created'); ?></dt>
	<dd><?php echo h($merchant['Merchant']['created']); ?></dd>

	<dt><?php echo __('Image Extension'); ?></dt>
	<dd><?php echo h($merchant['Merchant']['image_extension']); ?></dd>

</dl>
