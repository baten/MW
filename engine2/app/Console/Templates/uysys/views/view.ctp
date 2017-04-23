<h1 class="page-title"><?php echo "<?php echo __('{$singularHumanName} details'); ?>"; ?></h1>
<dl>
<?php
foreach ($fields as $field) {
	$isKey = false;
	if (!empty($associations['belongsTo'])) {
		foreach ($associations['belongsTo'] as $alias => $details) {
			if ($field === $details['foreignKey']) {
				$isKey = true;
				echo "\t<dt><?php echo __('" . Inflector::humanize(Inflector::underscore($alias)) . "'); ?></dt>\n";
				echo "\t<dd>\<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?><dd>\n\n";
				break;
			}
		}
	}
	if ($isKey !== true) {
		echo "\t<dt><?php echo __('" . Inflector::humanize($field) . "'); ?></dt>\n";
		echo "\t<dd><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?></dd>\n\n";
	}
}
?>
</dl>
