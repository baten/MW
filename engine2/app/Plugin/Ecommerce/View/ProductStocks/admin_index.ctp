<div class="row bar bar-primary bar-top">
	<div class="col-md-6">
		<h1 class="bar-title"><?php echo $product['Product']['title']; ?></h1>
	</div>
	<div class="col-md-6 text-right">
		<?php echo $this->Form->create('ProductStock',array('class'=>'searchForm','data-role'=>'form')); ?>
		<?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
		<?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
		
		<?php echo $this->Form->end(); ?>
	</div>
</div>


<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-plus-sign\'></i> List Products', array('controller' => 'products','action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
		<?php echo $this->Html->link('<i class=\'fa fa-compress\'></i>Generate New Added', "javascript:void(0)",array('onclick'=>"generateCombination('".$this->params['pass'][0]."','',this)",'escape'=>false,'class'=>'btn btn-info','data-url'=>Router::url(array('action'=>'add')))); ?>
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-plus-sign\'></i> Export (excel)', array('controller' => 'product_stocks','action' => 'export',$product['Product']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-plus-sign\'></i> Import (excel)', array('controller' => 'product_stocks','action' => 'import',$product['Product']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped" >
				<thead>
					<tr class="info">
						<th><?php echo $this->Paginator->sort('attributeValues'); ?></th>
						<th><?php echo $this->Paginator->sort('stock'); ?></th>
						<th><?php echo $this->Paginator->sort('sold'); ?></th>
						<?php if(!empty($detaultStock)):
							if($detaultStock['ProductStock']['quantity'] > 0):
					?>
						<th>&nbsp;</th>
						<?php endif;endif;?>
						<th class="text-right action-th"><?php echo __('Actions'); ?></th>
					</tr>
				</thead>
			
				<tbody>
			<?php 
				$attributeValue = '';
				foreach ($productStocks as $stock):
				$attributeValue = '';
				if(isset($stock['ProductStock']['attributeValues'])):
					$attributeValue = explode('|', $stock['ProductStock']['attributeValues']);
				endif;
			?>
				<tr>
					<td class="attr-values">
					<?php 
					if(!empty($attributeValue)):
						foreach($attributeValue as $value):
							if(isset($attributeValues[$value])): echo '<span>'.$attributeValues[$value].' </span>'; endif;
						endforeach;
					endif;
					?>
					</td>
					<?php 
					$stockClass = 'stock';
					if(empty($stock['ProductStock']['attributeValues'])):
						$stockClass = 'opening-stock';
					endif;
					?>
					<td class="<?php echo $stockClass;?>"><?php echo h($stock['ProductStock']['quantity']); ?></td>
					<td><?php echo h($stock['ProductStock']['sold']); ?>&nbsp;</td>
					<?php if(!empty($detaultStock)):
							if($detaultStock['ProductStock']['quantity'] > 0):
					?>
					<td class="quantity"> 
						<?php if(!empty($stock['ProductStock']['attributeValues'])):?>
                                <div class="item">
                                    Double click to merge opening stock 
                                </div>
                                <div class="quantity-form hide">
                                    <input type="text" class="quantity-item"
                                           data-id="<?php echo $stock['ProductStock']['id']; ?>"
                                           data-productid="<?php echo $stock['ProductStock']['product_id']; ?>"
                                           value="0"/>
                                </div>
                        <?php endif;?>
                       
					</td>
					<?php endif;endif;?>
					<td class="text-right action">
						<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-edit\'></i> Edit', array('action' => 'edit', $stock['ProductStock']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-warning')); ?>
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


<script type="text/javascript">
    $(".quantity .item").dblclick(function () {
        $(this).addClass('hide');
        $(this).parents('.quantity').find('.quantity-form').removeClass('hide');
    });

    $(".quantity-item").change(function () {
        var quantity = parseInt($(this).val());
        var stockId = $(this).data('id');
        var prodId = $(this).data('productid');
        var quantitySelector = $(this).parents('tr').find('td.quantity .item');
        var stock =  $(this).parents('tr').find('td.stock');
        var previousStock = parseInt(stock.html());
        var openingQuantity = parseInt($('.opening-stock').html());
        
        if(quantity > openingQuantity){
            var message = 'Youn can add ' + openingQuantity;
            if(openingQuantity < 1){
            	message = 'Youn can not add any more';
            } 
            alert(message);
        }else{
        	  //admin_update_shipping
        	  var confirmmessage = confirm("Are you sure want to add?");
        	  if(confirmmessage){
        		  $.ajax({
                      method: 'POST',
                      url: '../update_stockQuantity',
                      data: {
                          id: stockId,
                          productId : prodId,
                          totalQuantity: quantity,
                          currentStock : previousStock
                      },
                      cache: false,
                      headers: {'content-type': 'application/x-www-form-urlencoded'}

                  }).success(function (data) {
                      if (data) {
                      	stock.text(previousStock + quantity);
                      	$('.opening-stock').text(openingQuantity - quantity);
                      	quantitySelector.text(' Double click to merge opening stock ');
                      }
                  });

                 
        	  }
        	  $(this).parents('.quantity-form').addClass('hide');
              $(this).parents('.quantity').find('.item').removeClass('hide'); 
        }


    });
</script>
<style>
.attr-values span:after{
	content:" | ";
}

.attr-values span:last-child:after{
	content:"";
}
</style>