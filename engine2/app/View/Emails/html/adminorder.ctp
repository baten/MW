Dear Admin,
<p>
You have a new order.
</p>
<p>
Order code: <?php echo $data['order']['ProductOrder']['order_code']; ?><br/>
Customer Name: <?php echo $data['clientDetails']->first_name.' '.$data['clientDetails']->last_name; ?>, <br>
Address: <?php echo $data['clientDetails']->addressLine1; ?>, <br>
Cell: <?php echo $data['clientDetails']->cell; ?>, <br>
Email: <?php echo $data['clientDetails']->username; ?>, <br>
Username: <?php echo $data['clientDetails']->username; ?>, <br>
</p>

<p>
    <a target="_blank" href="http://checknpick.com/engine/admin/ecommerce/product_orders/order_view/<?php echo $data['order']['ProductOrder']['id']; ?>">Click here for view order details</a>
</p>

<br/><br/>
Thanks,<br/>
<?php echo $data['from_name']; ?><br/>
