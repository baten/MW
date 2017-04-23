<div class="row bar bar-primary bar-top">
	<div class="col-md-3">
		<h1 class="bar-title"><?php echo __('Stocks'); ?></h1>
	</div>
	<div class="col-md-9 text-right">
		<?php echo $this->Form->create('ProductSale',array('class'=>'searchForm','data-role'=>'form')); ?>
		<?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
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
						<th><?php echo $this->Paginator->sort('product'); ?></th>
						<th><?php echo 'Sale Out'; ?></th>
						<th class="text-right action-th"><?php echo __('Actions'); ?></th>
					</tr>
				</thead>
				<tbody>
				<?php //pr($products)?>
				<?php foreach ($products as $product): ?>
				<tr>
					<td><?php echo h($product['Product']['title']); ?></td>
					<td>
						<?php
							$totalSale = 0;
							if(!empty($product['Sale'])){
								foreach ($product['Sale'] as $sale){
									$totalSale += $sale['quantity'];
								}
							}
							
							
							echo $totalSale;
						?>
					</td>
					<td class="text-right action">
						<?php if($totalSale > 0): echo $this->Html->link('View', array('controller'=>'sales','action' => 'index', $product['Product']['title'],$product['Product']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-warning')); endif;?>
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
