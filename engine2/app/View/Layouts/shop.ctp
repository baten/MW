<?php
	$cakeDescription = __d('cake_dev', 'nrb buy sell');
	$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version());
	$controllerName=$this->params['controller']; 
	$actionName=$this->params['action'];	
?>

<?php
 //App::import('Model', array('SiteSetting'));
// $this->SiteSetting = new SiteSetting(); 
 //$siteSettings= $this->SiteSetting->find('first');
// pr($siteSettings);
?>
<!DOCTYPE html>
<html>
<head>
 <?php echo $this->Html->charset(); ?> 
 <title><?php echo $cakeDescription ?>: <?php echo $title_for_layout; ?></title>
 <?php echo $this->Html->meta(array('http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge'));?>
 <?php echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1'));?>
 <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->webroot; ?>img/favicon.png"> 
 <?php echo $this->Html->meta(array('name' => 'author','content'=>'mipellim'));?>

<?php
echo $this->Html->css(
	[	'http://fonts.googleapis.com/css?family=Roboto:400,400italic,300italic,300,100italic,100,500,500italic,700,700italic,900,900italic',
		'http://fonts.googleapis.com/css?family=Playball',
		'http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic',
		'/bootstrap/css/bootstrap.min',
		'/bootstrap/css/bootstrap-theme.min',		
		'/vendor/rs-plugin/css/settings',
		'/vendor/fancybox/jquery.fancybox.min',
		'/jquery-ui/jquery-ui.min',
		'shops/owl.carousel.min',
		'shops/animate.min',
		'shops/normalize.min',
		'shops/jquery.mmenu.all',
		'/froala-editor/css/font-awesome.min',
		'/flaticon/css/flaticon',
		'shops/main',
		'shops/boxed',
		'shops/responsive'
	]
);

echo $this->fetch('meta');
echo $this->fetch('css');
?>
<!--[if IE]>
  <script type="text/javascript" src="js/ie.js"></script>
  <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body data-spy="scroll" onload="initialize()" data-target="#navbar">

<?php if(($controllerName=='shops') && ($actionName=='index')):?>
	<!-- Loader -->
	<div class="loader"></div>
<?php endif;?>

	<!-- Offcanvas -->
	<div id="page"></div>

<!--===| Search Start |===-->
<?php echo $this->element('/shops/search_section');?>
<!--===| Search End |===-->

 <!--===| CSS Switcher Start |===-->
 <?php echo $this->element('/shops/css_switcher');?>
 <!--===| CSS Switcher End |===-->

 <!--===| Pop Up Google Map Start |===-->
<?php echo $this->element('/shops/popup_google_map');?>
 <!--===| Pop Up Google Map End |===-->


<div  class="wrapper">

<!--===| Header Top Start |===-->
<?php echo $this->element('/shops/header_top');?>
<!--===| Header Top End |===-->

<!--===| Header  Start |===-->
<?php echo $this->element('/shops/header',array('controllerName'=>$controllerName,'actionName'=>$actionName));?>
<!--===| Header  End |===-->

<!--==================================| Dynamic part  Start |==================================-->
<?php if($this->Session->check('Message.flash') != ''):?>
	<div class="row">
		<div class="col-md-10 col-md-offset-1 t-center">	
			<?php echo $this->Session->flash(); ?>
		</div>	
	</div>
<?php  endif;?>
<?php echo $this->fetch('content'); ?>
<!--==================================| Dynamic part  End |===================================-->

<!--===| Right Fixed Booking Form Start|===-->
<?php echo $this->element('/shops/fixed_book_table');?>
<!--===| Right Fixed Booking Form end|===-->

<!--====| Footer section Start|====-->
<?php echo $this->element('/shops/footer');?>
<!--====| Footer section Start|====-->

<!--==| offcanvas-menu Start |==-->
<?php echo $this->element('/shops/mobile_menu',array('controllerName'=>$controllerName,'actionName'=>$actionName));?>
<!--==| offcanvas-menu End |==-->
</div>
   
	<?php 
	echo $this->Html->script(
			[
				'jquery',
				'/bootstrap/js/bootstrap.min',
				'shops/modernizr-2.6.2.min',
				'shops/wow.min',
				'/vendor/rs-plugin/js/jquery.themepunch.tools.min',
				'/vendor/rs-plugin/js/jquery.themepunch.revolution.min',
				'/vendor/fancybox/jquery.fancybox.min',
				'shops/owl.carousel.min',
				'shops/jquery.mmenu.min.all',
				'shops/jquery.shuffle.min',
				'/jquery-ui/jquery-ui.min',
				'shops/validation',
				'shops/scrolling-nav',
				'https://maps.googleapis.com/maps/api/js',	
				'shops/map-popup',
				'shops/map-contact',
				'shops/preset',
				'http://www.jscache.com/wejs?wtype=restaurantWidgetWhite&amp;uniq=523&amp;locationId=8708010&amp;icon=knifeAndFork&amp;lang=en_US&amp;display_version=2',
				'https://apis.google.com/js/platform.js',
				'shops/jquery.elevatezoom',
				'shops/custom'				
			]
		);
		echo $this->fetch('script');
	?>	

<?php if(($controllerName=='shops') && ($actionName=='index')):?>
	<script>			
		/*$('.nav').find('li').click(function(event){
			event.preventDefault();
			var obj=$(this).find('a');
			if(history.pushState) {
			    history.pushState(null, null, obj.attr('href'));
			}else {
			    location.hash = obj.attr('href');
			    $(obj.attr('href')).fadeIn('slow');	
			}
		});	*/

		$(document).bind('scroll',function(e){
   			var obj=$('.nav').find('li.active').children('a');
   			 if(history.pushState) {
			    history.pushState(null, null, obj.attr('href'));
			}else {
			    location.hash = obj.attr('href');
			    $(obj.attr('href')).fadeIn('slow');	
			}
		});
		
	</script>
<?php endif;?>	
<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
