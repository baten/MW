<?php 
echo $this->Html->css('/jquery-ui/jquery-ui' );

echo $this->Html->script(
		[
		'/jquery-ui/jquery-1.10.2',
		'/jquery-ui/jquery-ui',
		
		]
	);

?>

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
	</div>	
</div>

<div class="row bar bar-third">
	<?php foreach($menu_location as $k=>$v):  if(sizeof($menu_arrays[$v]) >0): ?> 
		<?php echo $this->Form->create('Menu'.$v,array('class'=>'form')); ?> 
		<div class="col-md-12">
			<div class="panel panel-info">
				<div class="panel-heading "><strong><?php echo $v;?></strong></div>
				<div class="table-responsive">
				<?php echo $this->Tree->menuSortable($menu_arrays[$v], 0, 'sortable','dsfd');?>
				</div>
				<div class="panel-footer">
					<input type="submit" name="BtnOrder" class="btn btn-success" value='<?php echo 'Sort '.$v;?>'  />
				</div>
				
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
		<?php endif;?>
	
	<?php endforeach;?>
	
</div>


<style>
	.table-responsive ul li  {
	border-radius: 5px;
	margin-bottom: 10px;
	list-style: none;
	padding: 5px;
	font-size: 12px !important;	
	}
	.table-responsive ul li ul li {
	margin-bottom: 4px;
	margin-top: 4px;
	}
	
	.ui-sortable-handle{cursor: pointer;}		
				
</style>

<script>
$(function() {
$( ".sortable" ).sortable();
$( ".sortable" ).disableSelection();
});
</script>
