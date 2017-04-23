<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Add Purchase'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Purchases', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	echo $this->Form->create('Purchase',array('class'=>'form')); 
	
		echo $this->Form->input('product_id',array('class'=>'','id'=>'productselect','div'=>array('class'=>'form-group')));
		echo $this->Form->input('unit_price',array('class'=>'form-control','type'=>'number','div'=>array('class'=>'form-group')));
		echo $this->Form->input('quantity',array('class'=>'form-control','type'=>'number','div'=>array('class'=>'form-group')));
	echo $this->Form->input('purchase_date',array('class'=>'form-control datepicker','type'=>'text','div'=>array('class'=>'form-group')));

		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

	echo $this->Form->end(); 
?>	</div>
</div>
