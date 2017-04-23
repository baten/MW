<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php printf("<?php echo __('%s %s'); ?>", Inflector::humanize($action), $singularHumanName); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo "<?php echo \$this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List {$pluralHumanName}', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>\n";?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php
		echo "<?php \n\techo \$this->Form->create('{$modelClass}',array('class'=>'form')); \n";
			echo "\t\n";
			foreach ($fields as $field) {
				if (strpos($action, 'add') !== false && $field === $primaryKey) {
					continue;
				} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
					echo "\t\techo \$this->Form->input('{$field}',array('class'=>'form-control','div'=>array('class'=>'form-group')));\n";
				}
			}
			if (!empty($associations['hasAndBelongsToMany'])) {
				foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
					echo "\t\techo \$this->Form->input('{$assocName}',array('class'=>'form-control','div'=>array('class'=>'form-group')));\n";
				}
			}
			echo "\n";
			echo "\t\techo \$this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));\n";
			echo "\t\techo \$this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));\n";
	
		echo "\n\techo \$this->Form->end(); \n";
	echo "?>";
	?>
	</div>
</div>
