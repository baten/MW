<?php
	//for admin
	//Router::connect('/', array('controller' => 'shops', 'action' => 'index'));
	Router::connect('/', array('controller' => 'users', 'action' => 'login','admin'=>true));
	//Router::connect('/en', array('controller' => 'shops', 'action' => 'index'));
	//Router::connect('/en/:controller/:action', array('controller' => 'shops', 'action' => 'menu'));
	Router::connect('/administrator', array('controller' => 'users', 'action' => 'login','admin'=>true));
	
	//for merchant
	Router::connect('/merchant', array('plugin'=>'Merchant','controller' => 'merchantApis', 'action' => 'login','admin'=>true));
	//for site
	Router::connect('/sites/:action/*', array('controller' => 'sites'));
	Router::connect('/ecommerce/sites/:action/*', array('plugin'=>'Ecommerce', 'controller' => 'sites'));
	Router::connect('/blog/sites/:action/*', array('plugin'=>'Blog', 'controller' => 'sites'));
	Router::connect('/timeout/sites/:action/*', array('plugin'=>'Timeout', 'controller' => 'sites'));
	Router::connect('/shipping/apis/:action/*', array('plugin'=>'Shipping', 'controller' => 'apis'));
	
	//alow json extension
	Router::parseExtensions('json');
	
	require CAKE . 'Config' . DS . 'routes.php';
