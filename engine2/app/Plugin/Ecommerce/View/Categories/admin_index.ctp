<div class="row bar bar-primary bar-top">
	<div class="col-md-3">
		<h1 class="bar-title"><?php echo __('Categories'); ?></h1>
	</div>
	<div class="col-md-9 text-right">
		<?php echo $this->Form->create('Category',array('url'=>array('action' => 'index'),'class'=>'searchForm','data-role'=>'form')); ?>
		<?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
		<?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
		
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-plus-sign\'></i> Add Categories', array('action' => 'add','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-th-list\'></i> Sort Categories', array('action' => 'sort','admin'=>true),array('escape'=>false,'class'=>'btn btn-info')); ?>
		
		<?php 
			if(!empty($this->params['pass'][0])):
				echo $this->Html->link('<i class=\'glyphicon glyphicon-arrow-left\'></i> Back to List', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-info'));
			endif;
		 ?>
	</div>	
</div>
<div class="row bar bar-third">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped" >
			<thead>
			<tr class="info">
				<th><?php echo $this->Paginator->sort('title'); ?></th>
				<th><?php echo $this->Paginator->sort('status'); ?></th>
				<th class="text-right action-th"><?php echo __('Actions'); ?></th>
			</tr>
			</thead>
			
			<tbody>
			<?php foreach ($categories as $category):?>
				<tr>
					<td><?php echo h($category['Category']['title']); ?></td>
					<td><?php echo h($status[$category['Category']['status']]); ?></td>
					
					<td class="text-right action">
						<?php 
							 echo $this->Html->link('<i></i> View Sub Category', array('action' => 'index', $category['Category']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-info'));  
							 echo $this->Html->link('<i class=\'glyphicon glyphicon-edit\'></i> Edit', array('action' => 'edit', $category['Category']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-warning'));  
							 echo $this->Form->postLink('<i class=\'glyphicon glyphicon-remove-circle\'></i> Delete', array('action' => 'delete', $category['Category']['id'],'admin'=>true), array('escape'=>false,'class'=>'btn btn-danger'), __('Are you sure you want to delete?'));
						 ?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="pagination-block">
			<p>
			<?php
			echo $this->Paginator->counter(array(
			'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
			));
			?>			</p>
			<div class="pagination">
			<?php
		echo $this->Paginator->prev('< ' . __('previous'),array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));
		echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','currentTag'=>'a', 'currentClass'=>'current disabled'));
		echo $this->Paginator->next(__('next') . ' >', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));
	?>
			</div>
		</div>	
	</div>
</div>

<script type="text/javascript">
    $(".isSpecialCheck").change(function () {
        var catId = $(this).data('id');
        var base = $(this).data('base');
        var selector = $(this);
        var is_special = 0;

        if($(this).is(':checked'))
            is_special = 1  // checked


        //admin_update_special

        var postUrl = base + "/admin/ecommerce/categories/update_special";

        $.ajax({
            method: 'POST',
            url: postUrl,
            data: {
                id: catId,
                is_special: is_special
            },
            cache: false,
            headers: {'content-type': 'application/x-www-form-urlencoded'}
        }).success(function (data) {
            var data = jQuery.parseJSON(data);

            if(data.result == false){
                selector.attr('checked',false);
                alert(data.msg);
            }

        });
    });

    $(".isFeaturedCheck").change(function () {
        var catId = $(this).data('id');
        var base = $(this).data('base');
        var selector = $(this);
        var is_featured = 0;

        if($(this).is(':checked'))
            is_featured = 1  // checked


        //admin_update_special

        var postUrl = base + "/admin/ecommerce/categories/update_featured";

        $.ajax({
            method: 'POST',
            url: postUrl,
            data: {
                id: catId,
                is_featured: is_featured
            },
            cache: false,
            headers: {'content-type': 'application/x-www-form-urlencoded'}
        }).success(function (data) {
            var data = jQuery.parseJSON(data);

            if(data.result == false){
                selector.attr('checked',false);
                alert(data.msg);
            }

        });
    });
 
</script>