<div class="row">
	<div class="header">
		<!-- logo -->
		<div class="col-md-2">		
			<?php                
                  echo $this->Html->link(
                      $this->Html->image("site/{$siteSettingsId}.png", array("alt" => "logo",'class'=>'mg-responsive admin-logo')),
                      "/",
                      array('escape' => false)
                  );
              ?>  
		</div>

		<!-- auth -->
		<?php if(!empty($auth_status)):?>
		<div class="col-md-4">
			<div class="admin-lang">			
				<a href="javascript:void(0)" onclick="changeLangs(this)" class="<?php echo ($langsName=='Bengali') ? 'selected':'';?>" data-name="Bengali" data-location="<?php echo $this->webroot;?>ajaxs/setSession"><span><img class="flag" src="<?php echo $this->webroot;?>img/shops/arab.png" alt="Arabic" />Arabic </span></a>
				<a href="javascript:void(0)" onclick="changeLangs(this)" class="<?php echo ($langsName=='English')? 'selected':'';?>" data-name="English" data-location="<?php echo $this->webroot;?>ajaxs/setSession"><span><img class="flag" src="<?php echo $this->webroot;?>img/shops/usa-flag.png" alt="English" />English</span></a>			
			</div>
		</div>
		<div class="col-md-6">
			<div class="dropdown">
				<?php echo $this->Html->link('<i class="fa fa-bars"></i>  <span class="badge" id="unviewdorder">unviewd Orders '.h($unviewdorders)."</span>",['controller'=>'product_orders','action'=>'unview','admin'=>true,'plugin'=>'ecommerce'],['id'=>'neworder','class'=>'btn btn-primary order-notify','escape'=>false]);?>
				<?php echo $this->Html->link('<i class="fa fa-user"></i> <span class="badge" id="newcustomer">new customer '.h($newcustomer)."</span>",['controller'=>'clients','action'=>'index','admin'=>true,'plugin'=>'timeout'],['id'=>'newcustomer','class'=>'btn btn-primary order-notify','escape'=>false]);?>
			</div>
			<div class="auth-user-action pull-right">
				
				<div class="dropdown">
					<div  data-toggle="dropdown">
						<span>
							<?php 
								
								$img_file = WWW_ROOT."img".DS."site".DS."avatars".DS.$auth_user['id'].".png";
								if(file_exists($img_file)):
									echo $this->Html->image("site/avatars/{$auth_user['id']}.png",array('class'=>'img-responsive pull-left avatar'));
								endif;
							?>
							<span class="auth_user_short_details">	
							<?php 
								$user_details = json_decode($auth_user['personal_details'],true);
								echo "  ". $user_details['first_name']." ".$user_details['last_name'];
							?>
							</span>
							
							
						</span>
						<span class="caret"></span>
					</div>
					<ul class="dropdown-menu" >
						<li>
							<?php echo $this->Html->link('Porfile',array('controller'=>'users','action'=>'edit',$auth_user['id'],'admin'=>true,'plugin'=>false))?>
						</li>
							
						<li>
							<?php echo $this->Html->link('Change Password',array('controller'=>'users','action'=>'change_password','admin'=>true,'plugin'=>false))?>
						</li>
						<li class="divider"></li>
						
						<li>
							<?php 
								if($auth_user['role_id'] == "54b0fd85-d824-4467-8cbe-18d0cdd1d5ac"):
									echo $this->Html->link('Sign Out',array('controller'=>'merchant_apis','action'=>'signout','admin'=>true,'plugin'=>'merchant'));
								else:
									echo $this->Html->link('Sign Out',array('controller'=>'users','action'=>'signout','admin'=>true,'plugin'=>false));
								endif;
								
								
								?>
						</li>
					</ul>
				</div>
			</div>
		<?php endif;?>
		</div>
	</div>
</div>

<style>
	.avatar{
		margin-right: 10px;
		margin-top: -8px;
		border-radius : 5%;
		
		border: 1px solid #ccc;
		
	}	
	.auth_user_short_details{
		font-weight: bold;
	}									
</style>
<script>

		document.addEventListener('DOMContentLoaded', function () {
			if (!Notification) {
				console.log('Desktop notifications not available in your browser. Try Chromium.');
				return;
			}

			if (Notification.permission !== "granted")
				Notification.requestPermission();
		});

		function notifyMe(title,message,link) {
			$logo=$("#logo").attr("src");

			if (Notification.permission !== "granted")
				Notification.requestPermission();
			else {
				var notification = new Notification(title, {
					icon: $logo,
					body: message,
				});

				notification.onclick = function () {
					window.open(link);
				};

			}

		}

		var unviewdorders=<?php echo h($unviewdorders);?>;
		var newcustomer=<?php echo h($newcustomer);?>;
		setInterval(function (){
			$.ajax({

				url: '<?php echo $this->Html->url(array(
					"controller" => "notifications",
					"action" => "index",
					'admin'=>true,
					'plugin'=>false
				));?>',
				method: 'GET'
			}).done(function(data) {

				notification=JSON.parse(data);

				if(notification.unviewdorders>unviewdorders)
				{
					notifyMe("NEW ORDER!!! ","You have new order to view",'<?php echo $this->Html->url(array(
						"controller" => "product_orders",
						"action" => "index",
						'admin'=>true,
						'plugin'=>'ecommerce'
					));?>');
					unviewdorders=notification.unviewdorders;
					$("#unviewdorder").html("Unviewed Order: "+unviewdorders);
				}
				if (notification.newcustomer>newcustomer)
				{
					notifyMe("NEW CUSTOMER!!!!", "new customer has registered to your site",'<?php echo $this->Html->url(array(
						"controller" => "clients",
						"action" => "index",
						'admin'=>true,
						'plugin'=>'timeout'
					));?>');
					newcustomer=notification.newcustomer;
					$("#newcustomer").html("New Customer: "+newcustomer);

				}



			});


		}, 15000)




	</script>