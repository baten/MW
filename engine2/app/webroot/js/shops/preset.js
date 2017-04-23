
/**!
 *
 *  Document   : preset.js 
 * @author    UY System Limited.
 * @copyright Copyright 2015 Uysystem Limited.
 *
 */


var templateOptions = function() {

    var colorList = $('.layout');
    var themeLink = $('#layout-link');
    var theme;
    var temp;

    if (themeLink.length) {
        theme = themeLink.attr('href');

        $('li', colorList).removeClass('active');
        $('a[data-theme="' + theme + '"]', colorList).parent('li').addClass('active');
    }

    $('a', colorList).on("click",function(e){
        // Get theme name
        temp = $(this).data('theme');
        theme="css/"+temp+".css";
        

        $('li', colorList).removeClass('active');
        $(this).parent('li').addClass('active');

        if (theme === 'default') {
            if (themeLink.length) {
                themeLink.remove();
                themeLink = $('#layout-link');
                
            }
        } else {
            if (themeLink.length) {
                themeLink.attr('href', theme);
            } else {
                $('link[href="css/responsive.css"]').before('<link id="layout-link" rel="stylesheet" href  ="' + theme + '">');
                themeLink = $('#layout-link');
            }
        }
    });


    var colorList = $('.color');
    var colorthemeLink = $('#color-link');
    var theme;
    var temp;
    var logo;

    if (colorthemeLink.length) {
        theme = colorthemeLink.attr('href');

        $('li', colorList).removeClass('active');
        $('a[data-theme="' + theme + '"]', colorList).parent('li').addClass('active');
    }

    $('a', colorList).on("click",function(e){
        // Get theme name
        temp = $(this).data('theme');
        theme="css/"+temp+".css";
        logo="img/logo-"+temp+".png";

        $('li', colorList).removeClass('active');
        $(this).parent('li').addClass('active');

        if (theme === 'default') {
            if (colorthemeLink.length) {
                colorthemeLink.remove();
                colorthemeLink = $('#color-link');
                
            }
        } else {
            if (colorthemeLink.length) {
                colorthemeLink.attr('href', theme);
                $("#logo").attr("src", logo);
            } else {
                $('link[href="css/responsive.css"]').before('<link id="color-link" rel="stylesheet" href  ="' + theme + '">');
                colorthemeLink = $('#color-link');
                $("#logo").attr("src", logo);
            }
        }
    });

};
