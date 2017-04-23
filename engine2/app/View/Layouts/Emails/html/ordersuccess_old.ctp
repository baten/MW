<?php 
/* all requested variable */
$clientDetailss = json_decode(json_decode($data ['clientDetail'],true),true);
$clientDetails=json_decode($clientDetailss['Client']['details'],true);
$orderDetails=json_decode($data['orderDetail'],true);
$shippingDetails=json_decode($data['shippingDetail'],true);
$paymentDetails=json_decode($data['paymentDetail'],true);
$SiteSetting =  $data['SiteSetting'];
$merchant =  $data['merchant'];
$orderDate =  $data['orderDate'];

/* style (css)  part start */
$body='	font-family: "Open Sans",sans-serif; font-size: 13px; line-height: 18px; box-sizing: border-box;';
$container='width: 1050px; margin-left: auto;margin-right: auto; padding-left: 0px; padding-right: 0px;';
$table='border-collapse: collapse; border-spacing: 0; margin-bottom: 20px; max-width: 100%; width: 100%; border: 1px solid #ddd;';
$td='border: 1px solid #ddd;line-height: 1.42857;padding: 8px;vertical-align: top; color:#333333; font-size:13px;';
$th='border-bottom: 2px solid #ddd;vertical-align: bottom;';
$clear_both='clear:both;';
$row=' margin-left: -15px;margin-right: -15px;';
$col_all='min-height: 1px;position: relative; float:left;';	
$col_md_3='width:33.3%';
$col_md_4='width:25%;';	
$col_md_6='width:50%;';	
$col_md_12='width:100%';	
$table_responsive='min-height: 0.01%;overflow-x: auto;';	
$img_responsive='display: block;height: auto; max-width: 100%;';
$img_thumbnail='background-color: #fff; border: 1px solid #ddd;border-radius: 4px;display: inline-block; height: auto; line-height: 1.42857; max-width: 100%;padding: 4px;transition: all 0.2s ease-in-out 0s;';
$img_circle='border-radius: 50%;';
$hr=' -moz-border-bottom-colors: none;-moz-border-left-colors: none;-moz-border-right-colors: none;-moz-border-top-colors: none;border-color: #ddd; -moz-use-text-color -moz-use-text-color;border-image: none; border-right: 0 none;border-style: solid none none;border-width: 1px 0 0;margin-bottom: 20px;margin-top: 20px;';
$sr_only='border: 0 none;clip: rect(0px, 0px, 0px, 0px);height: 1px;margin: -1px;overflow: hidden; padding: 0;position: absolute;width: 1px;';
$h_group='color: inherit;font-family: inherit;font-weight: bold;line-height: 1.1;margin-bottom: 10px;margin-top: 20px; padding-bottom:10px;color:#683982;';
$border_bottom='border-bottom:1px solid #ddd;';
$text_left='text-align: left;';
$text_right='text-align: right;';
$text_center='text-align: center;';
$text_justify='text-align: justify;';
$text_lowercase='text-transform: lowercase;';
$text_uppercase='text-transform: uppercase;';
$text_capitalize='text-transform: capitalize;';
$header_style='background-color:#EA6153; color:white; line-height:35px;text-align:center;';
$btn='-moz-user-select: none;background-image: none;border: 1px solid transparent;border-radius: 4px;cursor: pointer;display: inline-block;font-size: 14px;font-weight: 400;line-height: 1.42857;margin-bottom: 0;padding: 6px 12px;text-align: center;vertical-align: middle;white-space: nowrap;background-color:#EA6153; width:92%; color:white;';
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
<body style=' <?php echo $body;?> '>
<section class="Client Part">
  <div style=' <?php echo $container;?> '> 
  <div style=' <?php echo $row;?> '>  
  <h1 style=' <?php echo $h_group.$border_bottom;?> '>Thank you for completing order.</h1>
    <div style=' <?php echo $col_all.' '. $col_md_4;?> '> <img style="margin-bottom:20px;" class="center-block img-responsive" src="https://www.nrbbuysell.com/engine/img/site/<?php echo $SiteSetting['id'].'.png';?>" alt="logo"> </div>
  <table style=' <?php echo $table;?> border:none;'>
       <tr>
        <td  valign="top">
          <table style=' <?php echo $table;?> '>
            <tbody>
              <tr style=' <?php echo $header_style;?> '>
                <th colspan="2" style=' <?php echo $text_center;?> '>Personal Information</th>
              </tr>
              <tr>
                <td style=' <?php echo $td;?> '><strong>Name:</strong></td>
                <td style=' <?php echo $td;?> '><?php echo $clientDetails['first_name']." ".$clientDetails['last_name'];?></td>
              </tr>
              <tr>
                <td style=' <?php echo $td;?> '><strong>Cell:</strong></td>
                <td style=' <?php echo $td;?> '> <?php echo $clientDetails['cell'];?></td>
              </tr>
              <tr>
                <td style=' <?php echo $td;?> '><strong>Email:</strong></td>
                <td style=' <?php echo $td;?> '><?php echo $clientDetailss['Client']['username'];?></td>
              </tr>
              <tr>
                <td style=' <?php echo $td;?> '><strong>Address:</strong></td>
                <td style=' <?php echo $td;?> '><?php echo $clientDetails['address_line_1']."<br>".$clientDetails['address_line_2']."<br>Zip Code:".$clientDetails['zip'];?></td>
              </tr>
            </tbody>
          </table>
    </td>
    <td  valign="top">
          <table style=' <?php echo $table;?> '>
            <tbody>
              <tr style=' <?php echo $header_style;?> '>
                <th colspan="2" style=' <?php echo $text_center;?> '>Shipping Information</th>
              </tr>             
              <tr>
                <td style=' <?php echo $td;?> '><strong>Address:</strong></td>
                <td style=' <?php echo $td;?> '>
                <?php echo $shippingDetails['shipAddress1']."<br>".$shippingDetails['shipAddress2'].'<br> Zip Code : '.$shippingDetails ['zip']; ?></td>
              </tr>
            </tbody>
          </table>
</td>
<td  valign="top">
          <table style=' <?php echo $table;?> '>
            <tbody>
             <tr style=' <?php echo $header_style;?> '>
                <th colspan="2" style=' <?php echo $text_center;?> '>Invoice</th>
              </tr> 
              <tr>
                <td style=' <?php echo $td;?> '><strong>Invoice Number:</strong></td>
                <td style=' <?php echo $td;?> '><?php echo $paymentDetails['tran_id'];?></td>
              </tr>
              <tr>
                <td style=' <?php echo $td;?> '><strong>Invoice Date:</strong></td>
                <td style=' <?php echo $td;?> '><?php echo $orderDate;?></td>
              </tr>
            </tbody>
          </table>
  		</td>
	</tr>
</table>
    <div style=' <?php echo $col_all.' '. $col_md_12;?> '>
      <h3 style=' <?php echo $h_group;?> '>Product details : </h3>
      <div style=' <?php echo $table_responsive;?> '>
        <table style=' <?php echo $table;?> '>
          <tbody>

            <tr style=' <?php echo $header_style;?> '>
              <th>SL</th>
              <th>Product </th>
              <th>Merchant</th>
              <th>Image</th>
              <th>Quantity</th>
              <th>Unit Price(BDT)</th>      
              <th>Amount (BDT)</th>
            </tr>

            <?php 
            $i=1;
            $subtotal=0;
            $totalDiscounts=0;
            $totalWeight=0;
            $shippingCost=$shippingDetails[0]['shipping_cost'];

           foreach ($orderDetails as $key => $value) {
			$subtotal+=$value['cost'];
			$totalDiscounts+=$value['totalDiscount'];
			$totalWeight+=$value['weight'];
            	?>
            <tr>
              <td><?php echo $i;?></td>
              <td style=' <?php echo $td;?> '>
              <?php
              	echo 'Id : '.$value['product_id'].'<br>';
				echo 'Product Title : '.$value['product_title'].'<br>';
				echo 'All Products attributes Are : <br>';			
				foreach($value['attributes'] as $ke=>$attr){
					echo $ke .'='. $attr.',';

				}
			?>

              </td>
               <td style=' <?php echo $td;?> '><?php echo $value['merchantName']; ?></td>
              <td style=' <?php echo $td.''.$text_center;?> '><img <?php echo $img_thumbnail;?> width="80" src="<?php echo $value['cartThumbImage'];?>"></td>
              <td style=' <?php echo $td;?> '><?php echo $value['quantity']; ?></td>
              <td style=' <?php echo $td;?> '><?php echo $value['unitPrice']; ?></td>            
              <td style=' <?php echo $td;?> '><strong><?php echo $value['cost']; ?></strong></td>
            </tr>
<?php $i=$i+1; }?>
            <tr>
              <td style=' <?php echo $text_right.''.$td;?> ' colspan="6"><strong>Subtotal</strong></td>
              <td style=' <?php echo $td;?> '><strong><?php echo $subtotal;?></strong></td>
            </tr>  
            <tr>
              <td style=' <?php echo $text_right.''.$td;?> ' colspan="6"><strong>Total Discount</strong></td>
              <td style=' <?php echo $td;?> '><strong><?php echo $totalDiscounts; ?></strong></td>
            </tr>          
            <tr>
              <td style=' <?php echo $text_right.''.$td;?> ' colspan="6"><strong>Shipping Cost</strong></td>
              <td style=' <?php echo $td;?> '><strong><?php echo $shippingCost; ?></strong></td>
            </tr>
            <tr>
              <td style=' <?php echo $text_right.''.$td;?> ' colspan="6"><strong>Total Weight</strong></td>
              <td style=' <?php echo $td;?> '><strong><?php echo $totalWeight;?>gm.</strong></td>
            </tr>
            <tr>
              <td style=' <?php echo $text_right.''.$td;?> ' colspan="6"><strong>Grand Total</strong></td>
              <td style=' <?php echo $td;?> '><strong><?php echo ($subtotal+$shippingCost)-$totalDiscounts; ?></strong></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    
     <div style=' <?php echo $col_md_6;?> '>     
        <p><strong style="border-top:2px dashed #333;"> Sincerely yours </strong><br>
NRB BUYSELL TEAM<br>
Email : <?php echo $SiteSetting['site_author_email']; ?> <br>
Tel : <?php echo $SiteSetting['telephone']; ?> <br>
Phone : <?php echo $SiteSetting['phones']; ?><br>
Fax : <?php echo $SiteSetting['faxes']; ?><br>
Skype : <?php echo $SiteSetting['skypeId']; ?><br>
Address : <?php echo $SiteSetting['company_address']; ?>        
        </div>
  </div>  
</section>