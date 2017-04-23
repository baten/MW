<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Change Password'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php // echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Users', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	echo $this->Form->create('User',array('class'=>'form','type'=>'file')); 
	
		
		echo $this->Form->input('username',array('type'=>'text','readonly'=>true, 'value'=>$auth_user['username'], 'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('current_password',array('type'=>'password', 'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('new_password',array('type'=>'password','class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('retype_new_password',array('type'=>'password','class'=>'form-control','div'=>array('class'=>'form-group')));
		
		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));
		
	echo $this->Form->end(); 
?>	</div>
</div>
