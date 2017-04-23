<div class="row bar bar-primary bar-top">
	<div class="col-md-3">
		<h1 class="bar-title"><?php echo __('Menus'); ?></h1>
	</div>
	<div class="col-md-9 text-right">
		<?php echo $this->Form->create('Menu',array('class'=>'searchForm','data-role'=>'form')); ?>
		<?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
		<?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
		
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-plus-sign\'></i> Add Menus', array('action' => 'add','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
		<?php echo $this->Html->link('<i class="glyphicon glyphicon-sort"></i> Sort Menu',array('controller'=>'menus','action'=>'sort_menu','admin'=>true,'plugin'=>false),array('escape'=>false,'class'=>'btn btn-success'));?>
	</div>	
</div>

<div class="row bar bar-third">
	<?php foreach($menu_location as $k=>$v):  if(sizeof($menu_arrays[$v]) >0): ?>  
		<div class="col-md-12">
			<div class="panel panel-info">
				<div class="panel-heading "><strong><?php echo $v;?></strong></div>
				<div class="table-responsive">
					<table class="table table-condensed">
						<thead>
							<tr class="warning">
								<th>Parent Menue</th>
								<th>Title</th>
								<th>Type</th>
								<th>Link</th>
								<th>Order</th>
								<th>Status</th>
								<th class="text-right action">Actions</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($menu_arrays[$v] as $key=>$value):
						?>
							<tr>
								<td> 
									<?php if(!empty($value['PMenu']['title'])):echo $value['PMenu']['title'];endif;?>
								</td>
								<td> 
									<?php echo $value['Menu']['title'];?>
								</td>
								<td> 
									<?php echo ucfirst($value['Menu']['type']);?>
								</td>
								
								<td> 
									<?php
										if($value['Menu']['type'] == 'content'): 
											echo $web_pages[$value['Menu']['link_data']];
										else:
											echo $value['Menu']['link_data'];
										endif;
										?>
								</td>
								<td> 
									<?php echo $value['Menu']['order'];?>
								</td>
								<td> 
									<?php
									if($value['Menu']['status'] == 'active'):
										$status_class = 'status_active';
									else :  
										$status_class = 'status_inactive';
									endif;
	
									echo "<strong class='danger'>".$status[$value['Menu']['status']]."</strong>";?>
								</td>
								
								<td class="text-right action">   
									<?php 
										if($value['Menu']['is_deleteable'] == 'yes,yes'):
											 echo $this->Html->link('<i class=\'glyphicon glyphicon-edit\'></i> Edit', array('action' => 'edit',$value['Menu']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-warning'))." ";
											 echo $this->Form->postLink('<i class=\'glyphicon glyphicon-remove-circle\'></i> Delete', array('action' => 'delete', $value['Menu']['id'],'admin'=>true), array('escape'=>false,'class'=>'btn btn-danger'), __('Are you sure you want to delete?'));
										elseif($value['Menu']['is_deleteable'] == 'yes,no'):
											 echo $this->Html->link('<i class=\'glyphicon glyphicon-edit\'></i> Edit', array('action' => 'edit',$value['Menu']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-warning'))." ";
										endif;
									?>
									
								</td>
							</tr>
						<?php endforeach;?>
						
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php endif;?>
	
	<?php endforeach;?>
	
</div>

<style>
	.status_active{
	 	color : green;
 	}	
	 	
 	.status_inactive{
	 	color : red;
 	}										
</style>
