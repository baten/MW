<!--===| Slider Part Start ===|-->
<?php echo $this->element('/shops/slider');?>
<!--===| Slider Part End ===|-->

<!--===| Welcome Area Start===|-->
<?php echo $this->element('/shops/about_us');?>
<!--===| Welcome Area End===|-->

<!--===| Service Start ===|-->
<?php echo $this->element('/shops/service');?>
<!--===| Service End ===|-->

<!--====| Shuffle Menu Style Sta rt|====--> 
<section id="food-menu" class="galleri-wrapper food-menu-wrapper section-padding home-menu">
    <div class="container"> 
      <div class="row"> 
        <div class="col-xs-12"> 
          <h1>Speisekarte</h1> 
          <p class="slogan">Genießen Sie exotische thailändische Spezialitäten!</p>
        </div>
      </div>

      <div class="row">        
        <form id="grid" class="form-inline"> 
         <!-- portfolio-item -->
<?php foreach ($contents as $key => $ele):?>
    <div class="portfolio-item col-xs-12 col-sm-6 col-md-6">
          <div class="portfolio">
            <div class="media menu-media">
              <div class="media-left media-top">
               <?php                
                  echo $this->Html->link(
                      $this->Html->image("site/products/{$ele['ProductImage'][0]['id']}.{$ele['ProductImage'][0]['extension']}", array("alt" => "{$ele['Product']['title']}")),
                      "#food-menu",
                      array('escape' => false)
                  );
              ?>       
              </div>
              <div class="media-body">
                <h2>                
                <?php echo $this->Html->link("{$ele['Product']['title']}({$ele['Product']['product_code']})","#food-menu",array('escape' => false));?>                 
                    <span class="loading_animation">€<?php echo $ele['Product']['price'];?> <br>
                    <?php echo $this->Html->image('ajax-loader.gif');?>
                   <?php
                    echo $this->Html->link(
                        '<i class="fa fa-shopping-cart"></i>',
                        '#food-menu',
                        array(
                          'class' => 'basketproduct',                          
                          'role' => 'button',
                          'type'=>'submit',
                          'data-add'=>"{$this->webroot}shops/addToBasket",
                          'data-title'=>"{$this->webroot}shops/cart_summary_title",
                          'data-top'=>"{$this->webroot}shops/cart_summary_top",
                          'data-update'=>"{$this->webroot}shops/update_mycart",
                          'data-quantity'=>"{$this->webroot}shops/check_user_basket2",
                          'data-productid'=>"{$ele['Product']['id']}",                         
                          'escape' => false
                          )                        
                    );
                ?>
                    </span>
                </h2>
                <p><?php echo $ele['Product']['short_description'];?></p>
              </div>
            </div>
          </div>      
        </div>      
<?php endforeach;?>
</form>
   
      <div class="load-button text-center ger-v">
        <a href="http://thai-atrium.de/pdf/menu.pdf" target="_blank"><button class="btn" name="submit" type="button">voll-speisekarte</button></a>
        <a href="<?php echo $this->webroot;?>shops/menu"><button class="btn" name="submit" type="submit">e-speisekarte</button></a>
      </div>
    </div><!-- row -->
  </div><!-- container -->
</section> 
<!--====| Shuffle Menu Style End |====-->

<!--===| Signature menu Start|===-->
<?php //echo $this->element('/shops/signature');?>
<!--===| Signature menu End|===-->

<!--==| Book A table Start |==-->
<?php echo $this->element('/shops/book_table');?>
<!--==| Book A table end |==-->

<!--====| Gallery Start |====-->
<?php echo $this->element('/shops/gallery');?>
<!--====| Gallery End |====-->

<!--====| new event Start |====-->
<?php echo $this->element('/shops/event');?>
<!--====| new event End |====-->

<!--====| Contact Us Start |====-->
<?php echo $this->element('/shops/contact_us');?>
<!--====| Contact Us End |====-->

<div id="map-canvas1"></div>