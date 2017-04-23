<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Edit Product Type'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List All product types', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php
		$type_current_data = $this->request->data;
		echo $this->Form->create('Type',array('class'=>'form','onsubmit'=>'process_type_forms("edit");return false;')); 
	?>
		
	<div class="form-section-heading">Product Type details </div>
	<div class="panel panel-info">
		<div class="panel-heading">
			<div class="panel-title">Categories</div>
		</div>
		<div class="panel-body category-brand-box">
		
			<?php
				echo $this->UyTree->printEcommerceCategoryTree($catNode,$category_has_types,$currentCategories);
			?>
			
			
			<?php
			/*
		
			
				static $j = 0;
				foreach($productCategories as $c_id => $c_title):
					foreach($type_current_data['TypeCategory'] as $type_category_index => $type_category_value ):
						$checked = false;
						if($c_id == $type_category_value['category_id']):
							$checked = true;
							break;
						endif;
					endforeach;
					
					//check free or not free
					if(array_key_exists($c_id, $category_has_types)):
						if($checked == true):
							echo "<label class='checkbox' style='margin-left : 20px;'>".$this->Form->input("Type.TypeCategory.{$j}.category_id",array('class'=>'category_ids','type'=>'checkbox','value'=>$c_id,'label'=>false,'checked'=>$checked,'div'=>false))." {$c_title}</label>";
						else:
							echo "<label class='checkbox' style='margin-left : 20px;'>".$this->Form->input("Type.TypeCategory.{$j}.category_id",array('class'=>'category_ids','type'=>'checkbox','value'=>$c_id,'label'=>false,'checked'=>$checked,'disabled' => true, 'div'=>false))." {$c_title}</label>";
						endif;
						
					else:
						echo "<label class='checkbox' style='margin-left : 20px;'>".$this->Form->input("Type.TypeCategory.{$j}.category_id",array('class'=>'category_ids','type'=>'checkbox','value'=>$c_id,'label'=>false,'checked'=>$checked, 'div'=>false))." {$c_title}</label>";
					endif;
					
				$j++;
				endforeach;
				
				*/
			?>
		</div>
	</div>

	<?php
		echo $this->Form->input('id',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('title',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('description',array('type'=>'textarea', 'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('status',array('options'=>$status, 'class'=>'form-control','div'=>array('class'=>'form-group')));
	?>
	<div class="form-section-heading">
        <span class="pull-left">Attributes</span>
    <span class="btn btn-success pull-right" onclick="add_more_attr()">Add More attributes</span> 
        <div class="clearfix"></div>
    </div>
	<div class="attr-holder">
		<?php foreach($this->request->data['Attribute'] as $k=>$v): ?>
		<div class="attr">
			<div class="row">
				<!--  attribute -->
				<div class="col-md-6">
                
					<div class="row">
						<div class="col-md-12">
							<span class="btn btn-warning btn-sm pull-right" onclick="remove_attr(this);">Remove Attribute</span>
						</div>
					</div>
					
					<div class="row" style="margin-top: 30px;">
						<div class="col-md-12">
							<?php echo $this->Form->input('Attribute.title',array('value'=>$v['title'], 'label'=>'Name','attribute_id' => $v['id'],'class'=>'form-control attr-title','div'=>array('class'=>'form-group')));?>
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
							<?php foreach($v['AttributeValue'] as $i=>$j):?>
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
		<?php endforeach;?>
	</div>
	
		
	<?php 
		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

	echo $this->Form->end(); 
	?>
	</div>
</div>
