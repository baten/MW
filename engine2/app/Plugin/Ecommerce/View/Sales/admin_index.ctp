<div class="row bar bar-primary bar-top">
	<div class="col-md-3">
		<h1 class="bar-title"><?php echo $this->params['pass'][0]; ?></h1>
	</div>
	<div class="col-md-9 text-right">
		<?php echo $this->Form->create('Sale',array('class'=>'searchForm','data-role'=>'form')); ?>
		<?php echo $this->Form->input('dateFrom',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'From Date'));?>
		<?php echo $this->Form->input('dateTo',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'To Date'));?>
		<?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
		
		<?php echo $this->Form->end(); ?>
	</div>
</div>
 
<div class="row bar bar-third">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped" >
				<thead>
				<tr class="info">
					<th><?php echo $this->Paginator->sort('Date'); ?></th>
					<th><?php echo $this->Paginator->sort('quantity'); ?></th>
					<!-- <th class="text-right action-th"><?php echo __('Actions'); ?></th> -->
				</tr>
				</thead>
			
				<tbody>
				<?php //pr($sales);?>
				<?php foreach ($sales as $sale): ?>
				<tr>
					<td><?php echo h($sale['Sale']['created']); ?>&nbsp;</td>
					<td><?php echo h($sale['Sale']['quantity']); ?>&nbsp;</td>
					<!-- 
					<td class="text-right action">
						<?php echo $this->Form->postLink('<i class=\'glyphicon glyphicon-remove-circle\'></i> Delete', array('action' => 'delete', $sale['Sale']['id'],'admin'=>true), array('escape'=>false,'class'=>'btn btn-danger'), __('Are you sure you want to delete?')); ?>
					</td>
					 -->
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


<script type="text/javascript">
$( document ).ready(function() {
	$( '#SaleDateFrom,#SaleDateTo' ).datepicker({
		 changeMonth: true,
		 changeYear: true,
		 dateFormat: 'yy-mm-dd',
		 yearRange: '-70:+20',
	});
	});
</script>
