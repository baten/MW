<?php foreach ($tocartquery as  $key=>$ele): ?>   
          <div class="row mini-cart-item ">
            <a class="cart_list_product_img" href="#">
              <?php echo $this->Html->image("site/products/{$ele['Product']['ProductImage'][0]['id']}.{$ele['Product']['ProductImage'][0]['extension']}", array("alt" => "cart-01",'class'=>'attachment-shop_thumbnail'));?>
            </a> 
            <div class="mini-cart-info">
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
              <a class="cart_list_product_title" href="#"><?php echo $ele['Product']['title'];?><sup><?php echo $ingredients;?></sup></a>
              <div class="cart_list_product_quantity"><?php echo $ele['Basket']['total_quantity'];?> x <span class="amount">€<?php echo $ele['Basket']['productPrice'];?></span></div> 
            </div>
           <!--  <a class="remove" title="Remove this item" href="<?php //echo $this->webroot; ?>shops/deletebasketdata/<?php //echo $ele['Basket']['id'];?>"><i class="fa fa-trash-o"></i></a> -->
          </div>
<?php endforeach; ?>