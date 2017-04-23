<div class="row bar bar-primary bar-top">
	<div class="col-md-3">
		<h1 class="bar-title"><?php echo __('Purchases'); ?></h1>
	</div>
	<div class="col-md-9 text-right">
		<?php echo $this->Form->create('Purchase',array('class'=>'searchForm','data-role'=>'form')); ?>
		<?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
		<?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>

		<?php echo $this->Form->end(); ?>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-plus-sign\'></i> Add Purchases', array('action' => 'add','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
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
					<th><?php echo $this->Paginator->sort('unit_price'); ?></th>
					<th><?php echo $this->Paginator->sort('quantity'); ?></th>
					<th><?php echo $this->Paginator->sort('total'); ?></th>
					<th><?php echo $this->Paginator->sort('date'); ?></th>

					<th><?php echo $this->Paginator->sort('created'); ?></th>
					<th class="text-right action-th"><?php echo __('Actions'); ?></th>
				</tr>
				</thead>

				<tbody>
				<?php foreach ($purchases as $purchase): ?>
					<tr>
						<td><?php echo h($purchase['Purchase']['id']); ?>&nbsp;</td>
						<td>
							<?php echo $this->Html->link($purchase['Product']['title'], array('controller' => 'products', 'action' => 'view', $purchase['Product']['id'])); ?>
						</td>
						<td><?php echo h($purchase['Purchase']['unit_price']); ?>&nbsp;</td>
						<td><?php echo h($purchase['Purchase']['quantity']); ?>&nbsp;</td>
						<td><?php echo h($purchase['Purchase']['quantity']*$purchase['Purchase']['unit_price']); ?>&nbsp;</td>
						<td><?php echo h( date_format(date_create($purchase['Purchase']['purchase_date']), 'jS F Y')); ?>&nbsp;</td>
						<td><?php echo h($purchase['Purchase']['created']); ?>&nbsp;</td>
						<td class="text-right action">

							<?php if(!$purchase['Purchase']['stock']) { ?>

		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-open-link\'></i> Add To Stock', array('action' => 'admin_add_to_stock', $purchase['Purchase']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-info')); ?>

							<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-edit\'></i> Edit', array('action' => 'edit', $purchase['Purchase']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-warning')); ?>

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