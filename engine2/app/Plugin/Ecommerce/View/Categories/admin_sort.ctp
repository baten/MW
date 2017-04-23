<div class="row bar bar-primary bar-top">
	<div class="col-md-3">
		<h1 class="bar-title"><?php echo __('Categories'); ?></h1>
	</div>
	<div class="col-md-9 text-right">
		<?php echo $this->Form->create('Category',array('class'=>'searchForm','data-role'=>'form')); ?>
		<?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
		<?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
		
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-plus-sign\'></i> All Categories', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>
<div class="row bar bar-third">
		<div class="col-md-12">
			<?php echo $this->Form->create('Category',array('class'=>'form')); ?>
			<div class="panel panel-info">
				<div class="panel-body">
				<?php echo $this->Tree->categorySortable($categories, 0, 'sortable','dsfd');?>
				</div>
				<div class="panel-footer">
					<input type="submit" name="BtnOrder" class="btn btn-success" value='Sort'  />
				</div>
				
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	
</div>


<style>
	.panel-body ul li  {
	border-radius: 5px;
	margin-bottom: 5px;
	list-style: none;
	padding: 2px;
	font-size: 12px !important;	
	}
	.panel-body ul li ul li {
	margin-bottom: 2px;
	margin-top: 2px;
	}		
				
</style>

<script>
$(function() {
$( ".sortable" ).sortable();
$( ".sortable" ).disableSelection();
});
</script>