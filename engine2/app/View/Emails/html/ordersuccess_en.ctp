
<?php 
/* all requested variable */
$clientDetailss = json_decode($data['ProductOrder']['client_detail'],true);
$orderDetails =json_decode($data['ProductOrder']['order_detail'],true);
?>
  <table width="100%" bgcolor="#f5f5f5" border="0" cellpadding="0" cellspacing="0" style="padding: 15px;">         
            <tr>
                <td><p style="font-size:14px;font-weight:bold;margin-top:50px;"> Dear Customer,</p></td>
            </tr>
            <tr>
                <td><p style="font-size:12px;font-weight:bold;"> THIS IS AN AUTOMATICALLY GENERATED EMAIL. PLEASE DO NOT REPLY.</p>
                    <p style="font-size:18px;border-bottom:2px solid #444444;padding-bottom:50px;"> Thank you for your order at THAI ATRIUM. This email is your order confirmation.</p></td>
            </tr>
            <tr>
                <td>
                    <p style="font-weight:bold;">Order number: <?php echo $data['ProductOrder']['order_code']?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-weight:bold;margin-bottom:5px;">Order Details:</p>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-width:0;">
                      <thead  bgcolor="#eeeeee" align="center">
                          <tr>
                              <td>Menu Number</td>
                              <td>Menu Name</td>
                              <td>Quantity</td>
                              <td>Price (in Euro)</td>
                              <th>Sub Total</th> 
                          </tr>
                      </thead>
                      <tbody align="center">
                      <?php 
                      		$gTotal=0;$vat=0;
                      		foreach ($orderDetails['Product'] as $oKey => $oVal) { ?>
                                <tr>                                   
                                    <td><?php echo $oVal['product_code']; ?></td>
                                    <td><?php echo $oVal['id']; ?></td>
                                    <td><?php echo $oVal['qty']; ?></td>
                                    <td><?php echo '€' . $oVal['price']; ?></td>
                                    <td class="text-right">
                                        <?php
                                        echo '€'.$oVal['price']*$oVal['qty'];
                                        $gTotal += $oVal['price']*$oVal['qty'];
                                        $vat += ($oVal['price']-($oVal['price']/(1+($oVal['vat']/100))))*$oVal['qty'];
                                        ?>
                                    </td>                                
                                </tr>
                            <?php }
                            
                    if($orderDetails['type']=='prebook'){
                      $vat=$gTotal-($gTotal/(1+0.19));
                    }    							
    							$priceIncludeTax=number_format($gTotal,2);
                            ?>                         
                          <tr>
                          	  <td style="border-width:0;"></td>
                              <td style="border-width:0;"></td>
                              <td style="border-width:0;"></td>
                              <td style="border-width:0;"><P style="margin:0; font-size:12px;font-weight:bold;">VAT</P></td>
                              <td style="border-width:0;"><?php echo number_format($vat,2);?></td>
                          </tr>
                          <tr>
                              <td style="border-width:0;"></td>
                              <td style="border-width:0;"></td>
                              <td style="border-width:0;"></td>
                              <td style="border-width:0;"><P style="margin:0;font-size:13px;font-weight:bold;">Total Price<br><span style="font-size:10px;color:#555555;">(including VAT)</span></P></td>
                              <td style="border-width:0;"><?php echo $priceIncludeTax;?></td>
                          </tr>
                      </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <p> <span style="font-weight:bold;">Special Message:</span>
                    <?php 
                    if(isset($data['ProductOrder']['note'])){echo $data['ProductOrder']['note'];}
                    ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> <span style="font-weight:bold;">Payment Method:</span>
                    <?php 
                    if($data['ProductOrder']['payment_detail']=='cash_on_delivery'){
                    		echo 'Cash On Delivery';
                		}else{
                    		echo 'PayPal/Credit Card';
                    	}
                    	?>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> <span style="font-weight:bold;">Pick Up Date & Time:</span> 
                    <?php echo $orderDetails['dates'].' '.$orderDetails['times'];?>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <P style="border-bottom:2px solid #444444;padding-bottom:20px;">
                       <span style="font-weight:bold;">Address:</span><br> <?php echo $clientDetailss['vorname'].' '.$clientDetailss['nacname'];?><br><?php echo $clientDetailss['starbe'];?><br><?php echo $clientDetailss['postcode'];?><br><?php echo $clientDetailss['firma'];?>
                    </P>
                </td>
            </tr>                
                <tr>
                    <td style="border-top:1px dashed #444444;border-bottom:1px dashed #444444;">
                        <P style="font-size:16px; font-weight:bold;">Important information:</P>
                        <P>Payment:<br>Please note that this is not a document that can be used for tax matters. Thank you for shopping at THAI ATRIUM. By commissioning Braintree to process your transaction you agree to the privacy policy of <a href="https://www.braintreepayments.com/legal" target="_blank" style="color:#004c26;">Braintree.</a></P>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="font-size:14px;font-weight:bold; color:#555555;">For any questions please contract <a href="http://thai-atrium.de/#contract" target="_blank" style="color:#004c26;">Thai Atrium</a>.</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <P><span style="font-weight:bold;">Best regards,<br>Your THAI ATRIUM Team</span><br>Briennerstr. 10,  D-80333 Munich</P>
                    </td>
                </tr>
            
        </table>
