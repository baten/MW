/* angular section */
var product = angular.module('product',[]);

product.controller('ProductAttributeController', ['$scope', function($scope) {
	$scope.AttrData = JSON.parse($('.AttrDataHolder').attr('attribute_array'));
	$scope.option_list =JSON.parse($('.product_type').attr('option_values'));
	$scope.type_categories = JSON.parse($('.product_type').attr('type_categories'));
	$scope.db_selected_type_categories = $('.current_categories').attr('data-current-selected-categories');

	//check is edit
	 var is_edit_form = function(){
		if($('.attr-inputs').attr('existing-values') != undefined){
			return JSON.parse($('.attr-inputs').attr('existing-values'));
		}else{
			return false;
		}
	};
	
	//set default product type 
	$scope.defaultSelectedType = function(){
		//DEFAULT ATTRIBUTE
		if(angular.isUndefined($('.product_type').attr('selected_value')) == true){
			var i = 0;
			$.each($scope.option_list,function(ind,val){
				if(i ==0){
					$scope.productType = ind;
				}
				i++;
			});
		}else{
			$scope.productType = $('.product_type').attr('selected_value');
		}
	};
	
	//check pruduct type
	$scope.checkProductType = function(){
		$scope.productType = $('.product_type').val();
	};
	
	//watch productType and filter attributes and values
	$scope.selected_attr = new Object();

	$scope.$watch('productType',function(){
		if($scope.productType != undefined){
			//process attribute by selected type
			$.each($scope.AttrData,function(ind,val){
				if(val.Type.id == $scope.productType){
					$scope.selected_attr = val.Attribute;
				}
			});
			//process category by selected type
			$scope.selected_type_categories = $scope.type_categories[$scope.productType];
		}else{
			$scope.defaultSelectedType();
		}
	});

	//process form according to filtered attribute and attribute value 
	$scope.$watch('selected_attr',function(){
		var attr_html = '';
		if(is_edit_form() == false){
			//for product add
			$.each($scope.selected_attr,function(ind,val){
				attr_html += '<div class="col-md-4">';
					attr_html += '<div class="attribute-id-holder" > <input type="checkbox" id= "'+val.id+'"  onchange="attrSelectDeselectChild(this,this.value)" value="'+val.id+'" name=data[Product][ProductAttribute]['+ind+'][attribute_id]> '+val.title +'</div>';
					$.each(val.AttributeValue,function(i,v){
						attr_html+= '<div><span class="pull-left"> <input class="'+val.id+'" onchange="attrSelect(this)" type="checkbox" value="'+v.id+'" name=data[Product][ProductAttribute]['+ind+'][ProductAttributeValue]['+i+'][attribute_value_id] > '+v.value+'</span>';
						if(v.has_price == 'yes'){
							attr_html+='<span class="pull-right"> <input style="width: 100px;"  name=data[Product][ProductAttribute]['+ind+'][ProductAttributeValue]['+i+'][discount] placeholder="Discount"></span>';
                            attr_html+='<span class="pull-right"> <input style="width: 100px;"  name=data[Product][ProductAttribute]['+ind+'][ProductAttributeValue]['+i+'][price] placeholder="Price"></span>';
						}
						attr_html+= '<div class="clearfix"></div></div>';
					});
				attr_html += '</div>';
			});
		}else{
			//for edit form
			var existing_value = is_edit_form();
			$.each($scope.selected_attr,function(ind,val){
				//attribute is checked or not 
				var attribute_checked = '';
				var existing_attribute_value_value = '';
				
				$.each(existing_value,function(existing_ind, existing_value){
					if(existing_value.attribute_id == val.id){
						attribute_checked  = 'checked';
						existing_attribute_value_value = existing_value.ProductAttributeValue;
					}
				});
					
				attr_html += '<div class="col-md-4">';
					attr_html += '<div class="attribute-id-holder"> <input type="checkbox" id= "'+val.id+'"  onchange="attrSelectDeselectChild(this,this.value)" value="'+val.id+'" name=data[Product][ProductAttribute]['+ind+'][attribute_id] '+attribute_checked+' > '+val.title +'</div>';
					//attribute value section
					$.each(val.AttributeValue,function(i,v){
						var existing_attribute_value_value_check = '';
						var price = '';
						var discount = '';
						$.each(existing_attribute_value_value,function(existing_value_ind, existing_value_value){
							if(existing_value_value.attribute_value_id == v.id){
								existing_attribute_value_value_check  = 'checked';
								price = 'value="'+existing_value_value.price+'"';
                                discount = 'value="'+existing_value_value.discount+'"';
							}
						});
						
						attr_html+= '<div><span class="pull-left"> <input type="checkbox" onchange="attrSelect(this)" class="'+val.id+'" '+existing_attribute_value_value_check+' value="'+v.id+'"  name=data[Product][ProductAttribute]['+ind+'][ProductAttributeValue]['+i+'][attribute_value_id] > '+v.value+'</span>';
						if(v.has_price == 'yes'){
							attr_html+='<span class="pull-right"> <input '+discount+' style="width: 100px;" name=data[Product][ProductAttribute]['+ind+'][ProductAttributeValue]['+i+'][discount] placeholder="Discount"></span>';
                            attr_html+='<span class="pull-right"> <input '+price+' style="width: 100px;" name=data[Product][ProductAttribute]['+ind+'][ProductAttributeValue]['+i+'][price] placeholder="Price"></span>';
						}
						attr_html+= '<div class="clearfix"></div></div>';
					});
				attr_html += '</div>';
			});
		}
		//print attribute and attribute value form
		$('.attr-inputs').empty().html(attr_html);
	});
	
	$scope.$watch('selected_type_categories',function(ind,val){
		//console.log(ind)
	});
	
	$scope.$watch('db_selected_type_categories',function(ind,val){
		//console.log($scope.db_selected_type_categories);
	});
	
	 
}]);


product.controller('discountController', ['$scope', function($scope) {
	$scope.salePrice = $scope.basePrice;
	$scope.calculateDiscount = function(){
		
		if($scope.discountType !== undefined){
			if($scope.discountType === 'fixed'){
				$scope.finalDiscount = $scope.discountAmount;
			}else if($scope.discountType === 'percentage'){
				$scope.finalDiscount = parseFloat((parseFloat($scope.basePrice) *parseFloat($scope.discountAmount)) / 100).toFixed(2);
			}else{
				$scope.finalDiscount = 0;
			}
			
			$scope.salePrice = ($scope.basePrice - $scope.finalDiscount);
		}else{
			$scope.salePrice = 0;
		}
		
	};
	
	
	$scope.$watch('discountType',function(nv,ov){
			if(angular.isUndefined($scope.discountType)){
				$scope.discountType = $('.discountType').attr('selectedValue');
				$scope.calculateDiscount();
			}else{
				$scope.discountType =  nv;
			}
			
	});
	
	$scope.$watch('finalDiscount',function(nv,ov){
		if(nv != ov){
			if(nv == 'NaN'){
				$scope.finalDiscount  = 0;
			}
		}
	});
	
	$scope.$watch('salePrice',function(nv,ov){
		if(nv!=ov){
			if(nv == 'NaN'){
				$scope.salePrice  = 0;
			}else{
				$scope.salePrice = parseFloat(nv).toFixed(2);
			}
		}
	});
	
}]);



//state list
function getState(vl,controller){
	$.ajax({
	   type: 'POST',
	   dataType: 'json',
	   url: controller+'ajax_getStates',
	   data: {countryId:vl}, 
	   success: function(data) {
		   $(".append_option_state").empty();
		   $(".append_option_state").append("<option value=' '>Please select...</option>"); 
		   $.each(data, function(index, value) { 
				$(".append_option_state").append("<option value='"+index+"'>"+value+"</option>"); 
			 }); 
	  	 }       
	}); 
} 


//city list
function getCity(vl,controller){
	
	$.ajax({
	   type: 'POST',
	   dataType: 'json',
	   url: controller+'ajax_getCities',
	   data: {countryId:vl}, 
	   success: function(data) {
		   $(".append_option").append("<option value=''>Please select</option>");
		   $.each(data, function(index, value) { 
			 
				$(".append_option").append("<option value='"+index+"'>"+value+"</option>"); 
			 }); 
	  	 }       
	}); 
} 

// check uncheck product attributes values
function attrSelectDeselectChild(selector,vl) {
	
	if ($(selector).is(':checked') == false) {
		$("."+vl).prop('checked', false);
	} else {
		$("."+vl).prop('checked', true);
	}
	
	
}

//check uncheck product attributes
function attrSelect(vl) {
	var cls = $(vl).attr('class');
	
	if ($("#"+cls).is(':checked') == false) {
		$("#"+cls).prop('checked', true);
	}  
	
}

//alter product status.

function alterStatus(vl,controller,method){
	$.ajax({
	   type: 'POST',
	   url: controller + '/' + method,
	   data: {productId:vl}, 
	   success: function(data) {
		   if(data == 'active'){
			   $("#status_" + vl).html('Active');
		   }else{
			   $("#status_" + vl).html('Inactive');
		   }
	   }
	}); 
}



//  get product attribute by product id

function getProductAttribute(productId){
    var productId = productId.value;

    $.ajax({
        type: 'POST',
        url: 'get_product_attributes',
        data: {productId:productId},
        success: function(data) {
            if(data){
                data = JSON.parse(data);
                var productKeieAttributeIdHtml = '<option value="'+data.Attribute.id+'">'+data.Attribute.title+'</option>';
                var productKeieAttributeValueIdHtml = '';
                $.each(data.AttributeValue, function(i,v){
                    productKeieAttributeValueIdHtml += '<option value="'+v.id+'">'+v.value+'</option>';
                });
                $('#ProductKeieAttributeId').html(productKeieAttributeIdHtml);
                $('#ProductKeieAttributeValueId').html(productKeieAttributeValueIdHtml);
            }

        }
    });

}


