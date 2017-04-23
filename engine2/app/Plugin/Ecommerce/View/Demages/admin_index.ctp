<div class="row bar bar-primary bar-top">
	<div class="col-md-3">
		<h1 class="bar-title"><?php echo __('Demages'); ?></h1>
	</div>
	<div class="col-md-9 text-right">
		<?php echo $this->Form->create('Demage',array('class'=>'searchForm','data-role'=>'form')); ?>
		<?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
		<?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
		
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-plus-sign\'></i> Add Demages', array('action' => 'add','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped" >
			<thead>
			<tr class="info">
							<th><?php echo $this->Paginator->sort('id'); ?></th>
							<th><?php echo $this->Paginator->sort('product_id'); ?></th>
							<th><?php echo $this->Paginator->sort('quantity'); ?></th>
							<th><?php echo $this->Paginator->sort('returnable'); ?></th>
							<th><?php echo $this->Paginator->sort('recovered'); ?></th>
							<th><?php echo $this->Paginator->sort('recovery_date'); ?></th>
							<th><?php echo $this->Paginator->sort('date'); ?></th>
							<th><?php echo $this->Paginator->sort('createdby'); ?></th>
							<th><?php echo $this->Paginator->sort('updatedby'); ?></th>
							<th class="text-right action-th"><?php echo __('Actions'); ?></th>
			</tr>
			</thead>
			
			<tbody>
			<?php foreach ($demages as $demage): ?>
	<tr>
		<td><?php echo h($demage['Demage']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($demage['Product']['title'], array('controller' => 'products', 'action' => 'view', $demage['Product']['id'])); ?>
		</td>
		<td><?php echo h($demage['Demage']['quantity']); ?>&nbsp;</td>
		<td><?php echo h($demage['Demage']['returnable']); ?>&nbsp;</td>
		<td><?php echo h($demage['Demage']['recovered']); ?>&nbsp;</td>
		<td><?php echo h($demage['Demage']['recovery_date']); ?>&nbsp;</td>
		<td><?php echo h($demage['Demage']['date']); ?>&nbsp;</td>
		<td><?php echo h($demage['Demage']['createdby']); ?>&nbsp;</td>
		<td><?php echo h($demage['Demage']['updatedby']); ?>&nbsp;</td>
		<td class="text-right action">

			<?php if($demage['Demage']['returnable'] && !$demage['Demage']['recovered']) {?>
				<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-chevron-up\'></i> Recover', array('action' => 'recover', $demage['Demage']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-info')); ?>

			<?php } ?>
		</td>
	</tr>
<?php endforeach; ?>
			</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="pagination-block">
			<p>
			<?php
			echo $this->Paginator->counter(array(
			'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
			));
			?>			</p>
			<div class="pagination">
			<?php
		echo $this->Paginator->prev('< ' . __('previous'),array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));
		echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','currentTag'=>'a', 'currentClass'=>'current disabled'));
		echo $this->Paginator->next(__('next') . ' >', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));
	?>
			</div>
		</div>	
	</div>
</div>	