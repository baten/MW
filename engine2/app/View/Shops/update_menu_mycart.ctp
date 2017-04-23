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