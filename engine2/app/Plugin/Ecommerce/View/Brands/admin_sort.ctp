<div class="row bar bar-primary bar-top">
	<div class="col-md-3">
		<h1 class="bar-title"><?php echo __('Brands'); ?></h1>
	</div>
	<div class="col-md-9 text-right">
		<?php echo $this->Form->create('Brand',array('class'=>'searchForm','data-role'=>'form')); ?>
		<?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
		<?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
		
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> All Brands', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
		<?php echo $this->Form->create('Brand',array('class'=>'form')); ?>
			<div class="panel panel-default">
				<div class="panel-body">
					<ul class="sortable">
						<?php foreach ($brands as $brand): ?>
						<li class="ui-state-default">
							<div >
								<span class="ui-icon ui-icon-arrowthick-2-n-s" style="margin-top:7px;"></span>
								<input type="hidden" name="data[Brand][id][]" value = <?php echo $brand['Brand']['id']; ?>  />
								<div style="padding:5px;">
								<?php echo h($brand['Brand']['title']); ?>
								</div>
							</div>
							
							<div class='clearfix'></div>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="panel-footer">
					<input type="submit" name="BtnOrder" class="btn btn-success" value='Sort'  />
				</div>
			</div>
		<?php echo $this->Form->end(); ?>
			
	</div>
</div>



<style>
	.sortable { list-style-type: none; margin-left: 10px;padding: 0px; }
	.sortable li {
		background: none !important;
		color : #000;
		border: none !important;
		border-bottom: 1px solid #ccc !important;
	}
	.sortable li span { position: absolute; margin-left: -1.3em; }
</style>

<script>
	$(function() {
	$( ".sortable" ).sortable();
	$( ".sortable" ).disableSelection();
	});
</script>
<?php 
echo $this->Html->css('/jquery-ui/jquery-ui' );

echo $this->Html->script(
		array(
			'/jquery-ui/jquery-1.10.2',
			'/jquery-ui/jquery-ui',
		
		)
	);

?>