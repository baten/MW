<div class="row bar bar-primary bar-top">
	<div class="col-md-3">
		<h1 class="bar-title"><?php echo __('Brands'); ?></h1>
	</div>
	<div class="col-md-9 text-right">
		<?php echo $this->Form->create('Brand',array('class'=>'searchForm','data-role'=>'form')); ?>
		<?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
		<?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
		
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-plus-sign\'></i> Add Brand', array('action' => 'add','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-th-list\'></i> Sort Brands', array('action' => 'sort','admin'=>true),array('escape'=>false,'class'=>'btn btn-info')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped" >
			<thead>
			<tr class="info">
				<th><?php echo h('Logo'); ?></th>
				<th><?php echo $this->Paginator->sort('title'); ?></th>
				<th><?php echo $this->Paginator->sort('description'); ?></th>
				<th><?php echo $this->Paginator->sort('order'); ?></th>
				<th><?php echo $this->Paginator->sort('status'); ?></th>
				<th class="text-right action-th"><?php echo __('Actions'); ?></th>
			</tr>
			</thead>
			
			<tbody>
			<?php foreach ($brands as $brand): ?>
				<tr>
					<td>
						<?php 
						
						$img_file = WWW_ROOT."img".DS."site".DS."product_brands".DS.'l-'.$brand['Brand']['id'].".".$brand['Brand']['logo_extension'];
						if(file_exists($img_file)){
							
							echo $this->Html->image("site".DS."product_brands".DS.'l-'.$brand['Brand']['id'].".".$brand['Brand']['logo_extension'],array('class'=>'img-responsive'));
						}
							
						?>
					</td>
					<td><?php echo h($brand['Brand']['title']); ?></td>
					<td>
						<?php echo CakeText::truncate("{$brand['Brand']['description']}",100,array('ellipsis' => '...','exact' => false,'html' => false));?>
					</td>
					<td><?php echo h($brand['Brand']['order']); ?></td>
					<td><?php echo h($status[$brand['Brand']['status']]); ?></td>
					<td class="text-right action">
						<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-edit\'></i> Edit', array('action' => 'edit', $brand['Brand']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-warning')); ?>
						<?php echo $this->Form->postLink('<i class=\'glyphicon glyphicon-remove-circle\'></i> Delete', array('action' => 'delete', $brand['Brand']['id'],'admin'=>true), array('escape'=>false,'class'=>'btn btn-danger'), __('Are you sure you want to delete?')); ?>
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