<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Edit Stock'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Stocks', array('action' => 'index',$this->data['ProductStock']['product_id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>
 
<div class="row bar bar-third">
	<div class="col-md-12">
	<?php if(!empty($arrayData)):
			foreach ($arrayData as $key => $value):
	?>
	<div class="form-group required">
		<span><strong><?php echo $key;?> : </strong></span><span><?php echo $value;?></span>
	</div>
	<?php 
		endforeach;
	endif;
	//pr($attrValues);
	
	echo $this->Form->create('ProductStock',array('class'=>'form')); 
	
		echo $this->Form->input('id',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('product_id',array('type' => 'hidden','class'=>'form-control','div'=>array('class'=>'form-group')));
		?>
		
		<div class="form-group required">
			<label for="StockQuantity">Current Stocks</label>
			<input name="data[ProductStock][currentQuantity]" class="form-control" value="<?php echo $this->data['ProductStock']['quantity'] ;?>" id="currentQuantity" type="number" readonly="readonly">
		</div>
		
		<?php 
		echo $this->Form->input('quantity',array('class'=>'form-control','value'=>'','div'=>array('class'=>'form-group')));
	
		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

	echo $this->Form->end(); 
?>	</div>
</div>
