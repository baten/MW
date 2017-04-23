<style type="text/css">
    .checkbox{      
        margin-left: 30px;
    }
    .checkbox label{
        padding-left: 20px;
    }
     input[type="radio"].ingredients, input[type="checkbox"].ingredients{
        margin-left: 0;
    }
    .radio label{
        padding-right: 20px;
    }
    .indent{
        margin-left: 60px;
    }
</style>
<div class="row bar bar-primary bar-top">
    <div class="col-md-12">
        <h1 class="bar-title"><?php echo __('Admin Add Product'); ?></h1>
    </div>
</div>
<div class="row bar bar-secondary">
    <div class="col-md-12">
        <?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Products', array('action' => 'index', 'admin' => true), array('escape' => false, 'class' => 'btn btn-success')); ?>
    </div>
</div>

<div class="row bar bar-third">
    <div class="col-md-12">
        <?php
        echo $this->Form->create('Product', array('class' => 'form', 'type' => 'file'));
        ?>

        <div class="row">
            <div class="col-md-12" data-ng-app='product'>

               <div class="row">
                    <div class="col-md-6" data-ng-controller='discountController'>
                        <?php
                        echo $this->Form->input('Product.merchant_id', array('class' => 'form-control', 'div' => array('class' => 'form-group')));
                        echo $this->Form->input('Product.team_id', array('class' => 'form-control', 'empty'=>array(''=>'Please select..'),'div' => array('class' => 'form-group')));
						echo $this->Form->input('title', array('class' => 'form-control', 'div' => array('class' => 'form-group')));
						echo $this->Form->input('product_code', array('class' => 'form-control', 'div' => array('class' => 'form-group')));
						echo $this->Form->input('sku', array('label'=>'SKU','class' => 'form-control', 'div' => array('class' => 'form-group')));
                        echo $this->Form->input('meta_keys', array('class' => 'form-control', 'div' => array('class' => 'form-group')));
						echo $this->Form->input('meta_description', array('type' => 'textarea', 'class' => 'form-control', 'div' => array('class' => 'form-group')));
                        echo $this->Form->input('price',array('label'=>'Price','data-ng-change'=>'calculateDiscount()','min'=>'0','data-ng-model'=>'basePrice', 'class'=>'form-control','div'=>array('class'=>'form-group')));
                        echo $this->Form->input('discount.0.type',array('data-ng-change'=>'calculateDiscount()','data-ng-model'=>'discountType','options'=>array('0'=>'Please select...','fixed'=>'Fixed','percentage'=>'Percentage'),'label'=>'Discount Type', 'class'=>'form-control','div'=>array('class'=>'form-group')));
                        echo $this->Form->input('discount.1.amount',array('type'=>'number','min'=>'0', 'data-ng-change'=>'calculateDiscount()','label'=>'Discount Amount','data-ng-model'=>'discountAmount', 'class'=>'form-control','div'=>array('class'=>'form-group')));
                        echo $this->Form->input('sale_price',array('label'=>'Discounted Price','min'=>'0','value'=>'{{salePrice}}','class'=>'form-control','div'=>array('class'=>'form-group')));
                        echo $this->Form->input('opening_price',array('label'=>'Opening Unit Price','min'=>'0', 'class'=>'form-control','div'=>array('class'=>'form-group')));
                        echo $this->Form->input('quantity', array('label'=>'Opening Quantity','class' => 'form-control', 'div' => array('class' => 'form-group')));
                        ?>
                        <!-- <div class="group-control">
						<strong>Base Price : ৳  </strong>{{basePrice}} 
						<strong>Discount : ৳  </strong>{{finalDiscount}}
						<strong>Sale Price : ৳  </strong>{{salePrice}}  
					</div> -->
                    </div> 
					
                    <div class="col-md-6">                     
                        <?php
                        echo $this->Form->input('short_description', array('type' => 'textarea',  'rows'=>4, 'class' => 'form-control', 'div' => array('class' => 'form-group')));                               
                        echo $this->Form->input('description', array('label'=>'Long Description','type' => 'textarea', 'class' => 'editor form-control','div' => array('class' => 'form-group')));
                        ?> 
                    </div>
                </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="panel-title">Categories</div>
                                </div>
                                <div class="panel-body category-brand-box">
                                   <?php   
                                    foreach ($catNode as $key => $value) {
                                        echo $this->Form->input('categories'.$value['Category']['id'], 
                                            array('div' => false,
                                            'label' => false,
                                            'name'=>'data[Product][ProductCategory][][category_id]',
                                            'value' =>$value['Category']['id'],
                                            'type' => 'checkbox',
                                            'before' => '<label class="checkbox">',
                                            'after' => $value['Category']['title'].'</label>',
                                             'hiddenField' => false,
                                            )); 
                                       if(count($value['children'])>0){
                                            foreach ($value['children'] as $key => $val) {
                                            echo $this->Form->input('categories'.$value['Category']['id'], 
                                                array('div' => false,
                                                'name'=>'data[Product][ProductCategory][][category_id]',
                                                'label' => false,
                                                'value' =>$val['Category']['id'],
                                                'type' => 'checkbox',
                                                'before' => '<label class="checkbox indent">',
                                                'after' => $val['Category']['title'].'</label>',
                                                'hiddenField' => false,
                                                )); 
                                            if(count($val['children'])>0){
                                            	foreach ($val['children'] as $k => $vl) {
                                            		echo $this->Form->input('categories'.$val['Category']['id'],
                                            			array('div' => false,
                                            				'name'=>'data[Product][ProductCategory][][category_id]',
                                            				'label' => false,
                                            				'value' =>$vl['Category']['id'],
                                            				'type' => 'checkbox',
                                            				'before' => '<label class="checkbox indent-child">',
                                            				'after' => $vl['Category']['title'].'</label>',
                                            				'hiddenField' => false,
                                            			));
                                            	}
                                            }
                                            }
                                        }
                                    }

                                   ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
							<div class="panel panel-info">
								<div class="panel-heading">
									<div class="panel-title">Brands</div>
								</div>
								<div class="panel-body category-brand-box">
								<?php 
									static $i = 0;
									foreach($productBrands as $b_id => $b_title):
										echo "<label class='checkbox' style='margin-left : 20px;'>".$this->Form->input("Product.ProductBrand.{$i}.brand_id",array('type'=>'checkbox','value'=>$b_id,'label'=>false,'div'=>false))." {$b_title}</label>";
									$i++;
									endforeach;
								?>
							</div>
						</div>
					</div>
                    </div>
                    <!-- 
					<div class="row">
                        <div class="col-md-6">
							<div class="panel panel-info">
								<div class="panel-heading">
									<div class="panel-title">Brands</div>
								</div>
								<div class="panel-body category-brand-box">
								<?php 
									/* static $i = 0;
									foreach($productBrands as $b_id => $b_title):
										echo "<label class='checkbox' style='margin-left : 20px;'>".$this->Form->input("Product.ProductBrand.{$i}.brand_id",array('type'=>'checkbox','value'=>$b_id,'label'=>false,'div'=>false))." {$b_title}</label>";
									$i++;
									endforeach; */
								?>
							</div>
						</div>
					</div>
					<div class="col-md-6">
							<div class="panel panel-info">
								<div class="panel-heading">
									<div class="panel-title">Sports</div>
								</div>
								<div class="panel-body category-brand-box">
								<?php 
									/* static $i = 0;
									foreach($productSports as $b_id => $b_title):
										echo "<label class='checkbox' style='margin-left : 20px;'>".$this->Form->input("Product.ProductSport.{$i}.sport_id",array('type'=>'checkbox','value'=>$b_id,'label'=>false,'div'=>false))." {$b_title}</label>";
									$i++;
									endforeach; */
								?>
							</div>
						</div>
					</div>
				</div>
				-->
			    <div class="row">
                    <?php foreach($attributes as $key => $value) : ?>
                    	<div class="col-md-4">
							<div class="attribute-id-holder" > <input type="checkbox" id= "<?php echo $value['Attribute']['id']?>"  onchange="attrSelectDeselectChild(this,this.value)" value="<?php echo $value['Attribute']['id']?>" name="data[Product][ProductAttribute][<?php echo $key ;?>][attribute_id]"> <?php echo $value['Attribute']['title'];?></div>
					 		<?php foreach ($value['AttributeValue'] as $k => $vl):?>
					 			<div><span class="pull-left"> <input class="<?php echo $value['Attribute']['id']?>" onchange="attrSelect(this)" type="checkbox" value="<?php echo $vl['id']?>" name=data[Product][ProductAttribute][<?php echo $key;?>][ProductAttributeValue][<?php echo $k;?>][attribute_value_id] ><?php echo $vl['value']?></span><div class="clearfix"></div></div>
					 		<?php endforeach;?>
						 
					 </div>
					<?php endforeach;?>
					 
                   
                </div>
                <div class="row">
					<div class="col-md-12">
						<div class="panel panel-info">
							<div class="panel-heading">
								<div class="panel-title">Related Products</div>
							</div>
							<div class="panel-body category-brand-box">
								<?php 
									 echo $this->Form->input("Product.RelatedProduct.related_product", array(
									    'label' => false,
									    'type' => 'select',
									    'multiple' => 'checkbox',
									    'options' => $productList,
										'hiddenField' => false
									  ));
								
								?>
							</div>
						</div>
					</div>
				</div>
                <!-- Upload Images -->
            <div class="row"> 
               
            <?php
                echo $this->Form->input('status', array('options' => $status, 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-12')));
            ?>
               

               
            
            </div>

            </div>
        </div>
 
            
        <!-- Image uploading -->
        <div class="row">
            <div class="col-md-12">
                <div class="row padding-bottom-10">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="pull-left"> Upload Images </label>
                            <span class="pull-right btn btn-info"
                                  onclick="uploadMoreImage()"> Upload More Images </span>
                        </div>
                    </div>
                </div>
                <div class="image-uploader-div">
                    <div class="row image-uploader-div-row">
                        <div class="col-md-4 individual-image">
                            <div class="form-group">
                                <span><input type="file" name="data[Product][ProductImage][]" required
                                             onchange="processPreview(this)" class="product-image-input-field"></span>

                                <div class="clearfix"></div>
                            </div>
                            <div class="image-preview "></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md12">
            <?php
            echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-warning', 'label' => false, 'div' => false));
            echo $this->Form->button('Submit', array('type' => 'submit', 'class' => 'btn btn-success btn-left-margin', 'label' => false, 'div' => false));

            echo $this->Form->end();
            ?> 
            </div>
        </div>
    </div>
</div>
<?php echo $this->Html->script(array('Ecommerce.product','Ecommerce.filesystem')); ?>

<style type="text/css">
    .attribute-id-holder {
        font-weight: bold;
        border-bottom: 1px solid #ccc;
        margin-bottom: 5px;
    }
    .indent-child{margin-left: 100px}
</style>

<?php echo $this->start('script');?>
<script>
function spicy(selector){
  $('.'+selector).prop('checked', false);
}
</script>
<?php echo $this->end();?>



