<div class="panel-group" id="accordion-menu">
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<?php echo $this->Html->link('<i class="glyphicon glyphicon-dashboard"></i> Web Page Manager','#webPageManager',['escape'=>false,'data-toggle'=>"collapse" ,'data-parent'=>"#accordion-menu"]);?>
			</h4>
		</div>
		<div id="webPageManager" class="panel-collapse collapse in">
			<div class="panel-body">
				<?php echo $this->Html->link('<i class="glyphicon glyphicon-dashboard"></i> List All',['controller'=>'web_pages','action'=>'index','admin'=>true],['escape'=>false,'data-toggle'=>"collapse" ,'data-parent'=>"#accordion-menu"]);?>
			</div>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion-meu"
					href="#menuManager"> Collapsible Group Item #1 </a>
			</h4>
		</div>
		<div id="menuManager" class="panel-collapse collapse in">
			<div class="panel-body">
				Menu
			</div>
		</div>
	</div>
</div>
