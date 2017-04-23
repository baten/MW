<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Edit Social Network'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Social Networks', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	echo $this->Form->create('SocialNetwork',array('class'=>'form','type'=>'file')); 
	
		echo $this->Form->input('id',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('title',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('short_description',array('type'=>'textarea','class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('url',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('status',array('options'=>$status,'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('iconClass',array('label' => 'Icon Class','class'=>'form-control','div'=>array('class'=>'form-group')));
		?>
		<!-- 
		<div class="clearfix">
			<span >
				<?php //echo $this->Form->input('icon',array('type'=>'file','onchange'=>'processAvatarPreview(this,".avater-preview")', 'div'=>array('class'=>'form-group')));?>
			</span>
			<span class="avater-preview">
				<?php 
					//$img_file = WWW_ROOT."img".DS."site".DS."social_icons".DS.$this->request->data['SocialNetwork']['id'].".png";
					//if(file_exists($img_file)){
						//echo $this->Html->image("site/social_icons/{$this->request->data['SocialNetwork']['id']}.png",array('class'=>'img-responsive'));
					//}
				?>
			</span>
		</div>
		-->
	<?php 
		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

	echo $this->Form->end(); 
?>	</div>
</div>
