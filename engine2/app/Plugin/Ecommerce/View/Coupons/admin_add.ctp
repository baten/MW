<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Add Coupon'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Coupons', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>	
</div>
<div class="row bar bar-third">
	<div class="col-md-12">

<?php echo $this->Form->create('Coupon',array('class'=>'form')); ?>

		<label for="exampleInputEmail3">Number Of Coupon</label>
		<div class="amount"> 
              <?php echo $this->Form->input('num_of_coupon',array('class'=>'form-control','value'=>1,'id'=>'count','label'=>false,'escape'=>false,'after'=>'<i class="fa fa-angle-left"></i><i class="fa fa-angle-right"></i>','div'=>array('class'=>'form-group pos')));?>
        </div>
	<?php
		echo $this->Form->input('discount_type',array('options' => $discountTypes,'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->input('discount_amount',array('class'=>'form-control','label'=>'Discount','div'=>array('class'=>'form-group')));

		$options = array(
		    '1' => 'Yes',
		    '0' => 'No'
		);

		$attributes = array(
		    'legend' => 'Is Validity ?',
		    'value' => '0',
		    'onchange'=>"radioChange(this)"
		);
		echo '<div class="form-group">';
		echo $this->Form->radio('is_validity', $options, $attributes);
		echo '</div>';
		
		echo '<div id="validitySecion">';
		echo $this->Form->input('start_time',array('type'=>'text','class'=>'form-control','id'=>'coupon_start','div'=>array('class'=>'form-group col-md-6')));		
		echo $this->Form->input('end_time',array('type'=>'text','class'=>'form-control','id'=>'coupon_end','div'=>array('class'=>'form-group col-md-6')));
		echo '</div>';

		echo $this->Form->input('status',array('options' => $status,'class'=>'form-control','div'=>array('class'=>'form-group')));
		echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
		echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

	echo $this->Form->end(); 
?>	</div>
</div>

<?php 	$this->start('script'); ?>
<?php	
	echo $this->Html->css('/jquery-ui/jquery-ui-timepicker-addon');
	echo $this->Html->script('/jquery-ui/jquery-ui-timepicker-addon');
?>
<script>
//http://trentrichardson.com/examples/timepicker/
$(document).ready(function(e) {
	var startDateTextBox =  $('#coupon_start');
	var endDateTextBox =  $('#coupon_end');
	$.timepicker.datetimeRange(
		startDateTextBox,
		endDateTextBox,
		{
			minInterval: (1000*60*60), // 1hr
			dateFormat: 'dd M yy', 
			timeFormat: 'HH:mm',
			start: {}, // start picker options
			end: {} // end picker options					
		}
	); 

	if($('#CouponIsValidity0').is(':checked')){
		$("#validitySecion").hide();
	}
});
</script>
<?php	$this->end(); ?>
<!-- dateFormat: 'yy-mm-dd',timeFormat:' hh:mm:ss'  -->