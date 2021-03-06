<div class="row bar bar-primary bar-top">
	<div class="col-md-3">
		<h1 class="bar-title"><?php echo __('Coupons'); ?></h1>
	</div>
	<div class="col-md-9 text-right">
		<?php echo $this->Form->create('Coupon',array('class'=>'searchForm','data-role'=>'form')); ?>
		<?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
		<?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
		
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-plus-sign\'></i> Add Coupons', array('action' => 'add','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped" >
			<thead>
			<tr class="info">
							<th><?php echo $this->Paginator->sort('id'); ?></th>
							<th><?php echo $this->Paginator->sort('coupon_number'); ?></th>
							<th><?php echo $this->Paginator->sort('discount_type'); ?></th>
							<th><?php echo $this->Paginator->sort('discount_amount'); ?></th>
							<th><?php echo $this->Paginator->sort('is_validity'); ?></th>
							<th><?php echo $this->Paginator->sort('start_time'); ?></th>
							<th><?php echo $this->Paginator->sort('end_time'); ?></th>
							<th><?php echo $this->Paginator->sort('status'); ?></th>
							<th class="text-right action-th"><?php echo __('Actions'); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php 
				$i=1; foreach ($coupons as $coupon): 
				if($coupon['Coupon']['discount_type']=='Fixed'){$symbol='Tk';}else{$symbol='%';}
			?>
	<tr>
		<td><?php echo h($i); ?>&nbsp;</td>
		<td><?php echo h($coupon['Coupon']['coupon_number']); ?>&nbsp;</td>
		<td><?php echo h($coupon['Coupon']['discount_type']); ?>&nbsp;</td>
		<td><?php echo h($coupon['Coupon']['discount_amount'].$symbol); ?>&nbsp;</td>
		<td><?php echo h($validitY_options[$coupon['Coupon']['is_validity']]); ?>&nbsp;</td>
		<td><?php echo h(CakeTime::format('d M Y H:i',$coupon['Coupon']['start_time'])); ?>&nbsp;</td>
		<td><?php echo h(CakeTime::format('d M Y H:i',$coupon['Coupon']['end_time'])); ?>&nbsp;</td>
		<td><?php echo h($coupon['Coupon']['status']); ?>&nbsp;</td>
		<td class="text-right action">
			<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-edit\'></i> Edit', array('action' => 'edit', $coupon['Coupon']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-warning')); ?>
			<?php echo $this->Form->postLink('<i class=\'glyphicon glyphicon-remove-circle\'></i> Delete', array('action' => 'delete', $coupon['Coupon']['id'],'admin'=>true), array('escape'=>false,'class'=>'btn btn-danger'), __('Are you sure you want to delete?')); ?>
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