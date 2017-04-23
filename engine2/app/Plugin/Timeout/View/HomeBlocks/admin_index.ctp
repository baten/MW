<div class="row bar bar-primary bar-top">
	<div class="col-md-3">
		<h1 class="bar-title"><?php echo __('Home Blocks'); ?></h1>
	</div>
	<div class="col-md-9 text-right">
		<?php echo $this->Form->create('HomeBlock',array('class'=>'searchForm','data-role'=>'form')); ?>
		<?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
		<?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
		
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-plus-sign\'></i> Add Home Blocks', array('action' => 'add','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped" >
			<thead>
				<tr class="info">
					<th><?php echo h('image'); ?></th>
					<th><?php echo $this->Paginator->sort('title'); ?></th>
					<th><?php echo $this->Paginator->sort('url'); ?></th>
					<th><?php echo $this->Paginator->sort('status'); ?></th>
					<th class="text-right action-th"><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			
			<tbody>
			<?php foreach ($homeBlocks as $homeBlock): ?>
				<tr>
					<td>
						<?php 
							if(file_exists(WWW_ROOT."img/site/homeblock/{$homeBlock['HomeBlock']['id']}.{$homeBlock['HomeBlock']['image_extension']}")):
								echo $this->Html->image("/img/site/homeblock/{$homeBlock['HomeBlock']['id']}.{$homeBlock['HomeBlock']['image_extension']}");
							endif;
						?>
					</td>
					<td><?php echo h($homeBlock['HomeBlock']['title']); ?></td>
					<td><?php echo h($homeBlock['HomeBlock']['url']); ?></td>
					<td><?php echo h($status[$homeBlock['HomeBlock']['status']]); ?></td>
					<td class="text-right action">
						<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-edit\'></i> Edit', array('action' => 'edit', $homeBlock['HomeBlock']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-warning')); ?>
						<?php echo $this->Form->postLink('<i class=\'glyphicon glyphicon-remove-circle\'></i> Delete', array('action' => 'delete', $homeBlock['HomeBlock']['id'],'admin'=>true), array('escape'=>false,'class'=>'btn btn-danger'), __('Are you sure you want to delete?')); ?>
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