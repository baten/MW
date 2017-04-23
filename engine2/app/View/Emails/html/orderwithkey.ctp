

Dear <?php echo $data['clientDetails']->first_name.' '.$data['clientDetails']->last_name; ?>, <br>
<p>
Thanks for choosing us to serve you. We feel immense pleasure to have you with CheckNPick Family.
This is a payment receipt for your Order Invoice #<?php echo $data['order']['ProductOrder']['order_code']; ?>  sent on <?php echo $data['order']['ProductOrder']['order_date']; ?> .
</p>

<?php if(is_array($data['product_keys']) and !empty($data['product_keys'])){ ?>


    <div class="productSummery mr-bottom-15">
        <table border="1">

            <tr>
                <th>Product</th>
                <th>Product Code</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th>Discount</th>
                <th>Sub Total</th>
                <th>Product Key</th>
            </tr>

    <?php $grandTotal = 0; if(is_array($data['orderdetails']) and !empty($data['orderdetails'])){
        foreach($data['orderdetails'] as $key=>$val){
            ?>
            <tr>
                <td>
                    <strong><?php echo $val->product_title; ?></strong>
                    <?php
                        $newVal = (array) $val->attributes;

                        foreach($newVal as $keyAttr => $valAttr) {
                            echo '<div>'.$keyAttr.': '.$valAttr.'</div>';
                        }
                    ?>
                </td>
                <td><strong><?php echo $val->productCode; ?></strong></td>
                <td><?php echo 'TK'. $val->unitPrice; ?></td>
                <td><?php echo $val->quantity; ?></td>
                <td><?php echo 'TK '.($val->discount['2']->finalDiscount * $val->quantity); ?></td>
                <td>
                    <?php
                        $cost = ($val->cost - ($val->discount['2']->finalDiscount * $val->quantity));
                        $grandTotal += $cost;
                        echo 'TK '.$cost;
                    ?>
                </td>
                <td>
                <?php
                $attribute_id = $val->productKeyAttributesData->attribute_id;
                $attribute_value_id = $val->productKeyAttributesData->attribute_value_id;

                $newProductKeyIndex = $val->product_id.'~'.$attribute_id.'~'.$attribute_value_id;

                if(isset($data['product_keys'][$newProductKeyIndex]) and !empty($data['product_keys'][$newProductKeyIndex])){

                    foreach($data['product_keys'][$newProductKeyIndex] as $keyval){
                    ?>
                    <div style="padding: 5px; border: 1px solid #ddd;border-radius: 3px; float: left;margin-right: 5px;">
                        <?php echo $keyval; ?>
                    </div>
                    <?php }} ?>
                </td>
            </tr>
        <?php }} ?>
                <tr>
                    <td colspan="5" style="text-align: right;"><strong>Grand Total</strong></td>
                    <td colspan="1" class="text-center"><strong><?php echo 'TK '.$grandTotal; ?></strong></td>
                    <td colspan="2"></td>
                </tr>

        </table>
    </div>


<?php }else{ ?>

    <div class="productSummery mr-bottom-15">
        <table border="1">

            <tr>
                <th>Product</th>
                <th>Product Code</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th>Discount</th>
                <th>Sub Total</th>
                <th>Product Key</th>
            </tr>

            <?php $grandTotal = 0; if(is_array($data['orderdetails']) and !empty($data['orderdetails'])){
                foreach($data['orderdetails'] as $key=>$val){
                    ?>
                    <tr>
                        <td>
                            <strong><?php echo $val->product_title; ?></strong>
                            <?php
                            $newVal = (array) $val->attributes;

                            foreach($newVal as $keyAttr => $valAttr) {
                                echo '<div>'.$keyAttr.': '.$valAttr.'</div>';
                            }
                            ?>
                        </td>
                        <td><strong><?php echo $val->productCode; ?></strong></td>
                        <td><?php echo 'TK'. $val->unitPrice; ?></td>
                        <td><?php echo $val->quantity; ?></td>
                        <td><?php echo 'TK '.($val->discount['2']->finalDiscount * $val->quantity); ?></td>
                        <td>
                            <?php
                            $cost = ($val->cost - ($val->discount['2']->finalDiscount * $val->quantity));
                            $grandTotal += $cost;
                            echo 'TK '.$cost;
                            ?>
                        </td>
                        <td></td>
                    </tr>
                <?php }} ?>
            <tr>
                <td colspan="5" style="text-align: right;"><strong>Grand Total</strong></td>
                <td colspan="1" class="text-center"><strong><?php echo 'TK '.$grandTotal; ?></strong></td>
                <td colspan="2"></td>
            </tr>

        </table>
    </div>

<h3>Our Checknpick support team will contact with you soon.</h3>
<?php } ?>
<p>
    <a target="_blank" href="http://checknpick.com/#/shop/order_view/<?php echo $data['order']['ProductOrder']['id']; ?>">Click here for view order details</a>
</p>

<br/><br/>
Thanks,<br/>
<?php echo $data['from_name']; ?><br/>
