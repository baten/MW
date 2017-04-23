<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Add Banner'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Banners', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	echo $this->Form->create('Banner',array('class'=>'form','type'=>'file')); 
	
		echo $this->Form->input('title',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('caption',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('image',array('type'=>'file','onchange'=>'catUploadThumb(this)',  'div'=>array('class'=>'form-group'),'required'=>true,'after' => '<spna class="guidance">Image Resulation : (width:1400px) X  (Height:530px)</span>'));
		echo $this->Form->input('status',array('options'=>$status, 'class'=>'form-control','div'=>array('class'=>'form-group')));
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
