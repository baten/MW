<!DOCTYPE html>
<html>
  <head>
  <meta charset="UTF-8" />
    <title>Responsive Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--List Of Stylesheet-->
	<?php
	echo $this->Html->charset('utf-8'); 
    echo $this->Html->meta('icon');
    echo $this->Html->css('responsive/style');
	echo $this->Html->css('responsive/bootstrap');
	echo $this->Html->css('responsive/bootstrap-theme');
	echo $this->Html->css('responsive/font-awesome.min');	
	echo $this->Html->css('responsive/flexslider');
	echo $this->Html->css('responsive/elastislide');
	echo $this->Html->css('responsive/layout');
 ?>
</head>

<body>

<div id="login"  class="row">
	<div class="container">
    	<div class="loginone">
            <div class="register">
           		<!-- ..............................-->
                	<?php 
						$session_user_id = $this->Session->read('user_id'); 
						if($session_user_id){
							echo $this->element('layout/responsive/after-login'); 
						}else{
							echo $this->element('layout/responsive/before-login'); 
						}
					?>
                <!--.....................-->
            </div>
        </div>
    </div>
</div>
<!--End login-->
<div id="header" class="row">
	<div class="container">
		<?php echo $this->element('layout/responsive/header'); ?>
	</div>
</div>
<!--End header-->

<!-- Strat Nevigation -->
<div id="navigation" class="row">
	<div class="container">
            <?php echo $this->element('layout/responsive/nevigation'); ?>
    </div>
</div>
<!--End navigation-->
			
    <div id="innerone" class="row">
    <div class="container">
            <?php echo $this->Session->flash(); ?>
            <?php echo $content_for_layout; ?>
        </div>
    </div>
            
            
<!--Start footer Menu-->
<div id="footer" class="row">	
	<?php echo $this->element('layout/responsive/footer_menu'); ?>	
</div>
<!--End footer Menu-->
<div id="mainFooter" class="row">	
	<?php echo $this->element('layout/responsive/footer'); ?>	
</div><!--End containerFive-->
<a id="scroll-to-top" href="" >
       <img src="<?php echo $this->webroot; ?>images/topup.png" alt="">
</a>
	<?php
      echo $this->Html->script('responsive/modernizr.custom.17475');
	  echo $this->Html->script('responsive/jquery.min');
	 ?>
    
	<script type="text/javascript">
        $(window).scroll(function(){
        if($(this).scrollTop() > 100) {
        $('#scroll-to-top').fadeIn();
        } else {
        $('#scroll-to-top').fadeOut();
        }
        });
        $('#scroll-to-top').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 1000);
        return false;
        }); 
		$(document).ready(function(){
		  $("#mycart").click(function(){
			$(".shopping-car-box").toggle();
		  });
		});
    </script>
 
 	<?php 
	  echo $this->Html->script('responsive/jquery-ui');
	  echo $this->Html->script('responsive/jquery.slimscroll');
	 ?>
 	<script type="text/javascript">
		 $(function(){
			$('.shopping-car-box').slimScroll({
				height: '310px'
			});
		});
    </script>
    <script type="text/javascript">
		 $(function(){
			$('.shoppinggg-car-box').slimScroll({
				height: '310px'
			});
		});
    </script>
    <script type="text/javascript">
		 $(function(){
			$('.marketSubthree').slimScroll({
				height: '95px'
			});
		});
    </script>
    <script type="text/javascript">
		 $(function(){
			$('.marketSubten').slimScroll({
				height: '95px'
			});
		});
    </script>
    
    <script type="text/javascript">
		jQuery(function(cash) {
			function fixDiv() {
			  var $cache = $('#navigation');
			  if ($(window).scrollTop() > 100) 
				$cache.css({'position': 'fixed', 'top': '0px', 'left': '0%', 'left': '0%', 'width': '100%',  'margin': '0', 'display': 'block', 'z-index': '999'});
			  else
				$cache.css({'position': 'relative', 'display': 'block', 'left': '0%','margin': '13px 0 5px', 'top': '0'});
			}
			$(window).scroll(fixDiv);
			fixDiv();
		});
 </script>
	<?php 
	  echo $this->Html->script('responsive/bootstrap.min');
	 ?>
</body>
</html>