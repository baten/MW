 <?php
   date_default_timezone_set("Asia/Dhaka");
    $dates = array();             
    for($i = 0; $i < 10; $i++) {                  
      $next_day_epoch = mktime(0, 0, 0, date("m"),date("d") + $i,date("Y"));   
      $dates[date("Y-m-d", $next_day_epoch)]= date("D d.m.Y", $next_day_epoch); 
    } 
   $times=array();
   $curtimes=mktime(date('H'),date('i')+30,0,0,0,0); 
    for($i = 0; $i < 25; $i++) {                  
      $next_day_epoch = mktime(date('11'),date('30')+(30*$i),0,0,0,0);      
      /*if($curtimes<$next_day_epoch){
        $times[date("H:i", $next_day_epoch)]= date("H:i", $next_day_epoch);
      }*/
      $times[date("H:i", $next_day_epoch)]= date("H:i", $next_day_epoch);
    }  

?>

  <!-- contents End-->
  <?php 
    $update_cart_summary_title = $this->requestAction("/shops/update_cart_summary_title"); 
    $tocartquery = $this->requestAction("/shops/top_cart_query"); 
    //pr( $tocartquery);
    //pr($update_cart_summary_title);
    if(!empty($update_cart_summary_title['total_qty'])):
        $quantity=$update_cart_summary_title["total_qty"];
        $disabled='false';
    else:
        $quantity= 0;
        $disabled='true';
    endif;     
  ?>

<!--===| Food Menu Start|===-->
<section class="menu-ecom-wrapper section-padding">
  <div class="container">
    <div class="row">   
      <!-- contents Start-->
      <!-- contents Start-->
      <?php  echo $this->Form->create('Client', array('class' => 'ac-custom ac-checkbox ac-fill','id'=>'checkout')); ?> 
      <div class="col-xs-12 col-sm-8">
        <div class="ecom-checkout">
          <div class="heading">
            <h3>Address</h3>
          </div>
               
            <div class="row">

            <?php 
              echo $this->Form->input('vorname',array('class'=>'form-control','placeholder'=>'First name *','label'=>false,'required'=>true,'div'=>array('class'=>'col-xs-12 col-sm-6')));
              echo $this->Form->input('nacname',array('class'=>'form-control','placeholder'=>'Last name *','label'=>false,'required'=>true,'div'=>array('class'=>'col-xs-12 col-sm-6')));
              echo $this->Form->input('starbe',array('class'=>'form-control','placeholder'=>'Street and House No. *','label'=>false,'required'=>true,'div'=>array('class'=>'col-xs-12 col-sm-6')));
              echo $this->Form->input('postcode',array('class'=>'form-control','placeholder'=>'Post Code *','label'=>false,'required'=>true,'div'=>array('class'=>'col-xs-12 col-sm-6')));
              echo $this->Form->input('phone',array('class'=>'form-control','placeholder'=>'Telephone *','label'=>false,'required'=>true,'div'=>array('class'=>'col-xs-12 col-sm-6')));
              echo $this->Form->input('email',array(/*'onblur'=>"usernameCheck(this)",*/'data-action'=>$this->webroot.'ajaxs/checkuserName','class'=>'form-control','placeholder'=>'e-mail *','label'=>false,'required'=>true,'after'=>'<span id="errorShow"> </span>','div'=>array('class'=>'col-xs-12 col-sm-6')));
              echo $this->Form->input('firma',array('class'=>'form-control','placeholder'=>'Company (optional) ','label'=>false,'div'=>array('class'=>'col-xs-12 col-sm-6')));
              echo $this->Form->input('etage',array('class'=>'form-control','placeholder'=>'Floor (optional) ','label'=>false,'div'=>array('class'=>'col-xs-12 col-sm-6')));
              echo $this->Form->input('OrderNote.message',array('type'=>'textarea','rows'=>2,'class'=>'form-control','placeholder'=>'Special message (optional)','label'=>false,'div'=>array('class'=>'col-xs-12 col-sm-12')));
            ?>
               <!-- <div class="col-xs-12 col-sm-4">
                <div class="checkout-btn">
                  <a class="btn" href="#">takeway</a>
                  <a class="btn" href="#">prebook</a>
                </div>
               </div> -->
               <div class="col-xs-12">
                  <div class="thai-radio tap">
                    <ul>
                       <li><input type="radio" name="data[Order][type]" id="demo1" value="take_away" checked><label for="demo1">Take Away</label></li>
                      <li> <input type="radio" name="data[Order][type]" id="demo2" value="prebook"><label for="demo2">Prebook</label></li>             
                    </ul> 
                  </div>
              </div>

              <div class="col-xs-12 col-sm-12">
                <P class="ecom-text">Pick Up date and time (today or future):</P>
              </div> 
              <?php echo $this->Form->input('Order.dates',array('options' => $dates, 'class'=>'form-control','label'=>false,'div'=>array('class'=>'col-xs-12 col-sm-4')));?>
              <?php echo $this->Form->input('Order.times',array('options' => $times, 'class'=>'form-control','label'=>false,'div'=>array('class'=>'col-xs-12 col-sm-4')));?>
                               
              <div class="col-xs-12">
                  <div class="thai-radio">
                    <ul>                     
                      <?php
                      echo $this->Form->input('Condition.term', 
                          array('div' => false,
                          'label' => false,
                          'type' => 'checkbox',
                          'id' =>'term',
                          'required'=>true,                                                
                          'before' => '',
                          'after' => '<label class="checkbox" for="term">I accept terms and condition.</label>'
                          )); 
                      ?>  
                      <span class="term-link" data-link="<?php echo $this->webroot;?>shops/termAndConditions" onclick="myFunction(this)">read more</span>                    
                    </ul>
                     
                  </div>
              </div>
              <div class="col-xs-12 ">
                <p class="payment">choose payment method</p>
              </div>
              <div class="col-xs-12">
                  <div class="thai-radio">
                    <ul>
                       <li><input type="radio" name="data[Payment][type]" id="cash_on_delivery" value="cash_on_delivery" checked><label for="cash_on_delivery">Cash On Delivery</label></li>
                      <li> <input type="radio" name="data[Payment][type]" id="payment-method" value="payment-method"><label for="payment-method">PayPal/ MasterCard/ Visa</label></li>               
                    </ul> 
                  </div>
              </div>     
            <div class="col-xs-12 send-button text-center">
              <?php  echo $this->Form->button('Proceed', array('type' => 'submit', 'class' => 'btn', 'label' => false,'disabled'=>$disabled, 'div'=>false));?>
            </div> 
            </div>

        </div>
      </div>


    
      <!-- Cart Start-->
      <div class="col-xs-12 col-sm-4">
        <div class="cart-ecom-container">
        <div class="cart-ecom-wrapper">
          <div class="cart-header">
            <P><i class="fa fa-shopping-cart"></i> shopping cart (<span class="countcarttotal"><?php echo $quantity;?></span>)</P>
            <p class="cross hidden-sm pull-right hidden-md hidden-lg">
              <i class="fa fa-times"></i>
            </p>
          </div>

      <div class="cart-body-holder" id="cart-body-holder">  
        <?php foreach ($tocartquery as  $key=>$ele): ?>
          <div class="cart-body">
            <p class="amount">
              <input type="hidden" name="data[Order][Product][<?php echo $key;?>][id]" value="<?php echo $ele['Product']['title'];?>">
              <input type="hidden" name="data[Order][Product][<?php echo $key;?>][product_code]" value="<?php echo $ele['Product']['product_code'];?>">
              <input type="hidden" name="data[Order][Product][<?php echo $key;?>][vat]" value="<?php echo $ele['Product']['vat'];?>">            
              <input 
                onchange="updateMenuCart(this)"
                data-add="<?php echo $this->webroot;?>shops/addToBasket"
                data-title="<?php echo $this->webroot;?>shops/cart_summary_title"
                data-top="<?php echo $this->webroot;?>shops/cart_summary_top"
                data-update="<?php echo $this->webroot;?>shops/update_mycart"
                data-menuupdate="<?php echo $this->webroot;?>shops/update_menu_mycart"
                id="<?php echo $ele['Product']['id'];?>" 
                type="number"
                name="data[Order][Product][<?php echo $key;?>][qty]" 
                value="<?php echo $ele['Basket']['total_quantity'];?>"
               >  
            </p>
             <?php
              $ing=json_decode($ele['Product']['ingredients'],true);
              if(!empty($ing)){
              if(!empty($ing['additive'])){$additive=$ing['additive'];}else{$additive=array();}
                if(!empty($ing['allergenic'])){$allergenic=$ing['allergenic'];}else{$allergenic=array();}
                if(!empty($ing['zusatzstoffe'])){$zusatzstoffe=$ing['zusatzstoffe'];}else{$zusatzstoffe=array();}
                $ingredients=implode(',',array_merge($additive,$allergenic,$zusatzstoffe));
             }else{
                $ingredients='';
              }
            ?>
            <P class="name"><?php echo $ele['Product']['title'];?><sup><?php echo $ingredients;?></sup></P>
             <input type="hidden" name="data[Order][Product][<?php echo $key;?>][price]" value="<?php echo $ele['Basket']['productPrice'];?>">  
            <P class="price">€<?php echo $ele['Basket']['total_quantity']*$ele['Basket']['productPrice'];?> <a class="cart-delete" href="<?php echo $this->webroot; ?>shops/deletebasketdata/<?php echo $ele['Basket']['id'];?>"><i class="fa fa-trash"></i></a></P>
          </div><!-- /.cart-body -->
         <?php endforeach; ?>
          <div class="cart-clear"></div>
        </div>

      

          <div class="cart-footer">
            <div class="subtotal">
              <p class="des">Subtotal:</p>
              <p class="amount">€<span class="updatecarsummary" id="updatecarsummary"><?php echo $update_cart_summary_title["total_price"];?></span></p>
            </div>
            <!-- <div class="total">
                <p class="des">Gesamtbetrag:</p>
                <p class="amount">6.90</p>
              </div> -->  
          </div>
        </div>
        </div>
      </div>
      <?php echo $this->Form->end();?>
      <!-- Cart End-->
    </div>
  </div>
</section>
<!--====| Food Menu Style End |====-->