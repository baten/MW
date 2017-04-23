<h1 class="page-title"><?php echo __('Dimensional Weight details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($dimensionalWeight['DimensionalWeight']['id']); ?></dd>

	<dt><?php echo __('PackageName'); ?></dt>
	<dd><?php echo h($dimensionalWeight['DimensionalWeight']['packageName']); ?></dd>

	<dt><?php echo __('Measurement'); ?></dt>
	<dd><?php echo h($dimensionalWeight['DimensionalWeight']['measurement']); ?></dd>

	<dt><?php echo __('DimensionWeight'); ?></dt>
	<dd><?php echo h($dimensionalWeight['DimensionalWeight']['dimensionWeight']); ?></dd>

	<dt><?php echo __('ActualWeight'); ?></dt>
	<dd><?php echo h($dimensionalWeight['DimensionalWeight']['actualWeight']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($dimensionalWeight['DimensionalWeight']['status']); ?></dd>

</dl>
