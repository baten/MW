<!--===| Food Menu Start|===-->
<section class="menu-ecom-wrapper section-padding">
  <div class="container">
    <div class="row">
      <!-- contents Start-->
      <div class="col-xs-12 col-sm-8">
      <div class="new-search-wrapper">
          <div class="ecom-checkout search-form-wrapper">
            <?php echo $this->Form->create('Product',array('class'=>'ac-custom ac-checkbox ac-fill','id'=>'contact_form','name'=>'enqueryForm','url'=>array('controller'=>'shops','action'=>'menu'))); ?>
               <div class="row"> 
               <div class="col-sm-8">
                <div class="row"> 
                  <?php 
               $arr=array(
                  'G'     =>'Laktosefrei',
                  'A'     =>'Gluten-frei'                        
                );
                $arr2=array(
                  'vegan' =>'Vegetarische',
                  'pork'  =>'Kein Schweinefleisch',
                  'beef'  =>'Kein Rindfleisch'    
                ); ?>
           
           <?php   foreach ($arr as $key => $value):
               echo $this->Form->input('search', 
                        array(             
                          'type'=>'checkbox',
                          'before' => '<div class="col-xs-6 col-sm-6 col-md-4"><div class="thai-radio">',
                          'after' => "</div></div>",
                          'div' => false,
                          'value'=>$key,
                          'label' => $value,
                          'id'=>$key,
                          'name'=>$key,
                          'hiddenField'=>false,
                          'default'=>isset($this->request->data[$key])?$this->request->data[$key]:''
                     ));
              endforeach 
              ?>           
            <br>                    
            <?php           
                echo $this->Form->input('search2', array(
                    'type' => 'radio',
                    'legend' => false,
                    'options' => $arr2,                                     
                    'before' => '<div class="col-xs-12 col-sm-12"><div class="thai-radio search2">',
                    'after' => "</div></div>",
                    'div' => false,                                    
                    'hiddenField' => false, // added for non-first elements
                )); 
                ?>                
                 </div>           
               </div>
                <div class="col-sm-4">
                 <div class="row"> 
                  <?php echo $this->Form->submit('Suchen',array('type'=>'submit','class'=>'btn btn-success','label'=>false,'div'=>false));?>
                  <input class="btn btn-success" type="submit" value="zurückstellen">
                 </div>
               </div>                     
               </div>
         <?php echo $this->Form->end(); ?>
           </div>
        </div> 

  <div class="menu-ecom-container">
    <ul class="menu-ecom hidden-xs">
      <?php foreach ($categories as $key => $value):?>  
          <li><a class="<?php echo (count($value['children'])>0)?'has-sub':''?>" href="#<?php echo $value['Category']['id'];?>"><?php echo $value['Category']['title'];?></a> 
        <?php if (count($value['children'])>0):?>          
            <ul>
            <?php foreach ($value['children'] as $key => $ele):?> 
              <li><a href="#<?php echo $ele['Category']['id'];?>"><?php echo $ele['Category']['title'];?></a>
              </li> 
            <?php endforeach;?>            
            </ul>
        <?php endif;?> 
          </li>  
      <?php endforeach;?> 
        </ul>
 </div>

    <form class="form-inline">
      <?php foreach ($categories as $key => $value):
      if(count($value['ProductCategory'])>0):
      ?>
        
        <div  id="<?php echo $value['Category']['id'];?>" class="menu-heading-ecom">
        
        <?php 
            if(!empty($value['Category']['image_extension'])){
            $img=$value['Category']['id'].'.'.$value['Category']['image_extension'];
        ?>
           <img src="<?php echo $this->webroot;?>img/site/product_categories/<?php echo $img;?>" alt="<?php echo $value['Category']['title'];?>">

          <?php } ?> 

          <h2><?php echo $value['Category']['title'];?></h2>
        </div>
        <?php $order = array();
        foreach ($value['ProductCategory'] as $key => $row){
          if(count($row['Product'])>0):
            $order[$key] = $row['Product']['product_code'];
          else:
               $order[$key] = 0;
          endif;
        }
        array_multisort($order, SORT_ASC, $value['ProductCategory']);
        ?>
        <?php  $countProduct=0; foreach ($value['ProductCategory'] as $key => $val):?>
            <?php
            if(count($val['Product'])>0):
              $countProduct=1;
               $ing=json_decode($val['Product']['ingredients'],true); 
              if(!empty($ing)){
              if(!empty($ing['additive'])){$additive=$ing['additive'];}else{$additive=array();}
                if(!empty($ing['allergenic'])){$allergenic=$ing['allergenic'];}else{$allergenic=array();}
                if(!empty($ing['zusatzstoffe'])){$zusatzstoffe=$ing['zusatzstoffe'];}else{$zusatzstoffe=array();}
                $ingredients=implode(',',array_merge($additive,$allergenic,$zusatzstoffe));
             }else{
                $ingredients='';
              }
            ?>        
            <div class="menu-ecom-contents basketproduct"
              role='button'
              type='submit'
              data-add="<?php echo $this->webroot;?>shops/addToBasket"
              data-title="<?php echo $this->webroot;?>shops/cart_summary_title"
              data-top="<?php echo $this->webroot;?>shops/cart_summary_top"
              data-update="<?php echo $this->webroot;?>shops/update_mycart"
              data-menuupdate="<?php echo $this->webroot;?>shops/update_menu_mycart"
              data-quantity="<?php echo $this->webroot;?>shops/check_user_basket2"
              data-productid="<?php echo $val['Product']['id'];?>"
            >
              <div class="row">
              <div class="col-xs-12 col-sm-7">
               <?php echo $this->Html->image("site/products/{$val['Product']['ProductImage'][0]['id']}.{$val['Product']['ProductImage'][0]['extension']}", array("alt" => "{$val['Product']['title']}"));?>
                <div class="contents">
                  <h3><a href="#"><?php echo $val['Product']['title'];?></a> <sup><?php echo $ingredients;?></sup></h3>
                  <P><?php echo $val['Product']['short_description'];?></P>
                </div>
              </div>
              <div class="col-xs-12 col-sm-2">
                <div class="icons">
                  <?php if(!empty($val['Product']['food_item'])):?>
                  <P class="item-spicy <?php echo $val['Product']['food_item'];?>" title="<?php echo $val['Product']['food_item'];?>"></P>
                <?php endif;?>

                <?php if(!empty($val['Product']['spicy_level'])):?>
                  <P class="item-spicy <?php echo $val['Product']['spicy_level'];?>" title="Spicy Level : <?php echo $val['Product']['spicy_level'];?>"></P>
                <?php endif;?>  

                </div>
              </div>
              <div class="col-xs-12 col-sm-3">
                <div class="btn-wrapper">
                  <a class="btn" type="submit" name="submit"><?php echo $val['Product']['price'];?>|+</a>
                </div> 
              </div>
              </div>
            </div><!-- /.menu-ecom-contents --> 
          <?php endif;?>        
        <?php endforeach;?>

        <?php if($countProduct==0){
          echo '<div class="row">
              <div class="col-xs-12 col-sm-12">
               <span class="not-found">No Food Item Found</span>
              </div>
            </div>';
        }?>


        <?php if (count($value['children'])>0):?>
            <?php foreach ($value['children'] as $key => $ele):
                if(count($ele['ProductCategory'])>0):
            ?>

              <div  id="<?php echo $ele['Category']['id'];?>" class="menu-heading-ecom">
             
              <?php 
                  if(!empty($ele['Category']['image_extension'])){
                  $imgg=$ele['Category']['id'].'.'.$ele['Category']['image_extension'];
              ?>
              <img src="<?php echo $this->webroot;?>img/site/product_categories/<?php echo $imgg;?>" alt="<?php echo $ele['Category']['title'];?>">
              <?php } ?> 
               
                <h2><?php echo $ele['Category']['title'];?></h2>
              </div>
              <?php $order2 = array();
              foreach ($ele['ProductCategory'] as $key => $row){
                  if(count($row['Product'])>0):
                    $order2[$key] = $row['Product']['product_code'];
                  else:
                     $order2[$key] = 0;
                  endif;               
              }
              array_multisort($order2, SORT_ASC, $ele['ProductCategory']);
              ?>
            <?php $countProductChild=0;  foreach ($ele['ProductCategory'] as $key => $vall):?>
              <?php
              if(count($vall['Product'])>0):
                $countProductChild=1;
                $ingg=json_decode($vall['Product']['ingredients'],true);
                if(!empty($ingg)){
                if(!empty($ingg['additive'])){$additive=$ingg['additive'];}else{$additive=array();}
                if(!empty($ingg['allergenic'])){$allergenic=$ingg['allergenic'];}else{$allergenic=array();}
                if(!empty($ingg['zusatzstoffe'])){$zusatzstoffe=$ingg['zusatzstoffe'];}else{$zusatzstoffe=array();}
                $ingredientss=implode(',',array_merge($additive,$allergenic,$zusatzstoffe));
              }else{
                $ingredientss='';
              }
              ?>
                 
             <div class="menu-ecom-contents basketproduct"
              role='button'
              type='submit'
              data-add="<?php echo $this->webroot;?>shops/addToBasket"
              data-title="<?php echo $this->webroot;?>shops/cart_summary_title"
              data-top="<?php echo $this->webroot;?>shops/cart_summary_top"
              data-update="<?php echo $this->webroot;?>shops/update_mycart"
              data-menuupdate="<?php echo $this->webroot;?>shops/update_menu_mycart"
              data-quantity="<?php echo $this->webroot;?>shops/check_user_basket2"
              data-productid="<?php echo $vall['Product']['id'];?>"
            >
              <div class="row">
              <div class="col-xs-12 col-sm-7">
                <?php echo $this->Html->image("site/products/{$vall['Product']['ProductImage'][0]['id']}.{$vall['Product']['ProductImage'][0]['extension']}", array("alt" => "{$vall['Product']['title']}"));?>
                <div class="contents">
                  <h3><a href="#"><?php echo $vall['Product']['title'];?></a> <sup><?php echo $ingredientss;?></sup></h3>
                  <P><?php echo $vall['Product']['short_description'];?></P>
                </div>
              </div>
              <div class="col-xs-12 col-sm-2">
                <div class="icons">

                <?php if(!empty($vall['Product']['food_item'])):?>
                  <P class="item-spicy <?php echo $vall['Product']['food_item'];?>" title="<?php echo $vall['Product']['food_item'];?>"></P>
                <?php endif;?>

                <?php if(!empty($vall['Product']['spicy_level'])):?>
                  <P class="item-spicy <?php echo $vall['Product']['spicy_level'];?>" title="Spicy Level : <?php echo $vall['Product']['spicy_level'];?>"></P>
                <?php endif;?>  

                </div>
              </div>
              <div class="col-xs-12 col-sm-3">
                <div class="btn-wrapper">
                  <a class="btn" type="submit" name="submit"><?php echo $vall['Product']['price'];?> |+</a>
                </div> 
              </div>
              </div>
            </div><!-- /.menu-ecom-contents --> 
            <?php endif;?>           
        <?php endforeach;?> 
        <?php if($countProductChild==0){
          echo '<div class="row">
              <div class="col-xs-12 col-sm-12">
              <span class="not-found">No Food Item Found</span>
              </div>
            </div>';
        }?>
                                     
            <?php endif;?>
            <?php endforeach;?>
        <?php endif;?> 

         <?php endif;?>  
      <?php endforeach;?>  

      </div>
      <!-- contents End-->
</form>

<?php 
$update_cart_summary_title = $this->requestAction("/shops/update_cart_summary_title"); 
$tocartquery = $this->requestAction("/shops/top_cart_query"); 
//pr($update_cart_summary_title);
if(!empty($update_cart_summary_title['total_qty'])):
    $quantity=$update_cart_summary_title["total_qty"];   
else:
    $quantity= 0;  
endif; 
?>

      <!-- Cart Start-->
      <div class="col-xs-12 col-sm-4">
        <div class="cart-ecom-container">
        <div class="cart-ecom-wrapper">
          <div class="cart-header">
            <P><i class="fa fa-shopping-cart"></i> Einkaufswagen (<span class="countcarttotal flyContainer"><?php echo $quantity;?></span>)</P>
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
              <p class="des">Zwischensumme:</p>
              <p class="amount">€<span class="updatecarsummary" id="updatecarsummary"><?php echo $update_cart_summary_title["total_price"];?></span></p>
            </div>         
          </div>
          <div class="btn-wrapper ecom">
              <a href="<?php echo $this->webroot;?>shops/checkout" class="btn ecom-btn" type="submit" name="submit">Kasse</a>
        </div>          
        </div>
        </div>
      </div>
      <!-- Cart End-->
    </div>
  </div>
</section>

<!--====| Food Menu Style End |====-->

<?php 
echo $this->start('script');
echo $this->Html->script(
      ['shops/flycartCustom']);
echo $this->end();
?>