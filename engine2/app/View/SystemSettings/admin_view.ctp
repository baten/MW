<h1 class="page-title"><?php echo __('System Setting details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($systemSetting['SystemSetting']['id']); ?></dd>

	<dt><?php echo __('Domain'); ?></dt>
	<dd><?php echo h($systemSetting['SystemSetting']['domain']); ?></dd>

	<dt><?php echo __('Developer Email'); ?></dt>
	<dd><?php echo h($systemSetting['SystemSetting']['developer_email']); ?></dd>

	<dt><?php echo __('System Author Name'); ?></dt>
	<dd><?php echo h($systemSetting['SystemSetting']['system_author_name']); ?></dd>

	<dt><?php echo __('Developer Company'); ?></dt>
	<dd><?php echo h($systemSetting['SystemSetting']['developer_company']); ?></dd>

	<dt><?php echo __('Pagination No'); ?></dt>
	<dd><?php echo h($systemSetting['SystemSetting']['pagination_no']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($systemSetting['SystemSetting']['status']); ?></dd>

</dl>
