<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Add DpexChannel'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List DpexChannels', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	echo $this->Form->create('DpexChannel',array('class'=>'form')); 
	
		echo $this->Form->input('country_id',array('class'=>'form-control','onchange'=>"getCity(this.value,'../../ecommerce/products/')" ,'empty'=>array(''=>'Please select..'), 'div'=>array('class'=>'form-group')));
		echo $this->Form->input('city_id',array('type'=>'select','class'=>'form-control append_option','div'=>array('class'=>'form-group')));
		//echo $this->Form->input('zip',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('weight',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('price',array('class'=>'form-control','div'=>array('class'=>'form-group')));

		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

	echo $this->Form->end(); 
?>	</div>
</div>
<?php echo $this->Html->script(array('Ecommerce.product'));?>