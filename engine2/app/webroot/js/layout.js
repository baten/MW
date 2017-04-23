$(document)
		.ready(
				function() {
					var doc_height = $(document).height();
					var left_bar_heigth = doc_height - 60;
					$('.left-bar').height(left_bar_heigth);

					// process datepicker
					$(".datepicker").datepicker({
						dateFormat : "yy-mm-dd"
					});
					// editor

					// uploader
					var fullUrl = window.location.href;
					var result = fullUrl.split('admin');
					image_uploader_endpoints = result[0] + '/admin/media/ajax_uploader';
					image_manager_endpoints = result[0] + '/admin/media/ajax_image_manager';
					image_manager_delete_endpoints = result[0] + '/admin/media/ajax_image_delete';

					//
					$('.editor').editable({
						inlineMode : false,

						theme : 'gray',
						height : 300,
						// image upload
						imageUploadURL : image_uploader_endpoints,
						imageUploadParam : 'image',
						// imageUploadParams : {title :
						// 'title',short_description :'description'}

						// image manager
						imagesLoadURL : image_manager_endpoints,
						// delete_image
						imageDeleteURL : image_manager_delete_endpoints
					});

				});

// cms role management
function permission_select_deselect_child(selector) {

	if ($(selector).is(':checked') == false) {
		var check = false;
	} else {
		var check = true;
	}
	if ($(selector).parent().parent().hasClass('controller') == true) {
		var action_ul = $(selector).parent().next('ul');
		$.each(action_ul.children('li'), function(ind, val) {
			var cur_check_box = $(val).children('div').children('input');
			$(cur_check_box).prop('checked', check);
		});
	}
}

// menu
var menu = angular.module('menu', []);

menu.controller('menuController', [ '$scope', function($scope) {
	$scope.option_list = JSON.parse($('.menu-types').attr('option_values'));
	
	
	$scope.$watch('menuTypes', function() {
		//set default menu types
		if($scope.menuTypes == undefined){
			if($('.menu-types').attr('existing_value') != undefined){
				$scope.menuTypes = $('.menu-types').attr('existing_value');
				if($scope.menuTypes == 'content'){
					$('#MenuWebPages').val($('#MenuLinkData').val());
					$('#MenuLinkData').val('');
				}
				
			}else{
				$scope.menuTypes = 'content';
			}
		} 
		
		if($scope.menuTypes == 'content'){
			$('.web-page-list-on-menu').show();
			$('.menu-url-input').hide();
			$('#MenuLinkData').removeAttr('required');
			//$('#MenuLinkData').val('');
			
		}else{
			$('.menu-url-input').show();
			$('#MenuLinkData').attr('required','required');
			$('.web-page-list-on-menu').hide();
		}
		
	});
	
	$scope.checkMenuType = function() {
		$scope.menuType = $('.menu-types').val();
	};
	
} ]);


/*users*/
function processAvatarPreview(selector,preview_location){
	
	var file = selector.files[0];
	if(file){
		 var reader = new FileReader();
		 var file_data = reader.readAsDataURL(file);
		 reader.onload = function(evt){
			 $(preview_location).html('<img class="img-responsive" src="'+evt.target.result+'">');
		 };
	}
}

/*
function makeid(){
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
}
*/
var radioChange=function(name){
	var idd=$(name).attr('id');
	  if(idd=='CouponIsValidity0'){
	         $("#validitySecion").slideUp();    
	    }else{
	         $("#validitySecion").slideDown(); 
	    } 
    }; 

// Count
jQuery.fn.ForceNumericOnly = function()
        {
            return this.each(function()
            {
                $(this).keydown(function(e)
                {
                    var key = e.charCode || e.keyCode || 0;
                    // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
                    // home, end, period, and numpad decimal
                    return (
                        key == 8 || 
                        key == 9 ||
                        key == 13 ||
                        key == 46 ||
                        key == 110 ||
                        key == 190 ||
                        (key >= 35 && key <= 40) ||
                        (key >= 48 && key <= 57) ||
                        (key >= 96 && key <= 105));
                });
            });
        };

$("#count").ForceNumericOnly();

$(".fa-angle-right").click(function(){
lol = document.getElementById('count').value;

    $('#count').val( function(i, oldval) {
        return parseInt( oldval, 10) + 1;
    });
});

$(".fa-angle-left").click(function(){
lol = document.getElementById('count').value;

    $('#count').val( function(i, oldval) {
        var numVal=parseInt( oldval, 10) - 1;
        if(numVal >= 0){
            return numVal;
        }else{
            return 0;
        }
    });
});

function changeLangs(selector){
	 var tis = $(selector);
    var val=tis.data('name');  
    jQuery.ajax({
       type: "POST",
       url: tis.data('location'),
       data: { languageName: val},                                          
       success: function(result){       
           window.location.reload();
       }
     });
}

$('#clientselect').selectize();
$('#productselect').selectize();




