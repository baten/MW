<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Edit Home Block'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Home Blocks', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	echo $this->Form->create('HomeBlock',array('class'=>'form','type'=>'file')); 
		echo $this->Form->input('image',array('onchange'=>'catUploadThumb(this)', 'type'=>'file', 'div'=>array('class'=>'form-group')));
		
		if(file_exists(WWW_ROOT."img/site/homeblock/{$this->request->data['HomeBlock']['id']}.{$this->request->data['HomeBlock']['image_extension']}")):
			echo $this->Html->image("/img/site/homeblock/{$this->request->data['HomeBlock']['id']}.{$this->request->data['HomeBlock']['image_extension']}");
		endif;
		
		echo $this->Form->input('id',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('title',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('url',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('status',array('class'=>'form-control','div'=>array('class'=>'form-group')));

		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

	echo $this->Form->end(); 
?>	</div>
</div>

<script>
function catUploadThumb(selector){
	var file = selector.files[0];
	if(file){
		 var reader = new FileReader();
		 var file_data = reader.readAsDataURL(file);
		 reader.onload = function(evt){
			 $('.upload-image-thumbnail').remove();
			$('<img class="img-responsive upload-image-thumbnail" src="'+evt.target.result+'">').insertAfter(selector)
		 }
	}
}

</script>

<style>
	.upload-image-thumbnail{
		margin-top : 10px;
	}
</style>
