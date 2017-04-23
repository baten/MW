<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Add Client'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Clients', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
		<?php
		echo $this->Form->create('Client',array('class'=>'form'));
		echo $this->Form->input('id');
		echo $this->Form->input('username',array('class'=>'form-control','div'=>array('class'=>'form-group')));

		echo $this->Form->input('details.fname',array("value"=>$details["fname"],'label'=>'First Name','class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('details.lname',array("value"=>$details["lname"],'label'=>'Last Name','class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('details.phone',array("value"=>$details["phone"],'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('details.state',array('label'=>'City',"value"=>$details["state"],'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('details.country',array("value"=>$details["country"],'options'=>$countrylist,'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('details.region',array('value'=>$details["region"],'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('details.poBox',array('value'=>$details["poBox"],'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('details.address_line_1',array("value"=>$details["address_line_1"],'class'=>'form-control','type'=> 'textarea','div'=>array('class'=>'form-group')));
		echo $this->Form->input('details.address_line_2',array("value"=>$details["address_line_2"],'class'=>'form-control','type'=> 'textarea','div'=>array('class'=>'form-group')));

		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

		echo $this->Form->end();
		?>	</div>
</div>
