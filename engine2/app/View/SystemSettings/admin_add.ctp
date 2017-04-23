<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Add System Setting'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List System Settings', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	echo $this->Form->create('SystemSetting',array('class'=>'form')); 
	
		echo $this->Form->input('domain',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('developer_email',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('system_author_name',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('developer_company',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('pagination_no',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('status',array('options'=>$site_status, 'class'=>'form-control','div'=>array('class'=>'form-group')));

		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

	echo $this->Form->end(); 
?>	</div>
</div>
