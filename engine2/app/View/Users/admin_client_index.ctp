<div class="row bar bar-primary bar-top">
	<div class="col-md-3">
		<h1 class="bar-title"><?php echo __('Users'); ?></h1>
	</div>
	<div class="col-md-9 text-right">
		<?php echo $this->Form->create('User',array('class'=>'searchForm','data-role'=>'form')); ?>
		<?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
		<?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
		
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<div class="row">
   <ul class="nav navbar-nav"> 
        <li>
        <?php
	        echo $this->Html->link('System Users',array(
	        'controller' => 'users',
	        'action' => 'index'
	    	));
	    ?>
    </li>
     <li>
        <?php
	        echo $this->Html->link('Registered Clients',array(
	        'controller' => 'users',
	        'action' => 'clientIndex'
	    	));
	    ?>
	  </li>
   </ul>
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped" >
			<thead>
			<tr class="info">
				<th><?php echo $this->Paginator->sort('username'); ?></th>
				<th><?php echo $this->Paginator->sort('personal_details'); ?></th>
				<th><?php echo $this->Paginator->sort('role_id'); ?></th>
				<th><?php echo $this->Paginator->sort('status'); ?></th>
				<th class="text-right action-th"><?php echo __('Actions'); ?></th>
			</tr>
			</thead>
			
			<tbody>
			<?php foreach ($users as $user): ?>
				<tr>
					<td><?php echo h($user['User']['username']); ?></td>
					<td>
						<?php 
							$details  = json_decode($user['User']['personal_details'],true);
						?>
						
						<address>
							<span>
							  	<a href="mailto:<?php echo $user['User']['username']?>"><?php echo $details['vorname']." ".$details['nacname'];?></a><br>
							  	<?php echo $details['phone']; ?>
						  	</span>	
						</address>
					</td>
					<td>
						<?php echo $user['Role']['title']; ?>
					</td>
					<td><?php echo h($status[$user['User']['status']]); ?></td>
					<td class="text-right action">
						<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-edit\'></i> Edit', array('action' => 'edit',$user['User']['id'], 1,'admin'=>true),array('escape'=>false,'class'=>'btn btn-warning')); ?>	
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