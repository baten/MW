<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Add Demage'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Demages', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	echo $this->Form->create('Demage',array('class'=>'form')); 
	
		echo $this->Form->input('product_id',array('class'=>'',"id"=>"productselect",'div'=>array('class'=>'form-group')));
	echo $this->Form->input('quantity',array('type'=>'number','class'=>'form-control form-group ','div'=>array('class'=>'form-group')));

		echo $this->Form->input('returnable',array('class'=>''));
		echo $this->Form->input('date',array('type'=>'text','class'=>'form-control form-group datepicker','div'=>array('class'=>'form-group')));
		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

	echo $this->Form->end(); 
?>	</div>
</div>