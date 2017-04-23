<div class="row">
	<!-- <div class="col-md-6">
		<div class="bar bar-primary bar-top">
			<h1 class="report-title"><i class="glyphicon glyphicon-cloud"></i> Website</h1>
		</div>
		<div class="clearfix report-details">
		
			<ul class="list-group">
				<li class="list-group-item">
					<span class="badge"><?php //echo $web_pages;?></span>
					<?php //echo $this->Html->link('Web Pages',['controller'=>'web_pages','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
				</li>
				
				<li class="list-group-item">
					<span class="badge"><?php //echo $web_links;?></span>
					<?php //echo $this->Html->link('Web Links',['controller'=>'menus','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
				</li>
			</ul>
		</div>
	</div> -->
	<!-- <div class="col-md-6">
		<div class="bar bar-primary bar-top">
			<h1 class="report-title"><i class="glyphicon glyphicon-globe"></i> Blog</h1>
		</div>
		<div class="clearfix report-details">
			<ul class="list-group">
				<li class="list-group-item">
					<span class="badge"><?php //echo $blog_posts;?></span>
					<?php //echo $this->Html->link('Blog Posts',['controller'=>'posts','action'=>'index','admin'=>true,'plugin'=>'blog'],['escape'=>false]);?>
				</li>
				<li class="list-group-item">
					<span class="badge"><?php //echo $blog_categories;?></span>
					<?php //echo $this->Html->link('Blog Categories',['controller'=>'blogCategories','action'=>'index','admin'=>true,'plugin'=>'blog'],['escape'=>false]);?>
				</li>
			</ul>
		
		</div>
	</div> 
</div>-->


	<div class="col-md-6">
		<div class="bar bar-primary bar-top">
			<h1 class="report-title"><i class="glyphicon glyphicon-shopping-cart"></i> Shopping</h1>
		</div>
		<div class="clearfix report-details">
			<ul class="list-group">
				<li class="list-group-item">
					<span class="badge"><?php echo $products;?></span>
					<?php echo $this->Html->link('Products',['controller'=>'products','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
				</li>
				<li class="list-group-item">
					<span class="badge"><?php echo $product_categoies;?></span>
					<?php echo $this->Html->link('Product Categories',['controller'=>'categories','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
				</li>
				
				<!-- <li class="list-group-item">
					<span class="badge"><?php //echo $product_brands;?></span>
					<?php //echo $this->Html->link('Product Brands',['controller'=>'brands','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
				</li> -->
			</ul>
		</div>
	</div>
	
	<!-- <div class="col-md-6">
		<div class="bar bar-primary bar-top">
			<h1 class="report-title"> <i class="glyphicon glyphicon-gift"></i> Stores</h1>
		</div>
		<div class="clearfix report-details">
			<ul class="list-group">
				<li class="list-group-item">
					<span class="badge"><?php //echo $stores;?></span>
					<?php //echo $this->Html->link('Web Stores',['controller'=>'stores','action'=>'index','admin'=>true,'plugin'=>'ecommerce'],['escape'=>false]);?>
				</li>
			</ul>	
		
		
		</div>
	</div> -->

</div>
<div class="row">
	<div class="col-md-6">
		<div class="bar bar-primary bar-top">
			<h1 class="report-title"> <i class="glyphicon glyphicon-user"></i> Users</h1>
		</div>
		<div class="clearfix report-details">
			<ul class="list-group">
				<li class="list-group-item">
					<span class="badge"><?php echo $users;?></span>
					<?php echo $this->Html->link('System Users',['controller'=>'users','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
				</li>
				
				<li class="list-group-item">
					<span class="badge"><?php echo $users;?></span>
					<?php echo $this->Html->link('Registered Users',['controller'=>'users','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
				</li>
			</ul>	
		
		</div>
	</div>	
</div>