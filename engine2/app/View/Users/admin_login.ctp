<div class="panel panel-info">
	<div class="panel-heading">
		<h1 class="panel-title "><i class="glyphicon glyphicon-lock"></i> Login</h1>
	</div>
	<div class="panel-body">
		<?php echo $this->Session->flash(); ?>
	    <?php 
			echo $this->Form->create('User',array('class'=>'form','type'=>'file')); 
				echo $this->Form->input('username',array('type'=>'text','class'=>'form-control','div'=>array('class'=>'form-group')));
				echo $this->Form->input('password',array('class'=>'form-control','div'=>array('class'=>'form-group')));
				echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
				echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));
			echo $this->Form->end(); 
		?>	
	</div>
</div>

