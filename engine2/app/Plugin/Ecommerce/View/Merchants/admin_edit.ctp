<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Edit Merchant'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Merchants', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	$data = $this->request->data;
	echo $this->Form->create('Merchant',array('class'=>'form','type'=>'file')); 
	
		echo $this->Form->input('id',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('fullName',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('phone',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('email',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('address',array('type'=>'textarea','class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('status',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('image',array('type'=>'file','required' => false, 'onchange'=>'catUploadThumb(this)','div'=>array('class'=>'form-group')));
		if(file_exists(WWW_ROOT ."img/site/merchants/{$data['Merchant']['id']}.png")):
			echo $this->Html->image("/img/site/merchants/{$data['Merchant']['id']}.png",array('class'=>'img img-responsive upload-image-thumbnail'));
		endif;

		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

	echo $this->Form->end(); 
?>	</div>
</div>

<script>
    function catUploadThumb(selector) {
        var file = selector.files[0];
        if (file) {
            var reader = new FileReader();
            var file_data = reader.readAsDataURL(file);
            reader.onload = function (evt) {
                $('.upload-image-thumbnail').remove();
                $('<img class="img-responsive upload-image-thumbnail" src="' + evt.target.result + '">').insertAfter(selector)
            }
        }
    }

</script>

<style>
    .upload-image-thumbnail {
        margin-top: 10px;
    }
</style>
