(function ($) {
    'use strict';

  //Initiat WOW JS
  new WOW().init();
// RS Slider
jQuery('.tp-banner').show().revolution(
{
    dottedOverlay:"none",
    delay:16000,
    startwidth:1170,
    startheight:700,
    hideThumbs:200,

    thumbWidth:100,
    thumbHeight:50,
    thumbAmount:5,

    navigationType:"bullet",
    navigationArrows:"solo",
    navigationStyle:"preview4",

    touchenabled:"on",
    onHoverStop:"on",

    swipe_velocity: 0.7,
    swipe_min_touches: 1,
    swipe_max_touches: 1,
    drag_block_vertical: false,

    parallax:"mouse",
    parallaxBgFreeze:"on",
    parallaxLevels:[7,4,3,2,5,4,3,2,1,0],

    keyboardNavigation:"off",

    navigationHAlign:"right",
    navigationVAlign:"bottom",
    navigationHOffset:120,
    navigationVOffset:20,

    soloArrowLeftHalign:"left",
    soloArrowLeftValign:"center",
    soloArrowLeftHOffset:20,
    soloArrowLeftVOffset:0,

    soloArrowRightHalign:"right",
    soloArrowRightValign:"center",
    soloArrowRightHOffset:20,
    soloArrowRightVOffset:0,

    // shadow:0,
    // fullWidth:"on",
    // fullScreen:"on",

    shadow:0,
    fullWidth:"on",
    fullScreen:"off",

    spinner:"spinner4",

    stopLoop:"off",
    stopAfterLoops:-1,
    stopAtSlide:-1,

    shuffle:"off",
    autoHeight:"off",                       
    forceFullWidth:"off",                       

    hideThumbsOnMobile:"off",
    hideNavDelayOnMobile:1500,                      
    hideBulletsOnMobile:"off",
    hideArrowsOnMobile:"off",
    hideThumbsUnderResolution:0,

    hideSliderAtLimit:0,
    hideCaptionAtLimit:0,
    hideAllCaptionAtLilmit:0,
    startWithSlide:0,
    fullScreenOffsetContainer: ".header"    
});



// STIKY MENU
$(window).scroll(function(){ 
    if ($(this).scrollTop() > 10){      
      $('.header-wrapper').addClass("navbar-fixed-top");
  } else{
      $('.header-wrapper').removeClass("navbar-fixed-top");
  }
});

$(window).scroll(function(){ 
    if ($(this).scrollTop() > 10){    
      var headertopwidth=$('.wrapper').width();
      $('.header-top').css("width", headertopwidth);   
      $('.header-top').addClass("header-top-fixed-top");
      
      // alert(headertopwidth);
  } else{
      $('.header-top').removeClass("header-top-fixed-top");
  }
});
$(window).resize(function(){
    // location.replace(location.href);
    // alert('working');
    // $('.loader').css('display', 'block');
    // setTimeout(function(){ $('.loader').fadeOut(); }, 1000);
        var headertopwidthresize=$('.wrapper').width();
      //   alert(headertopwidthresize);
      $('.header-top').css('width', headertopwidthresize);
      // location.reload();
      // refresh();
});
//refresh page on browser resize
// $(window).bind('resize', function(e)
// {
//   console.log('window resized..');
//   this.location.reload(false); /* false to get page from cache */
//   /* true to fetch page from server */
// });
// function refresh() { window.location.reload(true); }
// $(window).on('resize',function(){location.reload();});

// FLAG DROP DOWN
$(".dropdown img.flag").addClass("flagvisibility");

$(".dropdown dt a").on("click", function() {
    $(".dropdown dd ul").toggle();
});

$(".dropdown dd ul li a").on("click", function() {
    var tis = $(this);
    var text=tis.html();
    var val=tis.data('name');  
    $(".dropdown dt a span").html(text);
    $(".dropdown dd ul").hide(); 
   /* if(val=='English'){
        var fullUrl=window.location.href;
        var hostName=window.location.hostname;
        var replaceUrl=fullUrl.replace(hostName,hostName+'/en');
        window.location.href=replaceUrl;
    }*/
    jQuery.ajax({
       type: "POST",
       url: tis.data('location'),
       data: { languageName: val},                                          
       success: function(result){       
           window.location.reload();
          // window.location.href=window.location.href;
       }
     });

});

function getSelectedValue(id) {
    return $("#" + id).find("dt a span.value").html();
}

$(document).on("click", function(e) {
    var $clicked = $(e.target);
    if (! $clicked.parents().hasClass("dropdown"))
        $(".dropdown dd ul").hide();
});
  // DATEPICKER 
  $(function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
    $( "#datepicker-sidebar" ).datepicker({ dateFormat: 'dd-mm-yy' });
});

 // BOOK A TABLE NOW
 $(function() {
    $( ".book-now-wrapper .toggle" ).on("click", function() {
      $( ".book-now" ).toggleClass( "open", 150 );
  });
});

 // SIGNATURE DISHES START
 $(function () {
    $('#owl-dishes').owlCarousel({
        loop:true,
        margin:0,
        autoplay:true,
        dots:false,
        responsive:{
            320:{
                items:1
            },
            480:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });

    var owl = $('#owl-dishes');
    owl.owlCarousel();
    $('.owl-controls .next').on("click", function() {
      owl.trigger('next.owl.carousel');
  });
    $('.owl-controls .prev').on("click", function() {
      owl.trigger('prev.owl.carousel', [300]);
  });
}());


// LOADER
setTimeout(function(){ $('.loader').fadeOut(); }, 1000);

//back-top
var offset = 300,
scroll_top_duration = 1500,
$back_to_top = $('.back-top');

 //smooth scroll to top
 $back_to_top.on('click', function(event){
    event.preventDefault();
    $('body,html').animate({
      scrollTop: 0 ,
  }, scroll_top_duration
  );
});

// Google Pop Up
$(window).load(function(){
    $('.popup-section').fadeOut();
    var high = "";
    high=$(".booking-back").height(); 
    $(".book-table-wrapper .booking-image img").css("height", high+190);  
});

$("#map").on("click", function(){
    $(".popup-section").css("top", "0");
    $(".popup-section").fadeIn(500);
});
$(".cross").on("click", function(){

    $(".popup-section").fadeOut(500);
});
$(window).resize(function(){
        $(".popup-section").css("top", "5000px");
        $(".popup-section").fadeIn();
});

// Search
$("#search").on("click", function(){
  $( ".search-wrapper" ).show(100);
});
$(".search-contents .close").on("click", function(){
  $( ".search-wrapper" ).fadeOut( 500);
});

//tweet feed
// $('.tweet-feed .tweet').twittie({
//     dateFormat: '%b. %d, %Y',
//     template: ' <p class="media"><div class="avatar media-left"><a href="http://twitter.com/ThemeRole" target="_blank"<i class="twitter-avatar flaticon-twitter1"></i> </a></div> <div class="twt-area media-body"><div class="screen-name">{{screen_name}} </div> {{tweet}} <div class="url-s"> </div> </p> <div class="date">{{date}}</div></div>',
//     count: 2,
//     apiPath: 'js/api/tweet.php',
//     loadingText: 'Loading......'
// });


// Css Preseter
// $(".preset-wrapper .icon-holder").on("click", function(){
//   $( ".preset-wrapper .holder" ).toggleClass( "open",500);

// });

// Blog
 $(window).on("load",function(){
    var long=$(".event-holder .long-img").height();
    var horizontal =$(window).width();

    if(horizontal > 767){
      $(".long.img-content").css("height", long);
    $(".event-holder .wide").css("height", long);  
    } 
  });

// Gallery shuffle
// (function () {
    
//         var $grid = $('#grid');
//         $grid.shuffle({
//             itemSelector: '.portfolio-item' 
//         });

//         $('#filter li').click(function (e) {
//             e.preventDefault();
//             $('#filter li').removeClass('active');
//             $(this).addClass('active');
//             var groupName = $(this).attr('data-group');
//             $grid.shuffle('shuffle', groupName );
//         });
    
//     }()); 

    // -----------------------------------------------------------------
    //jQuery for page scrolling feature - requires jQuery Easing plugin
    // ------------------------------------------------------------------

    (function () {
        $('a.page-scroll').bind('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });
    }());


// mmenu
            // $(function() {
            //     var $menu = $('nav#menu'),
            //         $html = $('html, body');

            //     $menu.mmenu({
            //         dragOpen: true,
            //     });

            //     var $anchor = false;
            //     $menu.find( 'li > a' ).on(
            //         'click',
            //         function( e )
            //         {
            //             $anchor = $(this);
            //         }
            //     );

            //     var api = $menu.data( 'mmenu' );
            //     api.bind( 'closed',
            //         function()
            //         {
            //             if ( $anchor )
            //             {
            //                 var href = $anchor.attr( 'href' );
            //                 $anchor = false;

                            
            //                 if ( href.slice( 0, 1 ) == '#' )
            //                 {
            //                     $html.animate({
            //                         scrollTop: $( href ).offset().top
            //                     }); 
            //                 }
            //             }
            //         }
            //     );
            // });


$(function() {
                var $menu = $('nav#menu'),
                    $html = $('html, body');

                $menu.mmenu({
                    dragOpen: true,
                    navbars     : [
                        {
                            position    : 'top',
                            content     : [
                                'prev',
                                'title',
                                'close'
                            ]
                        }
                    ]
                });

                var $anchor = false;
                $menu.find( 'li > a' ).on(
                    'click',
                    function( e )
                    {
                        $anchor = $(this);
                    }
                );

                var api = $menu.data( 'mmenu' );
                api.bind( 'closed',
                    function()
                    {
                        if ( $anchor )
                        {
                            var href = $anchor.attr( 'href' );
                            $anchor = false;

                            //  if the clicked link is linked to an anchor, scroll the page to that anchor 
                            if ( href.slice( 0, 1 ) == '#' )
                            {
                                $html.animate({
                                    scrollTop: $( href ).offset().top
                                }); 
                            }
                        }
                    }
                );
            });


// Preset JS
templateOptions();

// carousel
$('.carousel').carousel();

// Fancy box
$('.fancybox').fancybox();



}(jQuery));



  function myFunction(selector) {    
    var link=$(selector).data('link');
     window.open(link, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=40, left=50, width=300, height=400");
}
/*---------------------
    Single  product Zoom
    --------------------- */
    $('.simpleLens-big-image').simpleLens({
        loading_image: 'demo/images/loading.gif'
    });

// Detailed Page Confirmation
$("#confirm").click(function(){
    // $("").fadeIn();
    $(".detailed-wrapper #confirm-wrapper").css("visibility", "visible"); 
}); 

// Cart Menu
$(window).scroll(function(){
    var menu_ecom_width=$('.menu-ecom-container').width(); 
    var cart_ecom_width=$('.cart-ecom-container').width();
    var horizontal =$(window).width();

    if(horizontal > 767){

    if ($(this).scrollTop() > 60){      
      $('.menu-ecom').addClass('position');
      $('.menu-ecom.position').css('width', menu_ecom_width);
      $('.cart-ecom-wrapper').addClass('position');
      $('.cart-ecom-wrapper.position').css('width', cart_ecom_width);
      // $("body, html").animate({ scrollTop: $( '#appetizer' ).offset().top }, 600);
  } else{
      $('.menu-ecom').removeClass("position");
      $('.menu-ecom.position').css('width', 'auto');
      $('.cart-ecom-wrapper').removeClass("position");
      $('.cart-ecom-wrapper.position').css('width', 'auto');
  }
    }
});
// Search Form .search-form-wrapper
$(window).scroll(function(){
    var search_horizontal = $(window).width();
    if(search_horizontal < 767){ 
        if ($(this).scrollTop() > 60){
            $('.search-form-wrapper').addClass('position');
        } else{
            $('.search-form-wrapper').removeClass('position');
        }

    }
    if(search_horizontal > 767){ 

        var search_width=$('.new-search-wrapper').width();
        var search_height=$('.menu-ecom-wrapper .menu-ecom').height();
        
        $('.search-form-wrapper').css('width', search_width);
        // $('.search-form-wrapper.position1').css('top', search_height+76);
        $('.search-form-wrapper.position1').css('top', 96);
        if(search_horizontal > 767 && search_horizontal < 1023){
            $('.search-form-wrapper.position1').css('top', 120);
        }
        

        if ($(this).scrollTop() > 60){
            // $('.new-search-wrapper').css('width', search_width);
            $('.search-form-wrapper').addClass('position1');

        } else{
            $('.search-form-wrapper').removeClass('position1');
        }

    }
});

// Smoothly scroll
$(".menu-ecom li a").on("click", function( e ) {
    
    e.preventDefault();
    $("body, html").animate({ 
        scrollTop: $( $(this).attr('href') ).offset().top-160 
    }, 600);
    
});
$(".cart-icon-holder").on("click", function( e ) {
    $('.cart-ecom-container').addClass("mobile-position");
    $('.cart-ecom-container').fadeIn();
});
$(".cart-ecom-wrapper .cart-header .cross").on("click", function( e ) {
    $('.cart-ecom-container').fadeOut();
});

$("#ecom-popup").on("click", function( e ) {
    $('.ecom-popup-wrapper').fadeIn();
});

$(".ecom-popup-wrapper .popup-contents .cross").on("click", function( e ) {
    $('.ecom-popup-wrapper').fadeOut();
});

$("#atr-btm-1").on("click", function( e ) { 
    $('#atr-top-1').fadeIn();
    $('#attribute-bottom').css("display", "none"); 
});
$("#atr-btm-2").on("click", function( e ) { 
    $('#atr-top-2').fadeIn();
    $('#attribute-bottom').css("display", "none"); 
});
$("#atr-top-1").on("click", function( e ) { 
    $('#atr-top-1').hide();
    $('#attribute-bottom').delay(1500).css("display", "block"); 
});
$("#atr-top-2").on("click", function( e ) { 
    $('#atr-top-2').hide();
    $('#attribute-bottom').delay(1500).css("display", "block"); 
});

// Food Menu Width Count
$(document).ready(function() {
 var width_count=$(".menu-ecom-wrapper .menu-ecom").width();
 $(".menu-ecom-wrapper .menu-ecom ul").css("width", width_count+40);

 $(window).resize(function(){
    var width_count=$(".menu-ecom-wrapper .menu-ecom").width();
    $(".menu-ecom-wrapper .menu-ecom ul").css("width", width_count+40);
});

});

/*// Food Menu Data Group
$(window).scroll(function() {

    if ($(".menu-ecom-wrapper .menu-ecom li ul li[data-group='wok']").hasClass("active")){
        $(".menu-ecom-wrapper .menu-ecom li[data-main='wok']").addClass("active");
    }

});
*/

// MObile cart icon

// $('.menu-heading-ecom').on("scroll", function( e ) {
//      alert('working');
// });
// if(navigator.userAgent.indexOf("Safari")!=-1 && navigator.userAgent.indexOf("Chrome")==-1){

//         $("<link/>", {
//            rel: "stylesheet",
//            type: "text/css",
//            href: "css/radio-safari.css"
//         }).appendTo("head");
//     }


// if(navigator.userAgent.indexOf("Chrome")!=-1 && navigator.userAgent.indexOf("Safari")==-1){

//         $("<link/>", {
//            rel: "stylesheet",
//            type: "text/css",
//            href: "css/radio-chrome.css"
//         }).appendTo("head");
//     }


// Scroll Spy Start
var lastId,
    topMenu = $(".menu-ecom"),
    topMenuHeight = topMenu.outerHeight()+15,
    // All list items
    menuItems = topMenu.find("a"),
    // Anchors corresponding to menu items
    scrollItems = menuItems.map(function(){
      var item = $($(this).attr("href"));
      if (item.length) { return item; }
    });

// Bind click handler to menu items
// so we can get a fancy scroll animation
menuItems.click(function(e){
  var href = $(this).attr("href"),
      offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;
  $('html, body').stop().animate({ 
      scrollTop: offsetTop
  }, 300);
  e.preventDefault();
});

// Bind to scroll
$(window).scroll(function(){
   // Get container scroll position
   var fromTop = $(this).scrollTop()+topMenuHeight;
   
   // Get id of current scroll item
   var cur = scrollItems.map(function(){
     if ($(this).offset().top < fromTop)
       return this;
   });
   // Get the id of the current element
   cur = cur[cur.length-1];
   var id = cur && cur.length ? cur[0].id : "";
   
   if (lastId !== id) {
       lastId = id;
       // Set/remove active class

     topMenu.find('ul').removeClass("active"); 
     menuItems.parent().removeClass("active");

     fil=menuItems.filter("[href='#"+id+"']");
     fill=fil.parent();
     
     fill.addClass("active");
     fill.parent().addClass("active");
     fill.parent().parent().addClass("active");       
   } 
       
});

// Scroll Spy End

jQuery(window).load(function() {
    //jQuery("#basketItemsWrap li:first").hide();
    jQuery(".basketproduct").click(function() {   
        var tis               = $(this);
        var productIDVal      = tis.data('productid'); 
        var menuupdate        =tis.data('menuupdate');        
                
        tis.parent('.loading_animation').find('img').show();

            jQuery.ajax({  
                type: "POST",  
                url: tis.data('add'),  
                data: { productID: productIDVal, action: "addToBasket", quantity: 1 },  
                success: function(theResponse) {
                   // jQuery("#fancy_notification").html(theResponse);
                    tis.parent('.loading_animation').find('img').hide();                    
                   
                    // var pos = jQuery("#basketproduct").position();
                    // var width = jQuery("#basketproduct").outerWidth();
                    
                    // jQuery("#fancy_notification").css({
                    //         top: pos.top + 30 + "px",
                    //         left: pos.left + 0 + "px"
                    //     }).show();
                    
                    // jQuery('#fancy_notification_content').show();
                    
                    jQuery.ajax({
                       type: "POST",
                       url: tis.data('title'),                                         
                       success: function(result){       
                            jQuery(".updatecarsummary").html(result);
                       }
                     });  
                     
                     jQuery.ajax({
                       type: "POST",
                       url: tis.data('top'),                                              
                       success: function(result){       
                            jQuery(".countcarttotal").html(result);
                       }
                     });  
                     
                     jQuery.ajax({
                       type: "POST",
                       url: tis.data('update'),                                            
                       success: function(result){       
                            jQuery("#updatemycart").html(result);                           
                       }
                     });

                    if(menuupdate){
                      jQuery.ajax({
                               type: "POST",
                               url: menuupdate,                                            
                               success: function(result){
                                    jQuery("#cart-body-holder").html(result);
                               }
                             });  
                        }                    

                }  
            }); 
        return false;
    });
    
});

function updateMenuCart(selector){
        var tis               = $(selector);
        var productIDVal      = tis.attr('id'); 
        var qtyVal            =tis.val();  
      
            jQuery.ajax({  
                type: "POST",  
                url: tis.data('add'),  
                data: { productID: productIDVal, action: "updateToBasket", quantity: qtyVal },  
                success: function(theResponse) {                   
                    
                    jQuery.ajax({
                       type: "POST",
                       url: tis.data('title'),                                         
                       success: function(result){       
                            jQuery(".updatecarsummary").html(result);
                       }
                     });  
                     
                     jQuery.ajax({
                       type: "POST",
                       url: tis.data('top'),                                              
                       success: function(result){       
                            jQuery(".countcarttotal").html(result);
                       }
                     });  
                     
                     jQuery.ajax({
                       type: "POST",
                       url: tis.data('update'),                                            
                       success: function(result){       
                            jQuery("#updatemycart").html(result);                           
                       }
                     });
                    
                     jQuery.ajax({
                               type: "POST",
                               url: tis.data('menuupdate'),                                            
                               success: function(result){
                                    jQuery("#cart-body-holder").html(result);
                               }
                             });    

                }  
            }); 
        return false;
}

// -------------------------
function addpasswordfield(selector,params){
     var obj=document.getElementById(params);
    if(selector.checked){
        // obj.style.display='block';
        obj.innerHTML='<input id="ClientPassword" class="form-control" type="password" required="required" placeholder="Password *" name="data[Client][password]">';
    }else{
      // obj.style.display='none';
      obj.innerHTML="";
    }   
}

$(document).ready(function(e) {
    var selector=document.getElementById('account'); 
    var obj=document.getElementById('pass-fld'); 
    if(selector!=null){
     if(selector.checked){     
        obj.innerHTML='<input id="ClientPassword" class="form-control" type="password" required="required" placeholder="Password *" name="data[Client][password]">';
     }
    }    
});

function usernameCheck(selector){    
        $.ajax({
            type: 'POST',
            url: selector.getAttribute('data-action'),
            data: {username:selector.value},
            cache: false,
            dataType: 'HTML',
            beforeSend: function(){
                $('#errorShow').html('Checking...');
            },
            success: function (html){ 
                if(html==1){
                     selector.value='';
                     $('#errorShow').html('Username already exist');
                 }else{
                     $('#errorShow').html(''); 
                 } 
               
            }
        });     
}

//window.location.reload();