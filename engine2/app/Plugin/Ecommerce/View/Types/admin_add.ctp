<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Add New Product Type'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List All Product Types', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	echo $this->Form->create('Type',array('class'=>'form','onsubmit'=>'process_type_forms();return false;')); 
	?>
	<div class="form-section-heading">Product Type details </div>
	
		<!-- Category list show-->
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">Categories (disabled category has types already)</div>
				</div>
				<div class="panel-body category-brand-box">
				
					<?php 
						echo $this->UyTree->printEcommerceCategoryTree($catNode,$category_has_types);
					?>
				</div>
			</div>
		<!-- End show category list-->
	
	
	
	<?php	
		echo $this->Form->input('title',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('description',array('type'=>'textarea', 'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('status',array('options'=>$status, 'class'=>'form-control','div'=>array('class'=>'form-group')));
	?>
	<div class="form-section-heading">
		<span class="pull-left">Attributes</span>
		<div class="pull-right">
			 <span id = 'copyAttr' class="btn btn-info " onclick="show()">Copy attributes</span>
			<span class="btn btn-success" onclick="add_more_attr()">Add More attributes</span>
		</div>
		<div class="clearfix"> </div>
	</div>
	
	<div id="type" style='display: none;'><?php  echo $this->Form->input('Type.existingTypes',array('label'=>'Type', 'onchange'=>'copy_attr(this.value)','empty'=>array(''=>'Please select..'),'class'=>'form-control', 'div'=>array('class'=>'form-group')));?></div>
	<div class="attr-holder">
		<div class="attr">
			<div class="row">
                <!--  attribute -->
				<div class="col-md-6">
<!--					<div class="row">-->
<!--						<div class="col-md-12">-->
<!--							<span class="btn btn-warning btn-sm pull-right" onclick="remove_attr(this);">Remove Attribute</span>-->
<!--                            -->
<!--						</div>-->
<!--					</div>-->
					<div class="row"  style="margin-top: 30px;">
						<div class="col-md-12">
							<?php echo $this->Form->input('Attribute.title',array('label'=>'Name', 'class'=>'form-control attr-title', 'div'=>array('class'=>'form-group')));?>
						</div>
					</div>
				</div>
				
				<!-- Attr Value -->
				<div class="col-md-6 ">
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
</div>

