<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Edit Post'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Posts', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
		echo $this->Form->create('Post',array('class'=>'form')); 
	?>
	
	<?php 
	echo $this->Form->create('Post',array('class'=>'form')); 
		$selected_cats = json_decode($this->data['Post']['categories']);
	?>
		<label>Blog Categories</label> 
		<ul class="list blog-category-list">
		<?php foreach ($categories as $cat_key => $cat_val): 
			$is_selected = '';
			if(in_array($cat_key,$selected_cats) != false):
				$is_selected = 'checked';
			endif;
		?>
			<li>
				<div class="form-group">
					<input type="checkbox" name = "data[Post][categories][]" <?php echo $is_selected;?> value ="<?php echo $cat_key?>"> <?php echo $cat_val?>
				</div>
			</li>
		<?php endforeach;?>
		</ul>
		<?php
		echo $this->Form->input('id',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('title',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('meta_keys',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('meta_description',array('type'=> 'textarea', 'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('description',array('class'=>'form-control editor','div'=>array('class'=>'form-group')));
		echo $this->Form->input('status',array('options'=>$status, 'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

	echo $this->Form->end(); 
?>	</div>
</div>
