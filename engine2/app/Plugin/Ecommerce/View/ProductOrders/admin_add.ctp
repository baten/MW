<div class="row bar bar-primary bar-top">
	<div class="col-md-12">
		<h1 class="bar-title"><?php echo __('Admin Add Product Order'); ?></h1>
	</div>
</div>

<div class="row bar bar-secondary">
	<div class="col-md-12">
		<?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Product Orders', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
	</div>
</div>


<div class="">

	<div class="row bar bar-third panel ">
		<div class="col-md-7 well card-1">
			<?php
			echo $this->Form->create('ProductOrder',array('url'=>array('action'=>'add',$client["Client"]['id']),'class'=>'form'));

			echo $this->Form->input('ProductOrder.Product',array('required'=>true, 'value'=>'','empty'=>'Please select...','id'=>"productselect",'div'=>array('class'=>'form-group col-md-8')));
			echo $this->Form->input('ProductOrder.unit',array('min'=>1,'value'=>'1','required'=>true,'class'=>'form-control','type'=> 'number','div'=>array('class'=>'form-group col-md-4')));

			?>

			<div id="attributediv">


			</div>

			<?php
			echo $this->Form->button('Add to cart',array('name'=>'action','value'=>'add','type'=>'submit','class'=>'btn btn-success btn-block','label'=>false,'div'=>array('class'=>'form-group col-md-2')));

			echo $this->Form->end();

			?>	</div>
		<div class="col-md-5 ">
			<ul class="list-group  card-1">

				<li class="list-group-item"><b>Full name: </b> <?php echo $client['Client']['details']['fname']." ".$client['Client']['details']['lname']; ?> </li>
				<li class="list-group-item"><b>Username: </b> <?php echo $client['Client']['username']; ?> </li>
				<li class="list-group-item"><b>Created at: </b> <?php echo $client['Client']['created']; ?> </li>

			</ul>
		</div>
		<div class="row">
			<div class="col-md-8">
				<table class="table   card-1">
					<thead>
					<tr>
						<th>
							Product Title
						</th>
						<th>
							Unit Price
						</th>

						<th>
							Unit
						</th>
						<th>
							Total Price
						</th>
						<th >
							Attributes
						</th>
						<th>
							Action
						</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$subtotal=0;

					if(!empty($cart))
					{

						foreach ($cart as $key => $item):
							?>

							<tr>
								<td>
									<?php echo $item['product']['Product']['title'];?>


								</td>
								<td>

									<?php echo $price=!empty($item['product']['Product']['sale_price'])? $item['product']['Product']['sale_price']:$item['product']['Product']['price'];?>

								</td>
								<td>
									<?php
									echo $this->Form->create('ProductOrder',array('url'=>array('action'=>'add',$client["Client"]['id']),'class'=>'form-inline'));

									echo $this->Form->input('ProductOrder.Product',array("type"=>"hidden",'required'=>true,'value'=>$key));
									echo $this->Form->input('ProductOrder.unit',array('min'=>1,'value'=>$item['unit'],'required'=>true,'type'=> 'number','label'=>false));



												echo $this->Form->button('update',array('name'=>'action','value'=>'updateunit','type'=>'submit','class'=>'btn btn-warning btn-xs updateunit'));

									echo $this->Form->end();
									?>


								</td>
								<td>
									<?php echo $total=$item['unit']*$price;
									$subtotal+=$total;

									?>


								</td>
								<td>

									<?php

								if (sizeof($item["attribute"]))
								{
									foreach ($item["attribute"] as $attribute => $attribute_value)
									{

										echo $attribute.": ".$attribute_value."<br>";
									}

								}
								else {
									echo "No attribute";
								}
									?>


								</td>
								<td>
									<?php
									echo $this->Form->create('ProductOrder',array('url'=>array('action'=>'add',$client["Client"]['id']),'class'=>'form-inline'));

									echo $this->Form->input('ProductOrder.Product',array("type"=>"hidden",'required'=>true,'value'=>$key));


									echo $this->Form->button('-',array('name'=>'action','value'=>'remove','type'=>'submit','class'=>'btn btn-danger btn-sm','label'=>false,'div'=>false));

									echo $this->Form->end();
									?>
								</td>

							</tr>


						<?php endforeach;?>

						<tr>
							<td >

								<?php
								echo $this->Form->create('ProductOrder',array('url'=>array('action'=>'add',$client["Client"]['id']),'class'=>'form-inline'));


								echo $this->Form->button('Reset',array('name'=>'action','value'=>'reset','type'=>'submit','class'=>'btn btn-danger btn-left-margin','label'=>false,'div'=>false));

								echo $this->Form->end();
								?>



							</td>
							<td colspan="3">


							</td>
						</tr>
						<tr>
							<td colspan="3"></td>
							<td><b>SUB TOTAL:</b> <?php echo $subtotal;?></td>
						</tr>
						<tr>
							<td colspan="3"></td>
							<td>
								<b>Discount:</b>
								<?php
								echo $this->Form->create('ProductOrder',array('url'=>array('action'=>'add',$client["Client"]['id']),'class'=>'form-inline'));

								echo $this->Form->input('ProductOrder.discount',array('min'=>0,'value'=> $discount=!empty($discount)? $discount:0,'required'=>true,'type'=> 'number','label'=>false));


								echo $this->Form->button('update',array('name'=>'action','value'=> 'discount','type'=>'submit','class'=>'btn btn-warning btn-sm','label'=>false,'div'=>false));

								echo $this->Form->end();
								?>
							</td>
						</tr>
						<tr>
							<td colspan="3"></td>
							<td>
								<h4><b>Grand Total total:</b> <?php echo $subtotal-$discount;?></h4>
							</td>
						</tr>



					<?php } ?>
					</tbody>
				</table>

			</div>
			<div class="col-md-4">
				<ul class="list-group card-1">


					<li class="list-group-item well"> <?php
						echo $this->Form->create('ProductOrder',array('url'=>array('action'=>'add',$client["Client"]['id']),'class'=>'form'));


						echo $this->Form->input('ProductOrder.address_line_1',array('value'=> !empty($address_line_1)? $address_line_1:'','type'=> 'textarea','class'=>'form-control','label'=>'Address: '));
						echo $this->Form->input('ProductOrder.address_line_2',array('value'=> !empty($address_line_2)? $address_line_2:'','type'=> 'textarea','class'=>'form-control','label'=>'Address Two: '));



						echo $this->Form->input('ProductOrder.phone',array('value'=>!empty($phone)? $phone:'','type'=> 'text','class'=>'form-control','label'=>'Phone: '));
						echo $this->Form->input('ProductOrder.state',array('value'=> !empty($state)? $state:'','type'=> 'text','class'=>'form-control','label'=>'State: '));
						echo $this->Form->input('ProductOrder.country',array('value'=> !empty($country)? $country:'','type'=> 'text','class'=>'form-control','label'=>'Country: '));
						echo $this->Form->input('ProductOrder.region',array('value'=> !empty($region)? $region:'','type'=> 'text','class'=>'form-control','label'=>'Region: '));
						echo $this->Form->input('ProductOrder.poBox',array('value'=> !empty($poBox)? $poBox:'','type'=> 'text','class'=>'form-control','label'=>'Po Box: '));

						echo $this->Form->input('ProductOrder.payment',array('options'=>$paymentlist,'selected'=>!empty($delivery['payment'])? $delivery['payment']:'Cash on Delivery','required'=>true,'empty'=>'Please select...','class'=>'form-control','div'=>array('class'=>'form-group')));




						?>

						<br>

						<?php

						echo $this->Form->button('ORDER',array('name'=>'action','value'=> 'order','type'=>'submit','class'=>'btn btn-primary btn-sm btn-block','label'=>false,'div'=>false));
						
						echo $this->Form->end();
						?>
					</li>

				


				</ul>
			</div>
		</div>

	</div>
</div>

<script>
	function attribute_input_finder () {
		$("#attributediv").html("");

		adata={
			action:"getproduct",
			ProductOrder:{
				Product: $(this).val()
			}
		};

		$.ajax({
			method: 'post',
			data: { data : adata },
			contentType: "application/x-www-form-urlencoded",
			url: $(location).attr('href'),
			success:function (data) {

				if(data!=0)
				{

					jsonattribute=JSON.parse(data);


					var myhtml="";

					for (i=0;i<jsonattribute.length;i++) {

						var strVar = "";
						strVar += "<div class=\"form-group\">";
						strVar += "<label for=\"sel1\">" + jsonattribute[i][0].Attribute.title + "<\/label>";


						strVar += "  <select name=\"data[ProductOrder][attribute][" + jsonattribute[i][0].Attribute.title + "]\" class=\"form-control\" id=\"sel1\">";
						for (j=0;j<jsonattribute[i][0].AttributeValue.length;j++) {
							strVar += "    <option  value=\""+jsonattribute[i][0].AttributeValue[j].value+"\">"+jsonattribute[i][0].AttributeValue[j].value+"<\/option>";
						}
						strVar += "  <\/select>";
						strVar += "<\/div>";
						myhtml+=strVar;

					}
					console.log(myhtml);
					$("#attributediv").html(myhtml);




				}


			}


		});


	}


$("#productselect").change(attribute_input_finder );

</script>