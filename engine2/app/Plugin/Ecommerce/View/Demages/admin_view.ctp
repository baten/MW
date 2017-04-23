<h1 class="page-title"><?php echo __('Demage details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($demage['Demage']['id']); ?></dd>

	<dt><?php echo __('Product'); ?></dt>
	<dd>\<?php echo $this->Html->link($demage['Product']['title'], array('controller' => 'products', 'action' => 'view', $demage['Product']['id'])); ?><dd>

	<dt><?php echo __('Returnable'); ?></dt>
	<dd><?php echo h($demage['Demage']['returnable']); ?></dd>

	<dt><?php echo __('Recovered'); ?></dt>
	<dd><?php echo h($demage['Demage']['recovered']); ?></dd>

	<dt><?php echo __('Recovery Date'); ?></dt>
	<dd><?php echo h($demage['Demage']['recovery_date']); ?></dd>

	<dt><?php echo __('Date'); ?></dt>
	<dd><?php echo h($demage['Demage']['date']); ?></dd>

	<dt><?php echo __('Createdby'); ?></dt>
	<dd><?php echo h($demage['Demage']['createdby']); ?></dd>

	<dt><?php echo __('Updatedby'); ?></dt>
	<dd><?php echo h($demage['Demage']['updatedby']); ?></dd>

</dl>
