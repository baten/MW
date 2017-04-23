<div class="row bar bar-primary bar-top">
	<div class="col-md-3">
		<h1 class="bar-title"><?php echo __('Social Networks'); ?></h1>
	</div>
	<div class="col-md-9 text-right">
		<?php echo $this->Form->create('SocialNetwork',array('class'=>'searchForm','data-role'=>'form')); ?>
		<?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
		<?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
		
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List All', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
		<?php echo $this->Form->create('SocialNetwork',array('class'=>'form')); ?>
			<div class="panel panel-info">
				<div class="panel-body">
					<ul class="sortable">
						<?php foreach ($socialNetworks as $socialNetwork): ?>
						<li class="ui-state-default">
							<div>
								<span class="ui-icon ui-icon-arrowthick-2-n-s" style="margin-top:15px;"></span>
								<input type="hidden" name="data[SocialNetwork][id][]" value = <?php echo $socialNetwork['SocialNetwork']['id']; ?>  />
								<div style="padding:5px;">
								<?php 
								echo $socialNetwork['SocialNetwork']['title'];
								//$img_file = WWW_ROOT."img".DS."site".DS."social_icons".DS.$socialNetwork['SocialNetwork']['id'].".png";
								//if(file_exists($img_file)){
									//echo $this->Html->image("site/social_icons/{$socialNetwork['SocialNetwork']['id']}.png",array('class'=>'img-responsive'));
								//}
								?>
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
	.sortable { list-style-type: none; margin-left:20px; padding: 0;  }
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
