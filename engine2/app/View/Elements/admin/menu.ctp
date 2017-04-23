<style>
	.divider{
		border-bottom: #ccc solid 1px;
	}

</style>

<?php 
	function check_menu_active($current_location,$options){
		$condition = false;
		if((in_array($current_location['controller'],$options['controllers'],true)  && in_array($current_location['plugin'],$options['plugins'],'true'))== true){
			$condition = true;
		}
		if($condition == true){
			echo 'in';
		}
	}
	
	if($this->request['plugin'] == ''){
		$plugin = 'default';
	}else{
		$plugin = $this->request['plugin'];
	}
	
	$current_location = array('plugin'=>$plugin,'controller'=>$this->request['controller']);
	
	
	//check_menu_active(array('plugin'=>'default','controller'=>'menus'),array('plugins'=>array('default'),'controllers'=>array('menus')));
	
?>

<div class="col-md-2 left-bar">
	
	<div class="bar bar-primary bar-top">
		<?php echo $this->Html->link('<i class="fa fa-dashboard"></i> Dashboard',['controller'=>'dashboards','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false,'class'=>'dashboard-link']); ?>
	</div>
	<div class="panel-group" id="accordion-menu">
		<!-- Web Manager -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<?php echo $this->Html->link('<i class="fa fa-globe"></i> CMS Manager <i class="fa fa-angle-double-down pull-right"></i>','#webPageManager',['escape'=>false,'data-toggle'=>"collapse" ,'data-parent'=>"#accordion-menu"]);?>
				</h4>
			</div>
			<div id="webPageManager" class="panel-collapse collapse <?php check_menu_active($current_location,array('plugins'=>array('default','timeout'),'controllers'=>array('web_pages','web_page_details','menus','banners','galleries','social_networks','overviews','currency_values','subscribers','subscriber_notifications','subscriber_notification_details')));?>">
				<div class="panel-body panel-body-custom">
					<ul class="left-bar-menu-ul">
						<li>
							<?php echo $this->Html->link('<i class="fa fa-file-text"></i> Pages',['controller'=>'web_pages','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-link"></i> Menus',['controller'=>'menus','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-link"></i> Sort Menu',['controller'=>'menus','action'=>'sort_menu','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
						 
						<li>
							<?php echo $this->Html->link('<i class="fa fa-file-image-o"></i> Slider Content',['controller'=>'banners','action'=>'index','admin'=>true,'plugin'=>'timeout'],['escape'=>false]);?>
						</li>
						<!-- 
						 <li>
							<?php //echo $this->Html->link('<i class="fa fa-file-image-o"></i> Gallery',['controller'=>'galleries','action'=>'index','admin'=>true,'plugin'=>'timeout'],['escape'=>false]);?>
						</li>
						
						<li>
							<?php //echo $this->Html->link('<i class="fa fa-share"></i>Company Overviews',['controller'=>'overviews','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
						 -->
						<li>
							<?php echo $this->Html->link('<i class="fa fa-share"></i> Shares',['controller'=>'social_networks','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
						
						<li>
							<?php //echo $this->Html->link('<i class="fa fa-share"></i> Patners',['controller'=>'partners','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-file"></i> Sort Network',['controller'=>'social_networks','action'=>'sort_socialnetwork','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-file"></i> Currency Value',['controller'=>'currency_values','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-link"></i> List All Subscribers',['controller'=>'subscribers','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-link"></i> Subscriber Notification',['controller'=>'subscriber_notifications','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-link"></i> Subscriber Notification Details',['controller'=>'subscriber_notification_details','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
						
					</ul>
				</div>
			</div>
		</div>
		 
		
		
		
		
		<!-- Shop manager -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<?php echo $this->Html->link('<i class="fa fa-shopping-cart"></i> Shop Manager <i class="fa fa-angle-double-down pull-right"></i>','#shopManager',['escape'=>false,'data-toggle'=>"collapse" ,'data-parent'=>"#accordion-menu"]);?>
				</h4>
			</div>
			<div id="shopManager" class="panel-collapse collapse <?php check_menu_active($current_location,array('plugins'=>array('ecommerce','shipping','timeout'),'controllers'=>array('products','brands','product_orders','product_stocks','clients','sports','sales','categories','attributes','merchants','countries','states','channels','coupons','purchases','demages','deliverymen','expenses','clients','teams')));?>">
				<div class="panel-body panel-body-custom">
					<ul class="left-bar-menu-ul">
					<li>
							<?php echo $this->Html->link('<i class="fa fa-tree"></i> Merchants',['controller'=>'merchants','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-qrcode"></i> Products',['controller'=>'products','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-leaf"></i> Categories',['controller'=>'categories','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-tree"></i> Attributes',['controller'=>'attributes','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-tree"></i> Brands',['controller'=>'brands','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-object-group"></i> Teams',['controller'=>'teams','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
						</li>
						<!--
						<li>
							<?php //echo $this->Html->link('<i class="fa fa-tree"></i> Sports',['controller'=>'sports','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
						</li>

						 
						 <li>
							<?php //echo $this->Html->link('<i class="fa fa-industry"></i> Industries',['controller'=>'industries','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
						</li> -->
						
						<!-- <li>
							<?php //echo $this->Html->link('<i class="fa fa-tags"></i> Product Types',['controller'=>'types','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
						</li> 
                        <li>
							<?php //echo $this->Html->link('<i class="fa fa-key"></i> Toppers',['controller'=>'toppers','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
						</li>
                        
						-->
						<!--<li>
							<?php //echo $this->Html->link('<i class="fa fa-stop"></i> Stores',['controller'=>'stores','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
						</li> -->
						<!-- <li>
							<?php //echo $this->Html->link('<i class="fa fa-key"></i> Stocks',['controller'=>'stocks','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
						</li> 
						-->
						<li>
							<?php echo $this->Html->link('<i class="fa fa-key"></i> Coupons',['controller'=>'coupons','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
						</li>
						<!-- 
						<li>
							<?php //echo $this->Html->link('<i class="fa fa-money"></i> Purchases',['controller'=>'purchases','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
						</li>
						<li>
							<?php //echo $this->Html->link('<i class="fa fa-tint"></i> Demages',['controller'=>'demages','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
						</li>
						-->
						<li>
							<?php echo $this->Html->link('<i class="fa fa-paper-plane"></i> Delivery',['controller'=>'deliverymen','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-money"></i> Expense',['controller'=>'expenses','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
						</li>
					<!-- 	<li class="divider">Report</li>
					<li>
						<?php //echo $this->Html->link('<i class="fa fa-hdd-o"></i> Stock',['controller'=>'products','action'=>'stockreport','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
					</li>
					<li>
						<?php //echo $this->Html->link('<i class="fa fa-line-chart"></i> Sale',['controller'=>'products','action'=>'salereport','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
					</li>
					   -->
						<li class="divider">Bussiness</li>
					
						<li>
							<?php echo $this->Html->link('<i class="fa fa-bars"></i> Orders',['controller'=>'product_orders','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
						</li>
						<!-- 
						<li>
							<?php //echo $this->Html->link('<i class="fa fa-user"></i> Reservations',['controller'=>'reservations','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
						</li>
						 -->
						<li>
							<?php echo $this->Html->link('<i class="fa fa-user"></i> Customers',['controller'=>'clients','action'=>'index','admin'=>true,'plugin'=>'timeout'],['escape'=>false]);?>
						</li>
						
						
						
						<li class="divider">Shipping</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Country',['controller'=>'countries','action'=>'index','admin'=>true,'plugin'=>'shipping'],['escape'=>false]);?>
						</li>
						<li>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-random"></i> Channels',['controller'=>'channels','action'=>'index','admin'=>true,'plugin'=>'shipping'],['escape'=>false]);?>
						</li>

									
					</ul>
				</div>
			</div>
		</div>
		
		
		<!-- Blog manager -->
		<!-- <div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<?php //echo $this->Html->link('<i class="fa fa-share-alt"></i> Blog Manager <i class="fa fa-angle-double-down pull-right"></i>','#blogManager',['escape'=>false,'data-toggle'=>"collapse" ,'data-parent'=>"#accordion-menu"]);?>
				</h4>
			</div>
			<div id="blogManager" class="panel-collapse collapse <?php //check_menu_active($current_location,array('plugins'=>array('blog'),'controllers'=>array('blogCategories','posts')));?>">
				<div class="panel-body panel-body-custom">
					<ul class="left-bar-menu-ul">
						<li>
							<?php //echo $this->Html->link('<i class="fa fa-th-list"></i> Categories',['controller'=>'blogCategories','action'=>'index','admin'=>true,'plugin'=>'blog'],['escape'=>false]);?>
						</li>
						<li>
							<?php // echo $this->Html->link('<i class="fa fa-share"></i> Posts',['controller'=>'posts','action'=>'index','admin'=>true,'plugin'=>'blog'],['escape'=>false]);?>
						</li>
					</ul>
				</div>
			</div>
		</div> -->
		
		<!-- user manager -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<?php echo $this->Html->link('<i class="fa fa-users"></i> User Manager <i class="fa fa-angle-double-down pull-right"></i>','#userManager',['escape'=>false,'data-toggle'=>"collapse" ,'data-parent'=>"#accordion-menu"]);?>
				</h4>
			</div>
			<div id="userManager" class="panel-collapse collapse <?php check_menu_active($current_location,array('plugins'=>array('default'),'controllers'=>array('users','roles')));//check_menu_active($this->params['controller'],array('users'));?>">
				<div class="panel-body panel-body-custom">
					<ul class="left-bar-menu-ul">
						<li>
							<?php echo $this->Html->link('<i class="fa fa-user"></i> Users',['controller'=>'users','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
						<li>
						</li>
						
						<li>
							<?php echo $this->Html->link('<i class="fa fa-flag"></i> Roles',['controller'=>'roles','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
					</ul>
				</div>
			</div>
		</div>
		
		<!-- system -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<?php echo $this->Html->link('<i class="fa fa-wrench"></i> Core Manager <i class="fa fa-angle-double-down pull-right"></i>','#systemManager',['escape'=>false,'data-toggle'=>"collapse" ,'data-parent'=>"#accordion-menu"]);?>
				</h4>
			</div>
			<div id="systemManager" class="panel-collapse collapse <?php check_menu_active($current_location,array('plugins'=>array('default'),'controllers'=>array('system_settings','site_settings')));?>">
				<div class="panel-body panel-body-custom">
					<ul class="left-bar-menu-ul">
						<!--  
						<li>
							<?php echo $this->Html->link('<i class="fa fa-asterisk"></i> System Settings',['controller'=>'system_settings','action'=>'index','admin'=>true,'plugin'=> false],['escape'=>false]);?>
						</li>
						-->
						<li>
							<?php echo $this->Html->link('<i class="fa fa-cog"></i> Site Settings',['controller'=>'site_settings','action'=>'index','admin'=>true,'plugin'=> false],['escape'=>false]);?>
						</li>
						
					</ul>
				</div>
			</div>
		</div>
		
	</div>
	
</div>
