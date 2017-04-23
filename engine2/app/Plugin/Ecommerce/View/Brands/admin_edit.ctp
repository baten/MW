<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Edit Brand'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Brands', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	echo $this->Form->create('Brand',array('class'=>'form','type'=>'file')); 
		$data = $this->request->data;
		echo $this->Form->input('id');
		echo $this->Form->input('slug',array('type'=>'hidden'));
		echo $this->Form->input('title',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('meta_keys',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('meta_description',array('type'=>'textarea', 'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('description',array('type'=>'textarea','class'=>'form-control editor','div'=>array('class'=>'form-group')));
		echo $this->Form->input('logo',array('type'=>'file','required' => false,'div'=>array('class'=>'form-group')));
		if(file_exists(WWW_ROOT."img/site/product_brands/l-{$data['Brand']['id']}.{$data['Brand']['logo_extension']}")):
		echo $this->Html->image("/img/site/product_brands/l-{$data['Brand']['id']}.{$data['Brand']['logo_extension']}",array('class'=>'img img-reponsive upload-image-thumbnail'));
		endif;
		
		echo $this->Form->input('image',array('type'=>'file','required' => false, 'onchange'=>'catUploadThumb(this)','div'=>array('class'=>'form-group')));
		
		if(file_exists(WWW_ROOT."img/site/product_brands/{$data['Brand']['id']}.{$data['Brand']['image_extension']}")):
			echo $this->Html->image("/img/site/product_brands/{$data['Brand']['id']}.{$data['Brand']['image_extension']}",array('class'=>'img img-reponsive upload-image-thumbnail'));
		endif;
		echo $this->Form->input('is_featured',
			array('div' => true,
				'label' => false,
				'type' => 'checkbox',
				'before' => '<label class="checkbox">',
				'after' => 'Is Featured.</label>'
			));
		echo $this->Form->input('status',array('options' => $status, 'class'=>'form-control','div'=>array('class'=>'form-group')));

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
