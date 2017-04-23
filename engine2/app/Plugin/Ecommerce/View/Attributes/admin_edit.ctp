<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Edit Attribute'); ?></h1>
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
		$type_current_data = $this->request->data;
		echo $this->Form->create('Attribute',array('class'=>'form','onsubmit'=>'process_type_forms("edit");return false;'));
		echo $this->Form->input('Attribute.title',array('value'=>$type_current_data['Attribute']['title'], 'label'=>'Name','attribute_id' => $type_current_data['Attribute']['id'],'class'=>'form-control attr-title','div'=>array('class'=>'form-group')));
	?>
	  
	<div class="attr-holder">
		<div class="attr">
			<div class="row">
				<!-- Attr Value -->
				<div class="col-md-12 ">

					<div class="row">
						<div class="col-md-12">
							<span class="btn btn-success btn-sm pull-right" onclick="add_attr_value(this);">Add More Attribute Value</span>
						</div>
					</div>
					<div class="row">
						<div class="attr_value_holder">
							<?php foreach($type_current_data['AttributeValue'] as $i=>$j):?>
							<div class="attr_value">
								<div class="col-md-9">
									<?php echo $this->Form->input('AttributeValue.value',array('label'=>'Value','value'=>$j['value'], 'class'=>'form-control attr-value-value','attr_value_value_id' =>$j['id'], 'div'=>array('class'=>'form-group')));?>
									<?php echo $this->Form->input('AttributeValue.has_value',array('options'=>array('yes'=>'Yes','no'=>'No'),'selected'=>$j['has_price'], 'label'=>'Has Price', 'class'=>'form-control attr-value-has-value','div'=>array('class'=>'form-group')));?>
								</div>
								<div class="col-md-3 clearfix">
									<span class="btn btn-warning btn-sm" style="margin-top: 10px;" onclick="remove_attr_value(this);">Remove Value</span>
								</div>
							</div>
							<div class="clearfix"></div>
							<?php endforeach;?>
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
</div>
