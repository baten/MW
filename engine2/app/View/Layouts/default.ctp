<?php
$cakeDescription = __d('cake_dev', 'MatjarAlwatany');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<?php
 App::import('Model', array('SiteSetting'));
 $this->SiteSetting = new SiteSetting(); 
 $siteSettings= $this->SiteSetting->find('first');
?>
<!DOCTYPE html>
<html>
<head>
<?php echo $this->Html->charset(); ?>
<title><?php echo $cakeDescription ?>: <?php echo $title_for_layout; ?></title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->webroot; ?>img/favicon.ico"> 
<?php
//echo $this->Html->meta('favicon.ico',$this->webroot.'favicon.ico',array('type' => 'icon'));


echo $this->Html->css(
		[
			'/bootstrap/css/bootstrap.min',
			'/bootstrap/css/bootstrap-theme.min',
			'uy-sys',
			'/jquery-ui/jquery-ui.min',
			'/froala-editor/css/font-awesome.min',
			'/froala-editor/css/froala_editor.min',
			'selectize'
		]
	);

echo $this->Html->script(
		[
			'jquery',
			'/jquery-ui/jquery-ui.min',
			'Ecommerce.angular',
			'selectize.min'
		]
	);
//echo $this->Less->lessCss(['foo']);

echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>
</head>
<body>
	<div class="container-fluid">
		<!-- header -->
		<?php echo $this->element('/admin/header',array('siteSettingsId'=>$siteSettings['SiteSetting']['id']));?>
		<!-- Menus -->
		<div class="row">
			<?php if(!empty($auth_status)):?>
			<?php echo $this->element('/admin/menu');?>

			<!-- Page data -->
			<div class="col-md-10">
			 	<?php if($this->Session->check('Message.flash') != '' or $this->Session->check('Message.auth') != ''):?>
				<div class="row">
					
						<?php echo $this->Session->flash(); ?>
						<?php echo $this->Session->flash('auth'); ?>
					
				</div>
				<?php  endif;?>
			
				<div class="row">
					<div class="col-md-12">
						<?php echo $this->fetch('content'); ?>
					</div>
				</div>
			</div>
			<?php else:?>
				<div class="login-form-holder">
					<div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">

						<?php echo $this->fetch('content'); ?>
					</div>
					<div class="clearfix"></div>
				</div>
			
			<?php endif;?>
		</div>
	</div>

	<?php echo $this->element('sql_dump'); ?>

	<!-- Javascript -->
	<?php 
	echo $this->Html->script(
			[
				'layout',
				'/bootstrap/js/bootstrap.min',
				'/froala-editor/js/froala_editor.min',
				'/froala-editor/js/plugins/media_manager.min',
				'Ecommerce.e-commerce-admin'
			]
		);
	?>
	<!--[if lt IE 9]>
		<?php 
    	echo $this->Html->script(
			[
				'/froala-editor/js/froala_editor.min'
			]
		);
    	?>
	<![endif]-->
	
</body>
</html>
