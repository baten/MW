<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Edit Category'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Categories', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	echo $this->Form->create('BlogCategory',array('class'=>'form')); 
		//pr();
		echo $this->Form->input('id',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('parent_id',array('options'=>$parentCategories, 'empty'=>'Select ...', 'value'=>$this->request->data['BlogCategory']['parent_id'], 'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('title',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		//echo $this->Form->input('slug',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('meta_keys',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('meta_description',array('type'=>'textarea', 'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('description',array('class'=>'form-control editor','div'=>array('class'=>'form-group')));
		echo $this->Form->input('status',array('options'=>$status, 'class'=>'form-control','div'=>array('class'=>'form-group')));

		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

	echo $this->Form->end(); 
?>	</div>
</div>
