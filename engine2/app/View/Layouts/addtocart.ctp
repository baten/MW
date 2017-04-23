<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="msvalidate.01" content="B34CF6F615541671045747127244C8AF" />
<meta name="description" content="eApparel Source is the online platform where you can BUY QUICK, SELL EASY ™ .">
<meta name="description" content="eApparel Source is the largest B2B site for apparel & readymade garments industry where you can buy quick, sell easy. Find buyers, manufacturers, suppliers, exporters and Importers in a click">
<meta name="keywords" content="Dress, sell, clothes, shopping, clothing, manufacturer, buyers, garments, jeans, eapparel Source, eapparel">
<title><?php __('eApparel Source: ');?><?php echo $title_for_layout; ?> </title>
<?php	
echo $this->Html->charset('utf-8');
echo $this->Html->meta('icon');
echo $this->Html->css('global');
echo $this->Html->css('eStore');
echo $this->Html->css('staticcontent-left-menu');
echo $this->Html->css('jquery.fancybox-1.3.4');
echo $this->Html->script('jquery-1.6.2');
echo $this->Html->script('jquery.fancybox-1.3.4'); 



echo $scripts_for_layout;
?>
</head>
<body>
	<div id="container">
		<!--Start header-->
		<div class="header">
			<?php echo $this->element('layout/header'); ?>
		</div>	
		<!--End header-->
        <div class="clear5"></div>
        <div class="main-content">
			<div class="content">
					<?php echo $this->Session->flash(); ?>
					<?php echo $content_for_layout; ?>
				<div class="clear"></div>
			</div>
			<!--end content-->
			<div class="clear5"></div>
		</div>
		<div class="clear15"></div>
		
		<!-- Footer Start Here-->
		<div class="footer">	
			<?php echo $this->element('layout/footer'); ?>
		</div>
		<!-- Footer End-->
		<div class="clear"></div>
	</div>
</body>
</html>