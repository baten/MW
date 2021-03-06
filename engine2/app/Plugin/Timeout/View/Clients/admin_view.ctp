<div class="row bar bar-primary bar-top">
	<div class="col-md-3">
		<h1 class="bar-title"><?php echo __('Client details'); ?></h1>
	</div>

</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List All', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>
</div>
<dl class='dl-horizontal'>
	<?php $clientDetails = json_decode($client['Client']['details'],true);?>


	<dt><?php echo __('Name'); ?></dt>
	<dd><?php echo $clientDetails['fname']." ".$clientDetails['lname']; ?></dd>
	<dt><?php echo __('Username'); ?></dt>
	<dd><?php echo h($client['Client']['username']); ?></dd>
	<dt><?php echo __('Phone'); ?></dt>
	<dd><?php echo $clientDetails['phone']; ?></dd>

	<dt><?php echo __('Created'); ?></dt>
	<dd><?php echo h($client['Client']['created']); ?></dd>

</dl>


<div class="row bar bar-third">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table">
				<thead>
				<tr class="info">
					<th>Customer</th>
					<th><?php echo $this->Paginator->sort('order_detail'); ?></th>
					<th>Total</th>
					<th><?php echo $this->Paginator->sort('Payment Method'); ?></th>
					<th><?php echo $this->Paginator->sort('Payment Status'); ?></th>
					<th><?php echo $this->Paginator->sort('order_date'); ?></th>
					<th><?php echo $this->Paginator->sort('complete_date'); ?></th>
					<th class="text-right action-th"><?php echo __('Change Status'); ?></th>
				</tr>
				</thead>

				<tbody>
				<?php foreach ($productOrders as $productOrder):
					$bgClass = '';
					$viewed = '';
					if(empty($productOrder['ProductOrder']['view_status'])){
						$bgClass = 'alert-success';
						$viewed = 'y';
					}
					?>
					<tr class="<?php echo $bgClass;?>">
						<td>
							<?php
							echo $productOrder['ProductOrder']['id'];
							?>
						</td>

						<td>
							<?php
							$order_data = json_decode($productOrder['ProductOrder']['order_detail'], true);

							$shippingDetails = json_decode($productOrder['ProductOrder']['shipping_detail'],true);
							?>
							<?php
							$total = 0;
							if(isset($order_data['cart'])){
								foreach ($order_data['cart'] as $i => $v):
									?>
									<div>
										<?php echo  $v['productTitle'].','?>
										Quantity : <?php echo $v['productQuantity'].','?>
										Price : <?php $total = $total+($v['productBasePrice'] * $v['productQuantity']); echo $v['productBasePrice'];?>;
									</div>
									<?php
								endforeach;
							}
							if(!empty($order_data['discount'])):
								?>
								<div>Discount : <?php echo $order_data['discount'];?></div>
							<?php endif;?>
							<div>Shipping Cost : <?php echo $shippingDetails['shippingCost'];?></div>
						</td>

						<td class="total">TK.<span class="cost"><?php echo ($total + $shippingDetails['shippingCost']); ?></span></td>
						<td><?php if($shippingDetails['paymentMethod'] == 'cod'){
								echo 'Cash On Delivery';
							}else {
								echo 'Online';
							}
							?></td>
						<td>
							<?php echo h($productOrder['ProductOrder']['payment_status']); ?>
						</td>
						<td><?php echo h(date_format(date_create($productOrder['ProductOrder']['order_date']),'d-m-Y h:i:s')); ?></td>
						<td><?php echo h($productOrder['ProductOrder']['complete_date']); ?></td>
						<td class="text-center">
							<?php echo $this->Html->Link('<i class=\'glyphicon glyphicon-envelope\'></i> View', array('controller'=>'product_orders','action' => 'order_view', $productOrder['ProductOrder']['id'],'view',$viewed, 'admin' => true,'plugin'=>'ecommerce'), array('escape' => false, 'class' => 'btn btn-warning btn-xs')); ?>

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
				?>            </p>

			<div class="pagination">
				<?php
				echo $this->Paginator->prev('< ' . __('previous'), array('tag' => 'li', 'disabledTag' => 'a'), null, array('class' => 'prev disabled', 'tag' => 'li', 'disabledTag' => 'a'));
				echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentTag' => 'a', 'currentClass' => 'current disabled'));
				echo $this->Paginator->next(__('next') . ' >', array('tag' => 'li', 'disabledTag' => 'a'), null, array('class' => 'prev disabled', 'tag' => 'li', 'disabledTag' => 'a'));
				?>
			</div>
		</div>
	</div>
</div>
<style>
	.action {
		min-width: 290px !important;
	}
</style>