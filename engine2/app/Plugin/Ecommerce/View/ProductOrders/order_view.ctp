<?php if ($page != 'view') { ?>


    <div class=" bg-white">
        <div class="col-md-12">
            <div class="row">
                <!-- Payment methods -->
                <div class="col-md-4">

                    <h3 class="payment-heading">Customer/Shipping Details</h3>
					<?php 
						$shippingDetails = json_decode($data['shipping_detail'],true);
						$orderDetails = $data['order_detail'];
						//pr($orderDetails);
						//$paymentDetails = 
					?>
                      <div>
                        <div><strong>First Name
                                : </strong> <?php echo $shippingDetails['fname']; ?>
                        </div>
                         <div><strong>Last Name
                                : </strong> <?php echo $shippingDetails['lname']; ?>
                        </div>
                        <div><strong>Phone : </strong><?php echo $shippingDetails['phone']; ?></div>
                         <div><strong>Email : </strong><?php echo $data['client_detail']['username']; ?></div>
                        <div>
                            <strong>Address line 1:</strong><?php echo $shippingDetails['address_line_1']; ?>
                        </div>   
                        <?php if(!empty($shippingDetails['address_line_2'])):?>
                         <div>
                            <strong>Address line 2:</strong><?php echo $shippingDetails['address_line_1']; ?>
                        </div>  
                        <?php endif;?>                    
                          <!-- <div><strong>City : </strong><?php echo $shippingDetails['city']; ?></div>   -->                 
                        <div><strong>City : </strong><?php echo $shippingDetails['state']; ?></div>
                         <div><strong>Country : </strong><?php echo $shippingDetails['country']; ?></div>
                         
                         <!-- 
                        <div><strong>Email : </strong><a
                                href="mailto:<?php //echo $data['client_detail']['email']; ?>"><?php echo $data['client_detail']['email']; ?></a>
                        </div>    
                         -->                   
                    </div>

                    <h3 class="payment-heading">Order Details</h3>
                    
                     <div class="payment-heading"><strong>Order Number
                            :</strong> <?php echo $data['id'];?></div>

                    <div class="payment-heading"><strong>Payment Type
                            :</strong> 
                            <?php if($shippingDetails['paymentMethod'] == 'cod'){
                            	echo 'Cash On Delivery';
                            	$onlinePayment = false;
                            }else { 
                            	echo 'Online';
                            	$onlinePayment = true;
                            }
                            ?>
                            </div>

                    <div class="payment-heading"><strong>Order Date :</strong> <?php echo date_format(date_create($data['order_date']),'d-m-Y h:i:s'); ?>
                    </div>
                    <?php if($onlinePayment):?>
                    <div class="payment-heading"><strong>Payment Status
                            :</strong> <?php echo $data['payment_status']; ?>
                    </div>
                    <?php endif;?>
                    <?php if (strtolower($data['payment_status']) == 'completed') { ?>
                        <div class="payment-heading" data-ng-show="completeDate"><strong>Complete Date
                                :</strong> <?php echo $data['complete_date']; ?></div>
                    <?php } ?>
                </div>

                <div class="col-md-8">
                    <div class="productSummery">
                        <h3 class="payment-heading">Product Summery</h3>
                         <table class="table table-theme-timeout">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Unit Price</th>
                                <th>Qty</th>                              
                                <th class="text-right">Sub Total</th>                              
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $gTotal = 0; $vat=0;                           
                            $orderDetails=$data['order_detail'];
                           // pr($orderDetails);
                             if(isset($orderDetails)){    
                            foreach ($orderDetails['cart'] as $oKey => $oVal) { $unitType = '';
                            	if(isset($oVal['productUnit'])){
                            		$unitType = '(' . $oVal['productUnit'] .')';
                            	}
                            	
                            	$discount = 0;
                            	if(!empty($orderDetails['discount'])){
                            		$discount = $orderDetails['discount'];
                            	}
                            	
                            ?>
                                <tr>                                   
                                    <td> <?php  echo $oVal['productTitle'] . $unitType; ?> </td>
                                    <td><?php echo 'USD ' . $oVal['productBasePrice']; ?></td>
                                    <td><?php echo $oVal['productQuantity']; ?></td>
                                    <td class="text-right">
                                        <?php
                                        echo 'USD '.$oVal['productBasePrice']*$oVal['productQuantity'];
                                        $gTotal += $oVal['productBasePrice']*$oVal['productQuantity'];
                                        ?>
                                    </td>                                
                                </tr>
                            <?php }
                           		$shipping_cost = $shippingDetails['shipping_cost'];
                            ?>                           
                            
                            <tr>
                                <td colspan="2">
                                	<strong>Shipping Cost</strong> </td>
                                <td colspan="2" class="text-right"><strong><?php 
                                echo 'USD ' . number_format($shipping_cost,2); ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Total Price</strong></td>
                                <td colspan="2" class="text-right">
                                    <strong><?php $tot = ($gTotal + $shipping_cost);echo 'USD ' .number_format($tot,2);?></strong></td>
                            </tr>
                            <?php if(!empty($discount)):?>
                            <tr>
                                <td colspan="2">
                                	<strong>Discount</strong> </td>
                                <td colspan="2" class="text-right"><strong><?php 
                                echo 'USD ' . number_format($discount,2); ?></strong>
                                </td>
                            </tr>
                            <?php endif;?>
                            <tr>
                                <td colspan="2"><strong>Grand total</strong></td>
                                <td colspan="2" class="text-right">
                                    <strong><?php $tot = ($gTotal + $shipping_cost - $discount);echo 'USD ' .number_format($tot,2);?></strong></td>
                            </tr>
                              <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} else { ?>
    <div class="row bar bar-primary bar-top">
        <div class="col-md-12">
            <h1 class="bar-title"><?php echo __('Order Invoice #' . $data['order_code']); ?></h1>
        </div>
    </div>

    <?php if ($page == 'view') { ?>
        <div class="row bar bar-secondary">
            <div class="col-md-12">
                <div class="dropdown pull-right">
                    <a aria-expanded="true" role="button" aria-haspopup="true" data-toggle="dropdown"
                       class="dropdown-toggle btn btn-info" href="#">
                        <i class='glyphicon glyphicon-download-alt'></i> Export As
                        <span class="caret"></span>
                    </a>
                    <ul role="menu" class="dropdown-menu">
                        <li role="presentation">
                            <?php echo $this->Form->postLink('PDF', array('action' => 'order_view', $data['id'], 'pdf', 'admin' => false), array('escape' => false, 'target' => '_blank')); ?>
                        </li>
                        <li role="presentation">
                            <?php echo $this->Form->postLink('Xls', array('action' => 'order_view', $data['id'], 'xls', 'admin' => false), array('escape' => false, 'target' => '_blank')); ?>
                        </li>
                        <li role="presentation">
                            <?php echo $this->Form->postLink('Doc', array('action' => 'order_view', $data['id'], 'doc', 'admin' => false), array('escape' => false, 'target' => '_blank')); ?>
                        </li>
                    </ul>
                </div>
                <?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Product Orders', array('action' => 'index', 'admin' => true), array('escape' => false, 'class' => 'btn btn-success')); ?>
                <?php //echo $this->Form->postLink('<i class=\'glyphicon glyphicon-refresh\'></i> Processing', array('action' => 'make_processing', $data['id'], 'admin' => true), array('escape' => false, 'class' => 'btn btn-warning'), __('Are you sure you want to update?')); ?>
                <?php //echo $this->Form->postLink('<i class=\'glyphicon glyphicon-ok\'></i> Completed', array('action' => 'make_completed', $data['id'], 'admin' => true), array('escape' => false, 'class' => 'btn btn-success'), __('Are you sure you want to update?')); ?>
                <?php //echo $this->Form->postLink('<i class=\'glyphicon glyphicon-remove\'></i> Cancelled', array('action' => 'make_cancelled', $data['id'], 'admin' => true), array('escape' => false, 'class' => 'btn btn-danger'), __('Are you sure you want to update?')); ?>
                <?php //echo $this->Html->link('<i class=\'glyphicon glyphicon-envelope\'></i> Send Email with attached', array('action' => '#', 'admin' => true), array(' data-toggle' => 'modal', 'data-target' => '#myModal', 'escape' => false, 'class' => 'btn btn-primary')); ?>
                <?php //echo $this->Html->link('<i class=\'glyphicon glyphicon-envelope\'></i> Send Automatic Email', array('controller' => 'sites', 'action' => 'sendCustomerOrderMail', $data['id'], true, 'admin' => false), array('escape' => false, 'class' => 'btn btn-primary')); ?>
            </div>
        </div>
    <?php } ?>
    <div class=" bg-white">
        <div class="col-md-12">
            <div class="row">
                <!-- Payment methods -->
                <div class="col-md-4">

                    <h3 class="payment-heading">Customer/Shipping Details</h3>
					<?php 
						$shippingDetails = json_decode($data['shipping_detail'],true);
						$orderDetails = $data['order_detail'];
						//pr($orderDetails);
						//$paymentDetails = 
					?>
                     <div>
                        <div><strong>Name
                                : </strong> <?php echo $shippingDetails['name']; ?>
                        </div>
                        <div><strong>Phone : </strong><?php echo $shippingDetails['phone']; ?></div>
                        <div>
                            <strong>Address line 1:</strong><?php echo $shippingDetails['address_line_1']; ?>
                        </div>   
                        <?php if(!empty($shippingDetails['address_line_2'])):?>
                         <div>
                            <strong>Address line 2:</strong><?php echo $shippingDetails['address_line_2']; ?>
                        </div>  
                        <?php endif;?>                     
                         <div><strong>City : </strong><?php echo $shippingDetails['city']; ?></div>
                        <div><strong>Division : </strong><?php echo $shippingDetails['division']; ?></div>

                         
                         <!-- 
                        <div><strong>Email : </strong><a
                                href="mailto:<?php //echo $data['client_detail']['email']; ?>"><?php echo $data['client_detail']['email']; ?></a>
                        </div>    
                         -->                   
                    </div>

                    <h3 class="payment-heading">Order Details</h3>
                    
                     <div class="payment-heading"><strong>Order Number
                            :</strong> <?php echo $data['id'];?></div>

                    <div class="payment-heading"><strong>Payment Type
                            :</strong> 
                            <?php if($shippingDetails['payment']['paymentMethod'] == 'cod'){
                            	echo 'Cash On Delivery';
                            }else { 
                            	echo 'Online';
                            }
                            ?>
                            </div>

                    <div class="payment-heading"><strong>Order Date :</strong> <?php echo date_format(date_create($data['order_date']),'d-m-Y h:i:s'); ?>
                    </div>
                    <div class="payment-heading"><strong>Payment Status
                            :</strong> <?php echo $data['payment_status']; ?>
                    </div>
                    <?php if (strtolower($data['payment_status']) == 'completed') { ?>
                        <div class="payment-heading" data-ng-show="completeDate"><strong>Complete Date
                                :</strong> <?php echo $data['complete_date']; ?></div>
                    <?php } ?>
                </div>

                <div class="col-md-8">
                    <div class="productSummery">
                        <h3 class="payment-heading">Product Summery</h3>
                         <table class="table table-theme-timeout">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Unit Price</th>
                                <th>Qty</th>                              
                                <th class="text-right">Sub Total</th>                              
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $gTotal = 0; $vat=0;                           
                            $orderDetails=$data['order_detail'];
                           // pr($orderDetails);
                             if(isset($orderDetails)){                          
                            foreach ($orderDetails['cart'] as $oKey => $oVal) { $unitType = '';
                            	if(isset($oVal['productUnit'])){
                            		$unitType = '(' . $oVal['productUnit'] .')';
                            	}
                            	
                            	$discount = 0;
                            	if(!empty($orderDetails['discount'])){
                            		$discount = $orderDetails['discount'];
                            	}
                            ?>
                                <tr>                                   
                                    <td> <?php  echo $oVal['productTitle'] . $unitType; ?> </td>
                                    <td><?php echo 'USD ' . $oVal['productBasePrice']; ?></td>
                                    <td><?php echo $oVal['productQuantity']; ?></td>
                                    <td class="text-right">
                                        <?php
                                        echo 'USD '.$oVal['productBasePrice']*$oVal['productQuantity'];
                                        $gTotal += $oVal['productBasePrice']*$oVal['productQuantity'];
                                        ?>
                                    </td>                                
                                </tr>
                            <?php }
                           		$shipping_cost = $shippingDetails['shipping_cost'];
                            ?>                           
                            
                            <tr>
                                <td colspan="2">
                                	<strong>Shipping Cost</strong> </td>
                                <td colspan="2" class="text-right"><strong><?php 
                                echo 'USD ' . number_format($shipping_cost,2); ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Total Price</strong></td>
                                <td colspan="2" class="text-right">
                                    <strong><?php $tot = ($gTotal + $shipping_cost);echo 'USD ' .number_format($tot,2);?></strong></td>
                            </tr>
                            <?php if(!empty($discount)):?>
                            <tr>
                                <td colspan="2">
                                	<strong>Discount</strong> </td>
                                <td colspan="2" class="text-right"><strong><?php 
                                echo 'USD ' . number_format($discount,2); ?></strong>
                                </td>
                            </tr>
                            <?php endif;?>
                            <tr>
                                <td colspan="2"><strong>Grand total</strong></td>
                                <td colspan="2" class="text-right">
                                    <strong><?php $tot = ($gTotal + $shipping_cost - $discount);echo 'USD ' .number_format($tot,2);?></strong></td>
                            </tr>
                              <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<?php if ($page == 'view') { ?>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php echo $this->Form->create('ProductOrder', array('action' => 'send_email', 'admin' => true, 'class' => 'form', 'type' => 'file')); ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Send Invoice
                        To <?php echo $data['client_detail']['vorname'] . ' ' . $data['client_detail']['nacname']; ?> </h4>
                </div>
                <div class="modal-body">
                    <?php
                    echo $this->Form->input('name', array('required' => true, 'value' => $data['client_detail']['vorname'] . ' ' . $data['client_detail']['nacname'], 'class' => 'form-control', 'div' => array('class' => 'form-group')));
                    echo $this->Form->input('to', array('required' => true, 'value' => $data['client_detail']['email'], 'class' => 'form-control', 'div' => array('class' => 'form-group')));
                    echo $this->Form->input('subject', array('required' => true, 'value' => 'Order Invoice', 'class' => 'form-control', 'div' => array('class' => 'form-group')));
                    echo $this->Form->input('message', array('type' => 'textarea', 'row' => 5, 'class' => 'form-control', 'div' => array('class' => 'form-group')));
                    echo $this->Form->input('attached', array('label' => 'Attached Your Invoice', 'type' => 'file', 'class' => '', 'div' => array('class' => '')));
                    ?>
                    <small class="text-warning">Note: Please upload your invoice here...</small>
                </div>
                <div class="modal-footer">
                    <?php
                    echo $this->Form->button('Close', array('type' => 'reset', 'data-dismiss' => 'modal', 'class' => 'btn btn-warning', 'label' => false, 'div' => false));
                    echo $this->Form->button('Submit', array('type' => 'submit', 'class' => 'btn btn-success btn-left-margin', 'label' => false, 'div' => false));
                    ?>
                </div>

                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
<?php } ?>
