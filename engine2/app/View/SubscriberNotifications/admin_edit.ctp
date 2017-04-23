<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Edit Subscriber Notification'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Subscriber Notifications', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
	<?php 
	echo $this->Form->create('SubscriberNotification',array('type'=>'file','class'=>'form'));  
	
		echo $this->Form->input('id');
		echo $this->Form->input('subscriberSrc',array('legend'=>false,'type'=>'radio','options'=>$searchtype,'default'=>1,'onChange'=>'changeSrctype(this.value)','div'=>array('class'=>'form-group')));
		echo $this->Form->input('subscriber_id',array('multiple' => true,'class'=>'form-control','required'=>true,'div'=>array('class'=>'form-group subscriberList')));
		echo $this->Form->input('title',array('class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('message',array('type'=>'textarea','class'=>'form-control editor','div'=>array('class'=>'form-group')));
		echo $this->Form->input('attachFile',array('type'=>'file','div'=>array('class'=>'form-group')));

		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

	echo $this->Form->end(); 
?>	</div>
</div>
<script type="text/javascript">
function changeSrctype(vl){
	if(parseInt(vl) === 1){
		$('.subscriberList').show();
	}else{
		$('.subscriberList').hide();
	}
}
</script>

