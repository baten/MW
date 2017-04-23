<h1 class="page-title"><?php echo __('Coupon details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($coupon['Coupon']['id']); ?></dd>

	<dt><?php echo __('Coupon Number'); ?></dt>
	<dd><?php echo h($coupon['Coupon']['coupon_number']); ?></dd>

	<dt><?php echo __('Discount Type'); ?></dt>
	<dd><?php echo h($coupon['Coupon']['discount_type']); ?></dd>

	<dt><?php echo __('Discount Amount'); ?></dt>
	<dd><?php echo h($coupon['Coupon']['discount_amount']); ?></dd>

	<dt><?php echo __('Is Validity'); ?></dt>
	<dd><?php echo h($coupon['Coupon']['is_validity']); ?></dd>

	<dt><?php echo __('Start Time'); ?></dt>
	<dd><?php echo h($coupon['Coupon']['start_time']); ?></dd>

	<dt><?php echo __('End Time'); ?></dt>
	<dd><?php echo h($coupon['Coupon']['end_time']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($coupon['Coupon']['status']); ?></dd>

</dl>
