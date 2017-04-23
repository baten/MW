<style type="text/css" media="print">
	@media print {
		@page { margin: 0; }
		body { margin: 1.6cm; }
	}
</style>

<div class="row">
	<div class="col-md-12">
		<h1 class="page-title"><?php echo __('Deliveryman details'); ?></h1>


		<ul class="list-group">
			<li class="list-group-item"><strong><?php echo __('Id'); ?></strong>: <?php echo h($deliveryman['Deliveryman']['id']); ?></li>
			<li class="list-group-item"><strong><?php echo __('Name'); ?></strong>: <?php echo h($deliveryman['Deliveryman']['name']); ?></li>
			<li class="list-group-item"><strong><?php echo __('Phone'); ?></strong>: <?php echo h($deliveryman['Deliveryman']['phone']); ?></li>
			<li class="list-group-item"><strong><?php echo __('Email'); ?></strong>: <?php echo h($deliveryman['Deliveryman']['email']); ?></li>
			<li class="list-group-item"><strong><?php echo __('Address'); ?></strong>: <?php echo h($deliveryman['Deliveryman']['address']); ?></li>
		</ul>

	</div>
	<div class="col-md-12">
		<div class="col-md-6">

			<button class="btn btn-primary" id="print-btn"> print </button>

		</div>
		<div class="col-md-6">

        <?php
        echo $this->Form->create('Deliveryman',array('method'=> 'post','url'=>array('action'=>'view',$deliveryman["Deliveryman"]["id"]),'class'=>'form-inline'));

        echo $this->Form->input('DeliveryDate',array("value"=> !empty($deliverydate)? $deliverydate:date("Y-m-d"),'type'=>'search','class'=>'datepicker form-control','div'=>array('class'=>'form-group')));


        echo $this->Form->button('Search',array('type'=>'submit','class'=>'btn btn-success','label'=>false,'div'=>false));

        echo $this->Form->end();
        ?>

		</div>
		<br>
		<br>
		<div id="print-div">

			<h4>Delivery Date: <?php echo  !empty($deliverydate)? $deliverydate:date("Y-m-d") ?></h4>
		<table class="table table-striped">
			<thead>
			<tr>
				<th>Order Details</th>
			    <th>Shipping Details</th>
			</tr>

			</thead>
			<tbody>
			<?php
			foreach ($deliveryman["ProductOrders"] as $productorder)
			{


				$order_details=json_decode($productorder['order_detail'],true);
				$shipping_details=json_decode($productorder['shipping_detail'],true);



				?>
			<tr>

				<td>

					<table class="table">
						<tr>
							<th>
								name
							</th>
							<th>
								price
							</th>
							<th>
								quantity
							</th>
						</tr>
						<?php
						$total=0;

						foreach ($order_details["cart"] as $order_detail) {
							$total+=$order_detail["productBasePrice"]*$order_detail["productQuantity"];

							?>



									<tr>
										<td>
											<?php echo $order_detail["productTitle"]; ?>


										</td>
										<td><?php echo $order_detail["productBasePrice"]."TK"; ?>
										</td>
										<td>
											<?php echo $order_detail["productQuantity"]; ?>
										</td>

									</tr>



							<?php
						}

						?>

						<tr>
							<td colspan="2"><strong>Subtotal: </strong></td>
							<td> <?php echo $total ?></td>
						</tr>

						<tr>
							<td colspan="2"><strong>Discount </strong></td>
							<td> <?php echo $order_details["discount"] ?></td>
						</tr>
						<tr>
							<td colspan="2"><strong>Total </strong></td>
							<td> <?php echo $total-$order_details["discount"] ?></td>
						</tr>
						<tr>
							<td colspan="2">
							<strong>Note:</strong> <?php echo $productorder["note"] ?>
							</td>
						</tr>

					</table>

				</td>
				<td>
					<ul class="list-group">

						<li class="list-group-item">
							<strong>Name:</strong>
							<?php echo $shipping_details['fname']." ".$shipping_details['lname']; ?>
						</li>
						<li class="list-group-item">
							<strong>Phone:</strong>
							<?php echo $shipping_details['cell']; ?>
						</li>

						<li class="list-group-item">
							<strong>Address1:</strong>
							<?php echo $shipping_details['addressLine1']; ?>
						</li>
						<li class="list-group-item">
							<strong>Addres2:</strong>
							<?php echo $shipping_details['addressLine2']; ?>
						</li>
						<li class="list-group-item">
							<strong>City:</strong>
							<?php echo $shipping_details['city']; ?>
						</li>
						<li class="list-group-item">
							<strong>Country:</strong>
							<?php echo $shipping_details['country']; ?>
						</li>
						<li class="list-group-item">
							<strong>State:</strong>
							<?php echo $shipping_details['state']; ?>
						</li>




						<li class="list-group-item">
								<strong>Order Date:</strong>
								<?php echo  date_format(date_create($productorder['order_date']),'d-m-Y'); ?>
							</li>
						<li class="list-group-item">
							<strong>delivery Date:</strong>
							<?php echo  date_format(date_create($productorder['delivery_date']),'d-m-Y'); ?>
						</li>


						<?php if (strtolower($productorder['payment_status']) == 'completed') { ?>
							<li class="list-group-item" ><strong>Complete Date
									:</strong> <?php echo $productorder['complete_date']; ?></li>
						<?php } ?>



					</ul>

				</td>

			</tr>
			<?php } ?>
			</tbody>

		</table>

		</div>
	</div>

</div>
<script>

	$("#print-btn").click(function () {
	var printdiv=$("#print-div").html();
		var body=$("body").html();
		$("body").html(printdiv);
		$("body").prepend("<h3 ><u>Orders To Deliver<\/u><\/h3>");

		window.print();
		$("body").html(body);

	});

</script>

