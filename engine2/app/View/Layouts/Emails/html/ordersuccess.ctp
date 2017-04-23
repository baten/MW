<?php 
/* all requested variable */
$clientDetailss = json_decode($data['ProductOrder']['client_detail'],true);
$orderDetails =json_decode($data['ProductOrder']['order_detail'],true);
?>

{"vorname":"first Name","nacname":"Last Name","starbe":"","postcode":"4312","phone":"","email":"abcd@gmail.com","firma":"","etage":""}

Hi, <?php echo $clientDetailss['vorname'].' '.$clientDetailss['nacname'];?>,

You have created a succesfull order,
Your Order no. <?php echo $data['ProductOrder']['order_code']?>,
Dalivery date and Time <?php echo $orderDetails['dates'].' '.$orderDetails['times']?>
