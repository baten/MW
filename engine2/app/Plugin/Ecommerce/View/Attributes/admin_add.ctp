<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Add New Product Type'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List All Attributes', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	echo $this->Form->create('Attribute',array('class'=>'form','onsubmit'=>'process_type_forms();return false;'));
	echo $this->Form->input('Attribute.title',array('label'=>'Name', 'class'=>'form-control attr-title', 'div'=>array('class'=>'form-group')));
	?>
	   
	<div class="attr-holder">
		<div class="attr">
				<!-- Attr Value -->
				<div class="col-md-12 ">
					<div class="row">
						<div class="col-md-12">
							<span class="btn btn-success btn-sm pull-right" onclick="add_attr_value(this);">Add More Attribute Value</span>
						</div>
					</div>
					<div class="row">
						<div class="attr_value_holder">
							<div class="attr_value">
								<div class="col-md-9">
									<?php echo $this->Form->input('AttributeValue.value',array('label'=>'Value', 'class'=>'form-control attr-value-value','div'=>array('class'=>'form-group')));?>
									<?php echo $this->Form->input('AttributeValue.has_value',array('options'=>array('no'=>'No','yes'=>'Yes'), 'label'=>'Has Price', 'class'=>'form-control attr-value-has-value','div'=>array('class'=>'form-group')));?>
								</div>
								<div class="col-md-3 clearfix">
									<span style="margin-top: 10px;" class="btn btn-warning btn-sm" onclick="remove_attr_value(this);">Remove Value</span>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<?php
		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

	echo $this->Form->end();

	
	?>
	</div>

