<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Add Role'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Roles', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>
<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	echo $this->Form->create('Role',array('class'=>'form')); 
	
		echo $this->Form->input('title',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('description',array('type'=>'textarea', 'class'=>'form-control','div'=>array('class'=>'form-group')));
		//echo $this->Form->input('accesslist',array('type'=>'textarea', 'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->label('Permission');
		foreach($acl_array as $m_key => $module):
		
			echo "<div class='role-controller-title'>".strtoupper($m_key)."</div>";
		
			echo "<ul class='list'>";
			foreach($module as $key=>$acl_data):
				echo "<li class='controller permission_module'>".$this->Form->input("permission.{$acl_data['controller']}",array('type'=>'checkbox','checked'=>true, 'value'=>$acl_data['controller'],'onchange'=>'permission_select_deselect_child(this)'));
					echo "<ul class='actions'>";
					foreach($acl_data['actions'] as $key=>$action):
						echo "<li>".$this->Form->input("permission.{$acl_data['controller']}.{$action}",array('type'=>'checkbox','checked'=>true, 'value'=>[$action]))."</li>";
					endforeach;
					echo "</ul></li>";
			endforeach;
			echo "</ul><div class='clearfix'></div>";
		endforeach;
			
		//echo $this->Form->input('permissions',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('status',array('class'=>'form-control','options'=>$status,'div'=>array('class'=>'form-group')));

		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

	echo $this->Form->end(); 
?>	</div>
</div>
