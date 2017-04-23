<h1 class="page-title"><?php echo __('Site Setting details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($siteSetting['SiteSetting']['id']); ?></dd>

	<dt><?php echo __('Site Title'); ?></dt>
	<dd><?php echo h($siteSetting['SiteSetting']['site_title']); ?></dd>

	<dt><?php echo __('Site Slogan'); ?></dt>
	<dd><?php echo h($siteSetting['SiteSetting']['site_slogan']); ?></dd>

	<dt><?php echo __('Meta Key'); ?></dt>
	<dd><?php echo h($siteSetting['SiteSetting']['meta_key']); ?></dd>

	<dt><?php echo __('Meta Description'); ?></dt>
	<dd><?php echo h($siteSetting['SiteSetting']['meta_description']); ?></dd>

	<dt><?php echo __('Site Author'); ?></dt>
	<dd><?php echo h($siteSetting['SiteSetting']['site_author']); ?></dd>

	<dt><?php echo __('Site Author Email'); ?></dt>
	<dd><?php echo h($siteSetting['SiteSetting']['site_author_email']); ?></dd>

	<dt><?php echo __('Company Name'); ?></dt>
	<dd><?php echo h($siteSetting['SiteSetting']['company_name']); ?></dd>

	<dt><?php echo __('Company Address'); ?></dt>
	<dd><?php echo h($siteSetting['SiteSetting']['company_address']); ?></dd>

	<dt><?php echo __('Company Loaction'); ?></dt>
	<dd><?php echo h($siteSetting['SiteSetting']['company_loaction']); ?></dd>

	<dt><?php echo __('Phones'); ?></dt>
	<dd><?php echo h($siteSetting['SiteSetting']['phones']); ?></dd>

	<dt><?php echo __('Emails'); ?></dt>
	<dd><?php echo h($siteSetting['SiteSetting']['emails']); ?></dd>

	<dt><?php echo __('Faxes'); ?></dt>
	<dd><?php echo h($siteSetting['SiteSetting']['faxes']); ?></dd>

</dl>
