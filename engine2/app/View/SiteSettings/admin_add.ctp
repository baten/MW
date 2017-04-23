<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Add Site Setting'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Site Settings', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	echo $this->Form->create('SiteSetting',array('class'=>'form','type'=>'file')); 
	
		echo $this->Form->input('site_title',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('site_slogan',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('meta_key',array('type'=>'textarea', 'class'=>'form-control','div'=>array('class'=>'form-group'),'label'=>'Meta Keywords (Less than 60 character)'));
		echo $this->Form->input('meta_description',array('type'=>'textarea','label'=>'Meta Description (Less than 150 characters', 'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('site_author',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('site_author_email',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('company_name',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('company_address',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('company_loaction',array('label'=>'Location(latitude,longitude)', 'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('phones',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('emails',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('faxes',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		
	?>
		<label class="clearfix">Google Analytics Setup</label>
		<?php 
			echo $this->Form->input('SiteSetting.google_analytics_data.Key',array('class'=>'form-control','div'=>array('class'=>'form-group')));
			echo $this->Form->input('SiteSetting.google_analytics_data.Gmail',array('class'=>'form-control','div'=>array('class'=>'form-group')));
			echo $this->Form->input('SiteSetting.google_analytics_data.Password',array('type'=>'password', 'class'=>'form-control','div'=>array('class'=>'form-group')));
		?>
		
	<?php	
		
		echo $this->Form->input('status',array('options'=>$site_status, 'class'=>'form-control','div'=>array('class'=>'form-group')));

		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

	echo $this->Form->end(); 
?>	</div>
</div>
