<div class="row bar bar-primary bar-top">
	<div class="col-md-3">
		<h1 class="bar-title"><?php echo __('Subscriber Notifications'); ?></h1>
	</div>
	<div class="col-md-9 text-right">
		<?php echo $this->Form->create('SubscriberNotification',array('class'=>'searchForm','data-role'=>'form')); ?>
		<?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
		<?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
		
		<?php echo $this->Form->end(); ?>
	</div>
</div>
<?php if(count($subscriberNotifications) < 1):?>
<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-plus-sign\'></i> Add Subscriber Notifications', array('action' => 'add','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>
<?php endif;?>
<div class="row bar bar-third">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped" >
				<thead>
					<tr class="info">
						<th><?php echo $this->Paginator->sort('title'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="text-right action-th"><?php echo __('Actions'); ?></th>
					</tr>
				</thead>
			
				<tbody>
				<?php foreach ($subscriberNotifications as $subscriberNotification): ?>
					<tr>
						<td><?php echo h($subscriberNotification['SubscriberNotification']['title']); ?>&nbsp;</td>
						<td><?php echo h($subscriberNotification['SubscriberNotification']['created']); ?>&nbsp;</td>
						<td><?php echo h($subscriberNotification['SubscriberNotification']['modified']); ?>&nbsp;</td>
						<td class="text-right action">
							<?php echo $this->Html->link('<i class=\'fa fa-paper-plane\'></i> Send Mail', array('action' => 'edit', $subscriberNotification['SubscriberNotification']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-warning')); ?>
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