<?php
/* all requested variable */

$clientDetailss = json_decode($data ['clientDetail'], true);
//$clientDetails = $clientDetailss['details'];
$orderDetails = json_decode($data['orderDetail'], true);
$shippingDetails = json_decode($data['shippingDetail'], true);
$paymentDetails = json_decode($data['paymentDetail'], true);
$SiteSetting = $data['SiteSetting'];
$orderDate = $data['orderDate'];
$orderId = $data['orderId'];

/* style (css)  part start */
$body = '	font-family: "Open Sans",sans-serif; font-size: 13px; line-height: 18px; box-sizing: border-box;';
$container = 'width: 970px; margin-left: auto;margin-right: auto; padding-left: 0px; padding-right: 0px;';
$table = 'border-collapse: collapse; border-spacing: 0; margin-bottom: 20px; max-width: 100%; width: 100%; border: 1px solid #ddd;';
$td = 'border: 1px solid #ddd;line-height: 1.42857;padding: 8px;vertical-align: top; color:#333333; font-size:13px;';
$th = 'border-bottom: 2px solid #ddd;vertical-align: bottom;';
$clear_both = 'clear:both;';
$row = ' margin-left: -15px;margin-right: -15px;';
$col_all = 'min-height: 1px;position: relative; float:left;';
$col_md_3 = 'width:33.3%';
$col_md_4 = 'width:25%;';
$col_md_6 = 'width:50%;';
$col_md_12 = 'width:100%';
$table_responsive = 'min-height: 0.01%;overflow-x: auto;';
$img_responsive = 'display: block;height: auto; max-width: 100%;';
$img_thumbnail = 'background-color: #fff; border: 1px solid #ddd;border-radius: 4px;display: inline-block; height: auto; line-height: 1.42857; max-width: 100%;padding: 4px;transition: all 0.2s ease-in-out 0s;';
$img_circle = 'border-radius: 50%;';
$hr = ' -moz-border-bottom-colors: none;-moz-border-left-colors: none;-moz-border-right-colors: none;-moz-border-top-colors: none;border-color: #ddd; -moz-use-text-color -moz-use-text-color;border-image: none; border-right: 0 none;border-style: solid none none;border-width: 1px 0 0;margin-bottom: 20px;margin-top: 20px;';
$sr_only = 'border: 0 none;clip: rect(0px, 0px, 0px, 0px);height: 1px;margin: -1px;overflow: hidden; padding: 0;position: absolute;width: 1px;';
$h_group = 'color: inherit;font-family: inherit;font-weight: bold;line-height: 1.1;margin-bottom: 10px;margin-top: 20px; padding-bottom:10px;color:#683982;';
$border_bottom = 'border-bottom:1px solid #ddd;';
$text_left = 'text-align: left;';
$text_right = 'text-align: right;';
$text_center = 'text-align: center;';
$text_justify = 'text-align: justify;';
$text_lowercase = 'text-transform: lowercase;';
$text_uppercase = 'text-transform: uppercase;';
$text_capitalize = 'text-transform: capitalize;';
$header_style = 'background-color:#ff000e; color:white; line-height:35px;font-size:12px;text-align:center;';
$btn = '-moz-user-select: none;background-image: none;border: 1px solid transparent;border-radius: 4px;cursor: pointer;display: inline-block;font-size: 14px;font-weight: 400;line-height: 1.42857;margin-bottom: 0;padding: 6px 12px;text-align: center;vertical-align: middle;white-space: nowrap;background-color:#ff000e; width:92%; color:white;';
$heading = ' border-bottom: 2px solid #d10101;
    font-family: "Raleway",sans-serif;
    font-size: 17px;
    line-height: 23px;
    margin: 10px 0;
    padding: 0 0 4px;
    text-transform: uppercase;color:#ff000e;';
/* style (css)  part end */
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Email Tamplete</title>
    </head>
<body style=' <?php echo $body; ?> '>
<section class="Client Part">
    <div style=' <?php echo $container; ?> '>
        <div style=' <?php echo $row; ?> '>
            <h1 style=' <?php echo $heading; ?> text-align:center;'>Thank you for completing order.</h1>

            <div style=' text-align:center; '><img style="margin-bottom:20px;" class="center-block img-responsive"
                                                   src="<?php echo ENGINE_URL;?>img/site/<?php echo $SiteSetting['id'] . '.png'; ?>"
                                                   alt="logo"></div>
            <table style=' <?php echo $table; ?> border:none;'>
                <tr>
                     
                    <td valign="top">
                        <table style=' <?php echo $table; ?> '>
                            <tbody>
                            <tr style=' <?php echo $header_style; ?> '>
                                <th colspan="2" style=' <?php echo $text_center; ?> '>Shipping Information</th>
                            </tr>
                            <tr>
                                <td style=' <?php echo $td; ?> '><strong>First Name</strong></td>
                                <td style=' <?php echo $td; ?> '><?php

                                    if (isset($shippingDetails['fname']) && !is_null($shippingDetails['fname'])) {
                                        echo $shippingDetails['fname'];
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td style=' <?php echo $td; ?> '><strong>Last Name</strong></td>
                                <td style=' <?php echo $td; ?> '><?php

                                    if (isset($shippingDetails['lname']) && !is_null($shippingDetails['lname'])) {
                                        echo $shippingDetails['lname'];
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td style=' <?php echo $td; ?> '><strong>Email</strong></td>
                                <td style=' <?php echo $td; ?> '><?php
                                        echo $clientDetailss['username'];
                                    ?></td>
                            </tr>
                            <tr>
                                <td style=' <?php echo $td; ?> '><strong>Phone</strong></td>
                                <td style=' <?php echo $td; ?> '> <?php

                                    if (isset($shippingDetails['phone']) && !is_null($shippingDetails['phone'])) {
                                        echo $shippingDetails['phone'];
                                    }

                                    ?></td>
                            </tr>
                            <tr>
                                <td style=' <?php echo $td; ?> '><strong>Address Line 1</strong></td>
                                <td style=' <?php echo $td; ?> '><?php
                                    if (isset($shippingDetails['address_line_1']) && !is_null($shippingDetails['address_line_1'])) {
                                        echo $shippingDetails['address_line_1'];
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td style=' <?php echo $td; ?> '><strong>Address Line 2</strong></td>
                                <td style=' <?php echo $td; ?> '><?php
                                    if (isset($shippingDetails['address_line_2']) && !is_null($shippingDetails['address_line_2'])) {
                                        echo $shippingDetails['address_line_2'];
                                    }
                                    ?></td>
                            </tr>
                            <!-- 
                            <tr>
                                <td style=' <?php //echo $td; ?> '><strong>City</strong></td>
                                <td style=' <?php //echo $td; ?> '> <?php

                                   // if (isset($shippingDetails['city']) && !is_null($shippingDetails['city'])) {
                                        //echo $shippingDetails['city'];
                                    //}

                                    ?></td>
                            </tr>
                             -->
                            <tr>
                                <td style=' <?php echo $td; ?> '><strong>City</strong></td>
                                <td style=' <?php echo $td; ?> '> <?php

                                    if (isset($shippingDetails['state']) && !is_null($shippingDetails['state'])) {
                                        echo $shippingDetails['state'];
                                    }

                                    ?></td>
                            </tr>
                            <tr>
                                <td style=' <?php echo $td; ?> '><strong>Country</strong></td>
                                <td style=' <?php echo $td; ?> '> <?php

                                    if (isset($shippingDetails['country']) && !is_null($shippingDetails['country'])) {
                                        echo $shippingDetails['country'];
                                    }

                                    ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td valign="top">

                        <table style=' <?php echo $table; ?> '>
                            <tbody>
                            <tr style=' <?php echo $header_style; ?> '>
                                <th colspan="2" style=' <?php echo $text_center; ?> '>Invoice</th>
                            </tr>
                            <tr>
                                <td style=' <?php echo $td; ?> '><strong>Invoice Number</strong></td>
                                <td style=' <?php echo $td; ?> '><?php echo $orderId; ?></td>
                            </tr>
                            <tr>
                                <td style=' <?php echo $td; ?> '><strong>Invoice Date</strong></td>
                                <td style=' <?php echo $td; ?> '><?php echo $orderDate; ?></td>
                            </tr>
                            <tr>
                                <td style=' <?php echo $td; ?> '><strong>Payment type</strong></td>
                                <td style=' <?php echo $td; ?> '>
                                	<?php 
                                		if($shippingDetails['paymentMethod'] == 'cod'){
                                			echo 'Cash On Delivery';
                                		}else{
                                			echo $paymentDetails['card_type'];
                                		}
                                		
                                	?>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
            <div style=' <?php echo $col_all . ' ' . $col_md_12; ?> '>
                <h3 style=' <?php echo $heading; ?>  '>Product Summery</h3>
                <div style=' <?php echo $table_responsive; ?> '>
                    <table style=' <?php echo $table; ?> '>
                            <tbody>
                            <tr style=' <?php echo $header_style; ?> '>
                                <th>SL</th>
                                <th>Product</th>
                                <th>Image</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Sub Total (USD)</th>
                            </tr>

                            <?php
                            $i = 1;
                            $subtotal = 0;
                            $shippingCost = 0;

                            if (isset($shippingDetails['shipping_cost']) && !is_null($shippingDetails['shipping_cost'])) {
                                $shippingCost = $shippingDetails['shipping_cost'];
                            }


                            foreach ($orderDetails['cart'] as $key => $value) {

                                $unitTotal = ($value['productQuantity'] * $value['productBasePrice']);
                                $subtotal += $unitTotal;
                                
                                $unitType = '';
                                if(isset($value['productUnit'])){
                                	$unitType = '(' . $value['productUnit'] .')';
                                }
                                
                                $discount = 0;
                                if(!empty($orderDetails['discount'])){
                                	$discount = $orderDetails['discount'];
                                }
                                
                                ?>
                                <tr>
                                    <td style='text-align:center;vertical-align: top;' ><?php echo $i; ?></td>
                                    <td style=' <?php echo $td; ?> width:35%;'>
                                        <?php
                                        echo $value['productTitle'] .  $unitType .'<br>';
                                          
                                        ?>

                                    </td>
									<td style=' <?php echo $td . '' . $text_center; ?> '><img
                                            style='<?php echo $img_thumbnail; ?>' width="80"
                                            src="<?php echo ENGINE_URL . $value['imgUrl']; ?>">
                                    </td>
                                    <td style=' <?php echo $td; ?> '><?php if ($value['productBasePrice']) echo $value['productBasePrice']; ?></td>
                                    <td style=' <?php echo $td; ?> '><?php if ($value['productQuantity']) echo $value['productQuantity']; ?></td>

                                    <td style=' <?php echo $text_right . '' . $td; ?> '>
                                        <strong><?php echo $unitTotal; ?></strong></td>
                                </tr>
                                <?php $i = $i + 1;
                            } ?>
                            <tr>
                                <td style=' <?php echo $text_right . '' . $td; ?> ' colspan="5"><strong>Total
                                        Amount</strong></td>
                                <td style=' <?php echo $text_right . '' . $td; ?> '>
                                    <strong><?php echo $subtotal; ?></strong></td>
                            </tr>
                            <tr>
                                 
                                 
                            </tr>
                            <tr>
                                <td style=' <?php echo $text_right . '' . $td; ?> ' colspan="5"><strong>Shipping
                                        Cost</strong></td>
                                <td style=' <?php echo $text_right . '' . $td; ?> '>
                                    <strong><?php echo $shippingCost; ?></strong></td>
                            </tr>
                             <?php if(!empty($discount)):?>
                              <tr>
                                <td style=' <?php echo $text_right . '' . $td; ?> ' colspan="5"><strong>Discount</strong></td>
                                <td style=' <?php echo $text_right . '' . $td; ?> '>
                                    <strong><?php echo $discount; ?></strong></td>
                            </tr>
                            <?php endif;?>
                            <tr style=' <?php echo $header_style; ?> '>
                                <th style=' <?php echo $text_right; ?> ' colspan="5"><strong>Grand Total</strong></th>
                                <th style=' <?php echo $text_right; ?> '>
                                    <strong>(USD) <?php echo($subtotal + $shippingCost - $discount); ?></strong></th>
                            </tr>
                            </tbody>
                        </table>
                </div>

                <div style=' <?php echo $col_md_6; ?> '>
                    <p><strong style="border-top:2px dashed #333;"> Sincerely yours </strong><br>
                        <?php echo SITENAME;?> TEAM<br>
                        Email : <?php echo $SiteSetting['site_author_email']; ?> <br>
                        Phone : <?php echo $SiteSetting['phones']; ?><br>
                        Address : <?php echo $SiteSetting['company_address']; ?>
                </div>
            </div>
            </div>
            </div>
</section>
<?php //exit();?>
