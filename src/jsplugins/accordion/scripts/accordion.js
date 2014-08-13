function get_page(){

    var url = window.location.href.split('?url=');
    if(url.length == 2) url=url[1];
    //var url = window.location.href;
    var splits = url.split('/');
    var len = splits.length;
    var id  = splits[0] + "-" + splits[1];
    if(($('#'+id).length > 0) == true) {
        return id;
    }
    
    id = splits[len-1];
    for(i = len-2; i >= 0; i--){       
        id = splits[i] +"-"+ id;
        var tmp = $('#' + id).length;
        if(tmp != 0){
            return (id);
        }
    }
    return "";
}

function initMenu() {

    $("a[href='"+ window.location.href +"']").parent('li').parent('ul').addClass('accordion_atual');
    if ($('.accordion_atual').length == 0) {
        var id = get_page();
        $("#"+id).parent('ul').addClass('accordion_atual');
        if ($('.accordion_atual').length == 0) {
            $('.accordion ul:first').show();
        }
    }
    $('.accordion_atual').show();

    var slideSpeed = 'fast'; // 'slow', 'normal', 'fast', or miliseconds
    $('.accordion a').each(function() {
        var thisHref = $(this).attr('href')
        if ((window.location.pathname.indexOf(thisHref) == 0) || (window.location.pathname.indexOf('/' + thisHref) == 0)) {
            $(this).addClass('Current');
        }
    });

    $('.Current').parent('li').children('ul').show();
    $('.Current').parents('ul').show();

    $('.accordion a').click(function() {
        var id = ($('.accordion a').parent().parent().attr('id'));
        $('#'+id+' ul').slideUp(slideSpeed);
        if ($(this).parent('li').children('ul').html() != null) {
            $(this).parent('li').parent('ul').children('li').children('ul').slideUp(slideSpeed);
            $(this).delay(100).is(':hidden');
            if ($(this).parent('li').children('ul').css('display') == "block") {
                $(this).parent('li').children('ul').slideUp(slideSpeed);
            } else {
                $(this).parent('li').children('ul').slideDown(slideSpeed);
            }
            return false;
        }

    });

    

}
//$(document).ready(function() {initMenu();});

$(document).ready(function() {
    $('.accordion').each(function(){
       var children = $(this).children('ul'); 
       children.addClass('accordion_atual').show();
    });
    
    var slideSpeed = 'fast';
    $('.accordion a').click(function() {
        
        var id = ($('.accordion a').parent().parent().attr('id'));
        $('#'+id+' ul').slideUp(slideSpeed);
        if ($(this).parent('li').children('ul').html() != null) {
            $(this).parent('li').parent('ul').children('li').children('ul').slideUp(slideSpeed);
            $(this).delay(100).is(':hidden');
            if ($(this).parent('li').children('ul').css('display') == "block") {
                $(this).parent('li').children('ul').slideUp(slideSpeed);
            } else {
                $(this).parent('li').children('ul').slideDown(slideSpeed);
            }
            return false;
        }

    });
});
