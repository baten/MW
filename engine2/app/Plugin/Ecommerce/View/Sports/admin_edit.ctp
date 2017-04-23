<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Edit Sport'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Sports', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	echo $this->Form->create('Sport',array('class'=>'form','type'=>'file')); 
		$data = $this->request->data;
		echo $this->Form->input('id',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('title',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('meta_keys',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('meta_description',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('description',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('logo',array('type'=>'file','required' => false,'div'=>array('class'=>'form-group')));
		if(file_exists(WWW_ROOT."img/site/sports/l-{$data['Sport']['id']}.{$data['Sport']['logo_extension']}")):
		echo $this->Html->image("/img/site/sports/l-{$data['Sport']['id']}.{$data['Sport']['logo_extension']}",array('class'=>'img img-reponsive upload-image-thumbnail'));
		endif;
		
		echo $this->Form->input('image',array('type'=>'file','required' => false, 'onchange'=>'catUploadThumb(this)','div'=>array('class'=>'form-group')));
		
		if(file_exists(WWW_ROOT."img/site/sports/{$data['Sport']['id']}.{$data['Sport']['image_extension']}")):
		echo $this->Html->image("/img/site/sports/{$data['Sport']['id']}.{$data['Sport']['image_extension']}",array('class'=>'img img-reponsive upload-image-thumbnail'));
		endif;
		echo $this->Form->input('status',array('options' => $status, 'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

	echo $this->Form->end(); 
?>	</div>
</div>
