<div class="row bar bar-primary bar-top">
	<div class="col-md-3">
		<h1 class="bar-title"><?php echo __('Reservations'); ?></h1>
	</div>
	<div class="col-md-9 text-right">
		<?php echo $this->Form->create('Reservation',array('class'=>'searchForm','data-role'=>'form')); ?>
		<?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
		<?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
		
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<!-- <div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php //echo $this->Html->link('<i class=\'glyphicon glyphicon-plus-sign\'></i> Add Reservations', array('action' => 'add','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div> -->

<div class="row bar bar-third">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped" >
			<thead>
			<tr class="info">
							<th><?php echo $this->Paginator->sort('id'); ?></th>
							<th><?php echo $this->Paginator->sort('name'); ?></th>
							<th><?php echo $this->Paginator->sort('email'); ?></th>
							<th><?php echo $this->Paginator->sort('phone'); ?></th>
							<th><?php echo $this->Paginator->sort('date'); ?></th>
							<th><?php echo $this->Paginator->sort('time'); ?></th>
							<th><?php echo $this->Paginator->sort('num_of_person'); ?></th>
							<th><?php echo $this->Paginator->sort('message'); ?></th>
							<th><?php echo $this->Paginator->sort('type'); ?></th>
							<th><?php echo $this->Paginator->sort('status'); ?></th>
							<th class="text-right action-th"><?php echo __('Actions'); ?></th>
			</tr>
			</thead>
			
			<tbody>
			<?php $i=1; foreach ($reservations as $reservation): ?>
	<tr>
		<td><?php echo $i; ?>&nbsp;</td>
		<td><?php echo h($reservation['Reservation']['name']); ?>&nbsp;</td>
		<td><?php echo h($reservation['Reservation']['email']); ?>&nbsp;</td>
		<td><?php echo h($reservation['Reservation']['phone']); ?>&nbsp;</td>
		<td><?php echo h(date_format(date_create($reservation['Reservation']['date']),'d-m-Y')); ?>&nbsp;</td>
		<td><?php echo h($reservation['Reservation']['time']); ?>&nbsp;</td>
		<td><?php echo h($reservation['Reservation']['num_of_person']); ?>&nbsp;</td>
		<td><?php echo h($reservation['Reservation']['message']); ?>&nbsp;</td>
		<td><?php echo h($reservation['Reservation']['type']); ?>&nbsp;</td>
		<td><?php echo h($reservation['Reservation']['status']); ?>&nbsp;</td>
		<td class="text-right action">		
			<?php echo $this->Form->postLink('<i class=\'glyphicon glyphicon-check\'></i> Accept', array('action' => 'accept', $reservation['Reservation']['id'],'admin'=>true), array('escape'=>false,'class'=>'btn btn-success'), __('Are you sure you want to accept?')); ?>
			<?php echo $this->Form->postLink('<i class=\'glyphicon glyphicon-remove-circle\'></i> Reject', array('action' => 'reject', $reservation['Reservation']['id'],'admin'=>true), array('escape'=>false,'class'=>'btn btn-warning'), __('Are you sure you want to reject?')); ?>
			<?php echo $this->Form->postLink('<i class=\'glyphicon glyphicon-remove-circle\'></i> Delete', array('action' => 'delete', $reservation['Reservation']['id'],'admin'=>true), array('escape'=>false,'class'=>'btn btn-danger'), __('Are you sure you want to delete?')); ?>
		</td>
	</tr>
<?php $i++; endforeach; ?>
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