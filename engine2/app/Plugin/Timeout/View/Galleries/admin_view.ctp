<h1 class="page-title"><?php echo __('Gallery details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($gallery['Gallery']['id']); ?></dd>

	<dt><?php echo __('Title'); ?></dt>
	<dd><?php echo h($gallery['Gallery']['title']); ?></dd>

	<dt><?php echo __('Caption'); ?></dt>
	<dd><?php echo h($gallery['Gallery']['caption']); ?></dd>

	<dt><?php echo __('Details'); ?></dt>
	<dd><?php echo h($gallery['Gallery']['details']); ?></dd>

	<dt><?php echo __('Url'); ?></dt>
	<dd><?php echo h($gallery['Gallery']['url']); ?></dd>

	<dt><?php echo __('Image Extension'); ?></dt>
	<dd><?php echo h($gallery['Gallery']['image_extension']); ?></dd>

	<dt><?php echo __('Order'); ?></dt>
	<dd><?php echo h($gallery['Gallery']['order']); ?></dd>

</dl>
