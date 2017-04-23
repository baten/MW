<div class="row bar bar-primary bar-top">
	<div class="col-md-3">
		<h1 class="bar-title"><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?></h1>
	</div>
	<div class="col-md-9 text-right">
		<?php echo "<?php echo \$this->Form->create('{$modelClass}',array('class'=>'searchForm','data-role'=>'form')); ?>\n"; ?>
		<?php echo "<?php echo \$this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>\n";?>
		<?php echo "<?php echo \$this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>\n";?>		
		<?php echo "<?php echo \$this->Form->end(); ?>\n";?>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo "<?php echo \$this->Html->link('<i class=\'glyphicon glyphicon-plus-sign\'></i> Add {$pluralHumanName}', array('action' => 'add','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>\n";?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped" >
			<thead>
			<tr class="info">
			<?php foreach ($fields as $field): ?>
				<th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
			<?php endforeach; ?>
				<th class="text-right action-th"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
			</tr>
			</thead>
			
			<tbody>
			<?php
			echo "<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
			echo "\t<tr>\n";
				foreach ($fields as $field) {
					$isKey = false;
					if (!empty($associations['belongsTo'])) {
						foreach ($associations['belongsTo'] as $alias => $details) {
							if ($field === $details['foreignKey']) {
								$isKey = true;
								echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
								break;
							}
						}
					}
					if ($isKey !== true) {
						echo "\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
					}
				}
		
				echo "\t\t<td class=\"text-right action\">\n";
				/*echo "\t\t\t<?php echo \$this->Html->link('<i class=\'fa fa-desktop\'></i> View', array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-info')); ?>\n";*/
				
				echo "\t\t\t<?php echo \$this->Html->link('<i class=\'glyphicon glyphicon-edit\'></i> Edit', array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-warning')); ?>\n";
				echo "\t\t\t<?php echo \$this->Form->postLink('<i class=\'glyphicon glyphicon-remove-circle\'></i> Delete', array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}'],'admin'=>true), array('escape'=>false,'class'=>'btn btn-danger'), __('Are you sure you want to delete?')); ?>\n";
				echo "\t\t</td>\n";
			echo "\t</tr>\n";
		
			echo "<?php endforeach; ?>\n";
			?>
			</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="pagination-block">
			<p>
			<?php echo "<?php
			echo \$this->Paginator->counter(array(
			'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
			));
			?>"; ?>
			</p>
			<div class="pagination">
			<?php
				echo "<?php\n";
				echo "\t\techo \$this->Paginator->prev('< ' . __('previous'),array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));\n";
				echo "\t\techo \$this->Paginator->numbers(array('separator' => '','tag'=>'li','currentTag'=>'a', 'currentClass'=>'current disabled'));\n";
				echo "\t\techo \$this->Paginator->next(__('next') . ' >', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));\n";
				echo "\t?>\n";
			?>
			</div>
		</div>	
	</div>
</div>	