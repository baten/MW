/*
	Add to cart fly effect with jQuery. - May 05, 2013
	(c) 2013 @ElmahdiMahmoud - fikra-masri.by
	license: http://www.opensource.org/licenses/mit-license.php
*/   

$('.basketproduct').on('click', function () {
    var horizontal =$(window).width();
    if(horizontal > 767){
        var cart = $('.flyContainer');
    }else{
        var cart = $('.flyContainer1');
    }
        var imgtodrag = $(this).children().children().find("img").eq(0);
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '0.5',
                    'position': 'absolute',
                    'height': '100px',
                    'width': '100px',
                    'z-index': '99999'
            })
                .appendTo($('body'))
                .animate({
                'top': cart.offset().top + 10,
                    'left': cart.offset().left + 10,
                    'width': 75,
                    'height': 75
            }, 1000, 'easeInOutExpo');
            
            /*setTimeout(function () {
                cart.effect("shake", {
                    times: 2
                }, 200);
            }, 1500);*/

            imgclone.animate({
                'width': 0,
                    'height': 0
            }, function () {
                $(this).detach();
            });
        }
    });