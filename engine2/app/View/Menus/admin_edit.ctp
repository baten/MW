<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Edit Menu'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Menus', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	echo $this->Form->create('Menu',array('class'=>'form')); 
	
		echo $this->Form->input('id',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('parent_id',array('options'=>$parentMenus,'empty'=>'Select One ...', 'class'=>'form-control','required'=>false, 'div'=>array('class'=>'form-group')));
		echo $this->Form->input('title',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		//echo $this->Form->input('slug',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('location',array( 'options'=>$menu_location,'class'=>'form-control','div'=>array('class'=>'form-group')));
		
		?>
		<div data-ng-app ="menu" data-ng-controller="menuController">
		<?php
		if($this->data['Menu']['type'] != 'functional'):
		
			echo $this->Form->input('type',array('type'=>'select', 'existing_value'=>$this->request->data['Menu']['type'], 'data-ng-change'=>'checkMenuType()','options'=>$menu_types,'option_values'=>json_encode($menu_types), 'class'=>'form-control menu-types', 'data-ng-model'=>'menuTypes', 'div'=>array('class'=>'form-group')));
			echo $this->Form->input('web_pages',array('options'=>$webpages, 'class'=>'form-control','div'=>array('class'=>'form-group web-page-list-on-menu')));
			echo $this->Form->input('link_data',array('type'=>'text', 'class'=>'form-control','label'=> 'Url', 'div'=>array('class'=>'form-group menu-url-input' )));
		endif;
			
		?>
		</div>
		<?php 
		
		echo $this->Form->input('status',array('options'=>$status, 'class'=>'form-control','div'=>array('class'=>'form-group')));

		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

	echo $this->Form->end(); 
?>	</div>
</div>
