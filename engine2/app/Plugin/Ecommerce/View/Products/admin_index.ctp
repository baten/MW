<div class="row bar bar-primary bar-top">
	<div class="col-md-3">
		<h1 class="bar-title"><?php echo __('Products'); ?></h1>
	</div>
	<div class="col-md-9 text-right">
		<?php echo $this->Form->create('Product',array('url'=>array('action' => 'index'),'class'=>'searchForm','data-role'=>'form')); ?>
		<?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
		<?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
		
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-plus-sign\'></i> Add Products', array('action' => 'add','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-plus-sign\'></i> Excel Upload', array('action' => 'excelImport','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped" >
			<thead>
			<tr class="info">
				<th><?php echo h('Images'); ?></th>
				<th><?php echo $this->Paginator->sort('product_code','Code'); ?></th>
				<th><?php echo $this->Paginator->sort('sku','SKU'); ?></th>
				<th><?php echo $this->Paginator->sort('title'); ?></th>
				<th><?php echo $this->Paginator->sort('price'); ?></th>
				<th><?php echo $this->Paginator->sort('status'); ?></th>
				<th class="text-right action-th"><?php echo __('Actions'); ?></th>
			</tr>
			</thead>
			
			<tbody>
			<?php foreach ($products as $product):?>
				<tr>
					<td>
					<?php 
						if(!empty($product['ProductImage'])):
							if(file_exists("img/site/products/{$product['ProductImage'][0]['id']}.{$product['ProductImage'][0]['extension']}")): 
								echo $this->Html->image("site/products/{$product['ProductImage'][0]['id']}.{$product['ProductImage'][0]['extension']}",array('class'=>'img-responsive upload-image-thumbnail'));
							endif;
						endif;
						?>
					</td>
					<td><?php echo h($product['Product']['product_code']); ?></td>
					<td><?php echo $product['Product']['sku'];?></td>
					<td><?php echo h($product['Product']['title']); ?></td>			
					<td><?php echo h($product['Product']['price']); ?></td>
					<td><?php echo h($product['Product']['status']); ?></td>
					<td class="text-right action">
					<?php 
						echo $this->Html->link('<i class=\'fa fa-hdd-o\'></i> Stocks', array('controller' => 'product_stocks','action' => 'index', $product['Product']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-warning')); 
						//echo $this->Html->link('<i class=\'glyphicon glyphicon-edit\'></i> Product Settings', array('action' => 'product_settings', $product['Product']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-warning')); 
						echo $this->Html->link('<i class=\'glyphicon glyphicon-edit\'></i> Edit', array('action' => 'edit', $product['Product']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-warning')); 
						echo $this->Form->postLink('<i class=\'glyphicon glyphicon-remove-circle\'></i> Delete', array('action' => 'delete', $product['Product']['id'],'admin'=>true), array('escape'=>false,'class'=>'btn btn-danger'), __('Are you sure you want to delete?'));
						echo $this->Html->link('<i class=\'fa fa-compress\'></i> Generate', "javascript:void(0)",array('onclick'=>"generateCombination('".$product['Product']['id']."','y',this)",'escape'=>false,'class'=>'btn btn-info','data-url'=>Router::url(array('controller'=>'product_stocks','action'=>'add'))));
					?>
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
				?>
			</p>
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


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Generate Combination</h4>
      </div>
      <div class="modal-body">
        Please wait while generated combination.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



