<style type="text/css">
    .checkbox{      
        margin-left: 30px;
    }
    .checkbox label{
        padding-left: 20px;
    }
     input[type="radio"].ingredients, input[type="checkbox"].ingredients{
        margin-left: 0;
    }
    .radio label{
        padding-right: 20px;
    }
    .indent{
        margin-left: 60px;
    }
</style>
<div class="row bar bar-primary bar-top">
    <div class="col-md-12">
        <h1 class="bar-title"><?php echo __('Admin Add Product'); ?></h1>
    </div>
</div>

<div class="row bar bar-secondary">
    <div class="col-md-12">
        <?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Products', array('action' => 'index', 'admin' => true), array('escape' => false, 'class' => 'btn btn-success')); ?>
    </div>
</div>

<div class="row bar bar-third">
    <div class="col-md-12">
        <?php


        echo $this->Form->create('Product', array('class' => 'form', 'type' => 'file'));

        ?>

        <div class="row">
            <div class="col-md-12" data-ng-app='product'>

               <div class="row">
                    <div class="col-md-6">
                        <?php
                        echo "<strong>Product Name: </strong>".$product["Product"]["title"]."<br>";
                        echo "<strong>Opening Quantity: </strong>".$product["Product"]["quantity"]."<br>";
                        echo "<strong>Opening Price: </strong>".$product["Product"]["opening_price"]."<br>";
                        //echo "<strong>Product Name: </strong>".$product["Product"]["title"];
                        echo $this->Form->input('price',array("value"=> $product["Product"]["price"],'label'=>'Base Price', 'class'=>'form-control','div'=>array('class'=>'form-group')));
                        echo $this->Form->input('sale_price',array('label'=>'Idle Price',"value"=> $product["Product"]["sale_price"],'min'=>'0', 'class'=>'form-control','div'=>array('class'=>'form-group')));
                        echo $this->Form->input('purchased',array('label'=>'Quantity','class'=>'form-control','div'=>array('class'=>'form-group')));

                        echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));
                        echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));

                        ?>
                       <!--  <div class="group-control">
							<strong>Base Price : ৳  </strong>{{basePrice}}
							<strong>Discount : ৳  </strong>{{finalDiscount}}
							<strong>Sale Price : ৳  </strong>{{salePrice}}
						</div> -->
                    </div>

                   <div class="col-md-6">
                       <ul class="list-group">
                       <?php
                      $stock=$product['Product']['purchased']-$product['Product']['sold']-$product['Product']['demage'];


                       if(sizeof($product['Purchase'])) {
                           ?>

                           <li class="list-group-item"> <strong>Total Average : </strong>
                               <?php
                               $total=0;
                               $totalquantity=0;
                               foreach ($product['Purchase'] as $purchase)
                               {
                                   if (!$purchase['stock']) {
                                       continue;
                                   }
                                   $total+= $purchase['unit_price']* $purchase['quantity'];
                                   $totalquantity+= $purchase['quantity'];


                               }
                               $avg=0;
                               if($totalquantity)
                               {
                                   $avg = (float)$total / $totalquantity;

                               }

                               echo number_format((float)$avg, 2, '.', '');



                               ?>
                           </li>


                           <li class="list-group-item"><strong>Last Unit
                                   price:</strong> <?php echo $product['Purchase'][sizeof($product['Purchase']) - 1]['unit_price']?>
                           </li>

                               <?php

                       }
                           ?>


                           <li class="list-group-item">
                               <strong>Stock: </strong>
                               <?php

                               echo $stock;

                               ?>

                           </li>

                       </ul>
                   </div>


                </div>




                <!-- Upload Images -->


            </div>
        </div>
        
        

        <!-- Image uploading -->
          <!-- Image uploading -->

                </div>

    </div>
</div>

<style type="text/css">
    .attribute-id-holder {
        font-weight: bold;
        border-bottom: 1px solid #ccc;
        margin-bottom: 5px;
    }
</style>

<?php echo $this->start('script');?>
<script>
function spicy(selector){
  $('.'+selector).prop('checked', false);
}
</script>
<?php echo $this->end();?>