<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Edit User'); ?></h1>
	</div>
</div>
<?php if($param==1){$action='clientIndex';}else{$action='index';}?>
<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Users', array('action' => $action,'admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	echo $this->Form->create('User',array('class'=>'form','type'=>'file')); 
		echo $this->Form->input('id',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		if($param!=1):
		echo "<div class='row'>";
		
		echo"<div class='col-md-6'>";
		
		echo $this->Form->input('User.personal_details.first_name',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('User.personal_details.last_name',array('class'=>'form-control','div'=>array('class'=>'form-group')));
	?>
		<div class="clearfix">
			<span >
				<?php echo $this->Form->input('User.personal_details.photo',array('type'=>'file','onchange'=>'processAvatarPreview(this,".avater-preview")', 'div'=>array('class'=>'form-group')));?>
			</span>
			<span class="avater-preview">
				<?php 
					$img_file = WWW_ROOT."img".DS."site".DS."avatars".DS.$this->request->data['User']['id'].".png";
					if(file_exists($img_file)){
						echo $this->Html->image("/img/site/avatars/{$this->request->data['User']['id']}.png",array('class'=>'img-responsive'));
					}
				?>
			</span>
		</div>
		
	<?php 
		echo $this->Form->input('User.personal_details.date_of_birth',array('class'=>'form-control datepicker','div'=>array('class'=>'form-group')));
		echo $this->Form->input('User.personal_details.blood_group',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('User.personal_details.gender',array('class'=>'form-control','options'=>array('male'=>'Male','female'=>'Female','other'=>'Other'), 'div'=>array('class'=>'form-group')));
		echo $this->Form->input('User.personal_details.maritial_status',array('class'=>'form-control','options'=>array('single'=>'Single','married'=>'Married','other'=>'Other'), 'div'=>array('class'=>'form-group')));
		
		
		
		echo "</div>";
			echo "<div class='col-md-6'>";
				echo $this->Form->input('User.personal_details.current_address.address_line_1',array('type'=>'textarea', 'class'=>'form-control','div'=>array('class'=>'form-group')));
				echo $this->Form->input('User.personal_details.current_address.address_line_2',array('type'=>'textarea', 'class'=>'form-control','div'=>array('class'=>'form-group')));
				echo $this->Form->input('User.personal_details.cell',array('class'=>'form-control','div'=>array('class'=>'form-group')));
				echo $this->Form->input('User.personal_details.fax',array('class'=>'form-control','div'=>array('class'=>'form-group')));
				echo $this->Form->input('User.personal_details.skype',array('class'=>'form-control','div'=>array('class'=>'form-group')));
			echo "</div>";
		echo "</div>";
		
		
		
		
		echo "<div class='row'><div class='col-md-12'>";
		echo $this->Form->label('System Info');
		echo $this->Form->input('username',array('type'=>'text','class'=>'form-control','div'=>array('class'=>'form-group')));
		//echo $this->Form->input('password',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('role_id',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		endif;
		echo $this->Form->input('status',array('options'=>$status, 'class'=>'form-control','div'=>array('class'=>'form-group')));

		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));
		echo "</div></div>";

	echo $this->Form->end(); 
?>	</div>
</div>
