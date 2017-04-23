
function uploadMoreImage(){
	var upload_form_html = '\
	<div class="col-md-4 individual-image">\
		<div class="form-group">\
			<span class="pull-left">\
				<input type ="file" required name="data[Product][ProductImage][]" class="product-image-input-field" onchange="processPreview(this)">\
			</span>\
			<span class="pull-right btn btn-danger btn-xs" onclick="removeImage(this)">Remove</span>\
			<div class="clearfix"></div>\
		</div>\
		<div class="image-preview"></div>\
	</div>';
		
	$('.image-uploader-div-row').append(upload_form_html);
	
	var count_individual_image = $('.individual-image');
	$('.row-divider-upload').remove();
	$.each(count_individual_image,function(ind,val){
		
		if((ind+1) % 3 == 0){
			$(val).after('<div class="clearfix row-divider-upload"></div>');
		}
		
	})
}

function removeImage(selector,filename){
	if($('.individual-image').length > 1){
		if(filename == undefined){
			var div_loc = $(selector).parent().parent();
			div_loc.remove();
		}else{
			$.ajax({
				url : '../delete_product_image_by_id',
				data : {image_id :filename},
				type : 'POST'
			}).done(function(data){
				if(data == 'success'){
					var div_loc = $(selector).parent().parent();
					div_loc.remove();
				}else{
					alert('Image Can not be removed, Please try again.');
				}
			}).error(function(){
				window.location.replace(window.location.protocol+'//'+window.location.host+window.location.pathname);
			});
			
		}
	}else{
		alert('Minimum One image is necessary for products');
	}
	
}

function processPreview(selector){
	var preview_location = $(selector).parent().parent().parent().children('.image-preview');
	var file = selector.files[0];
	if(file){
		 var reader = new FileReader();
		 var file_data = reader.readAsDataURL(file);
		 reader.onload = function(evt){
			 preview_location.html('<img class="img-responsive upload-image-thumbnail" src="'+evt.target.result+'">')
		 }
	}
}
