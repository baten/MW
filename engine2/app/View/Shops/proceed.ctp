 <?php
   date_default_timezone_set("Asia/Dhaka"); 
  $years = array();             
    for($i = 1; $i < 11; $i++) {                  
      $next_day_epoch = mktime(0, 0, 0,0,0,date("Y")+$i);   
      $years[date("Y", $next_day_epoch)]= date("Y", $next_day_epoch); 
    } 

    $months=array();
    for($i = 0; $i < 12; $i++) {
      $months[$i+1]= $i+1; 
    } 

?>

  <!-- contents End-->
  <?php 
    $update_cart_summary_title = $this->requestAction("/shops/update_cart_summary_title"); 
    $tocartquery = $this->requestAction("/shops/top_cart_query"); 
    //pr($update_cart_summary_title);
    if(!empty($update_cart_summary_title['total_qty'])):
        $quantity=$update_cart_summary_title["total_qty"];
        $disabled='false';
    else:
        $quantity= 0;
        $disabled='true';
    endif; 
    $gTotal=$update_cart_summary_title["total_price"];   
    $priceIncludeTax=number_format($gTotal,2);
  ?>
 <?php  echo $this->Form->create('Client', array('class' => 'ac-custom ac-checkbox ac-fill','id'=>'proceed')); ?>  
      <div class="row">
        <div class="col-md-12">
            <?php 
              echo $this->Form->input('vorname',array('type'=>'hidden','label'=>false,'div'=>false));
              echo $this->Form->input('nacname',array('type'=>'hidden','label'=>false,'div'=>false));
              echo $this->Form->input('starbe',array('type'=>'hidden','label'=>false,'div'=>false));
              echo $this->Form->input('postcode',array('type'=>'hidden','label'=>false,'div'=>false));
              echo $this->Form->input('phone',array('type'=>'hidden','label'=>false,'div'=>false));
              echo $this->Form->input('email',array('type'=>'hidden','label'=>false,'div'=>false));
              echo $this->Form->input('firma',array('type'=>'hidden','label'=>false,'div'=>false));
              echo $this->Form->input('etage',array('type'=>'hidden','label'=>false,'div'=>false));
              echo $this->Form->input('OrderNote.message',array('type'=>'hidden','label'=>false,'div'=>false));
              echo $this->Form->input('Order.type',array('type'=>'hidden','label'=>false,'div'=>false));
              echo $this->Form->input('Order.dates',array('type'=>'hidden','label'=>false,'div'=>false));
              echo $this->Form->input('Order.times',array('type'=>'hidden','label'=>false,'div'=>false));
              echo $this->Form->input('Card.nonce',array('type'=>'hidden','id'=>'paypal','label'=>false,'div'=>false));              
            ?>
      <!-- Cart Start-->      
        <?php foreach ($tocartquery as  $key=>$ele): ?>
          <div>
              <input type="hidden" name="data[Order][Product][<?php echo $key;?>][id]" value="<?php echo $ele['Product']['title'];?>">
              <input type="hidden" name="data[Order][Product][<?php echo $key;?>][product_code]" value="<?php echo $ele['Product']['product_code'];?>">
               <input type="hidden" name="data[Order][Product][<?php echo $key;?>][vat]" value="<?php echo $ele['Product']['vat'];?>">             
              <input type="hidden" name="data[Order][Product][<?php echo $key;?>][qty]"  value="<?php echo $ele['Basket']['total_quantity'];?>"> 
             <input type="hidden" name="data[Order][Product][<?php echo $key;?>][price]" value="<?php echo $ele['Basket']['productPrice'];?>">
          </div>
       <?php endforeach; ?>        
       <?php       
        echo $this->Form->input('Order.total_price',array('type'=>'hidden','label'=>false,'div'=>false,'value'=>$gTotal)); ?>              
    </div>   
</div>

 <div class="row">
  <div class="col-md-8 col-md-offset-2">
    <?php if(isset($errors)){?>
      <div class="alert alert-danger t-center"> 
         <?php foreach($errors AS $error) {
            echo $error->code . ": " . $error->message . "<br>";
        }?>
      </div>  
    <?php }?>
  
  <div id="payment-method-container" style="padding: 10px 100px; border:1px solid #eee; "> 
      <div id="payment-paypal-container"  style="text-align: center;"></div>
      <p style="text-align: center; margin:10px 0; text-tr">OR</p>
      <div class="row" id="payment-card-container">
        <div class="col-md-12"><img style="width:30px; margin-bottom: 20px;" src="<?php echo $this->webroot;?>img/shops/visa.png" alt="visa"><img style="width:30px; margin-bottom: 20px;" src="<?php echo $this->webroot;?>img/shops/master.png" alt="mastercard"></div>                         
         <?php echo $this->Form->input('Card.number',array('type'=>'number','class'=>'form-control','data-braintree-name'=>'number','placeholder'=>'Card Number','label'=>false,'div'=>array('class'=>'col-xs-12 col-sm-12')));?>                         
         <?php echo $this->Form->input('Card.month',array('type'=>'select','options' => $months, 'class'=>'form-control','data-braintree-name'=>'expiration_month','label'=>false,'div'=>array('class'=>'col-xs-12 col-sm-3')));?>
       <?php echo $this->Form->input('Card.year',array('type'=>'select','options' => $years, 'class'=>'form-control','data-braintree-name'=>'expiration_year','label'=>false,'div'=>array('class'=>'col-xs-12 col-sm-3')));?>
        <?php echo $this->Form->input('Card.cvv',array('type'=>'password','pattern'=>'[0-9]{1,3}', 'class'=>'form-control','data-braintree-name'=>'cvv','placeholder'=>'CVV','label'=>false,'div'=>array('class'=>'col-xs-12 col-sm-6')));?> 
      </div>
      <div class="paypal-btn">
        <?php  echo $this->Form->button('Confirm', array('type' => 'submit','disabled'=>$disabled,'class' => 'btn', 'label' => false,'div'=>false));?>
        <?php  echo $this->Html->link('Cancel',
              array('controller' => 'shops','action' => 'checkout'),
              array('class' => 'btn btny', 'label' => false,'div'=>false)
            );      
          ?>
        </div>
    </div>  
    </div>    
  </div> 
<?php echo $this->Form->end();?>
<?php //echo $clientToken;?>
<script src="https://js.braintreegateway.com/js/braintree-2.22.1.min.js"></script>
<script>
// We generated a client token for you so you can test out this code
// immediately. In a production-ready integration, you will need to
// generate a client token on your server (see section below).
var clientToken = "<?php echo $clientToken;?>";
/*braintree.setup(clientToken, "dropin", {
  container: "payment-form"
});
*/

braintree.setup(clientToken, "custom", {
  paypal: {
    container: "payment-paypal-container",
    singleUse: true, // Required
    amount: <?php echo (float)$priceIncludeTax;?>, // Required
    currency: 'USD', // Required
    locale: 'en_us',
    enableShippingAddress: false,
    // shippingAddressOverride: {
    //   recipientName: 'Scruff McGruff',
    //   streetAddress: '1234 Main St.',
    //   extendedAddress: 'Unit 1',
    //   locality: 'Chicago',
    //   countryCodeAlpha2: 'US',
    //   postalCode: '60652',
    //   region: 'IL',
    //   phone: '123.456.7890',
    //   editable: false
    // }
  },
  onPaymentMethodReceived: function (obj) {
    document.getElementById('paypal').value=obj.nonce;
      //console.log(obj.nonce);
  }
});
braintree.setup(clientToken, "custom", {id: "proceed"});

</script>

<?php echo $this->start('script');?>
<script>
  $('#payment-paypal-container').on('click','#bt-pp-cancel',function(){  
    document.getElementById('paypal').value='';
  });
  
</script>
<?php echo $this->end();?>