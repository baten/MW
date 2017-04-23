<h1 class="page-title"><?php echo __('Lookbook details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($lookbook['Lookbook']['id']); ?></dd>

	<dt><?php echo __('Title'); ?></dt>
	<dd><?php echo h($lookbook['Lookbook']['title']); ?></dd>

	<dt><?php echo __('Caption'); ?></dt>
	<dd><?php echo h($lookbook['Lookbook']['caption']); ?></dd>

	<dt><?php echo __('Details'); ?></dt>
	<dd><?php echo h($lookbook['Lookbook']['details']); ?></dd>

	<dt><?php echo __('Url'); ?></dt>
	<dd><?php echo h($lookbook['Lookbook']['url']); ?></dd>

	<dt><?php echo __('Order'); ?></dt>
	<dd><?php echo h($lookbook['Lookbook']['order']); ?></dd>

</dl>
