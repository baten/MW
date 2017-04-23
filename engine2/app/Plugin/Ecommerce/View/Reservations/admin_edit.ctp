<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Edit Reservation'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Reservations', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	echo $this->Form->create('Reservation',array('class'=>'form')); 
	
		echo $this->Form->input('id',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('name',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('email',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('phone',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('date',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('time',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('num_of_person',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('message',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('type',array('class'=>'form-control','div'=>array('class'=>'form-group')));

		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

	echo $this->Form->end(); 
?>	</div>
</div>
