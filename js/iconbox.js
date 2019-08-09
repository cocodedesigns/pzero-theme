$(document).ready(function(){
    $('.panel-grid').each(function(){  
        var nameBox = 0;
        $(this).find('.iconbox .icb-content').each(function(){
            if($(this).height() > nameBox){  
                nameBox = $(this).height();  
            }
        });
        $(this).find('.iconbox .icb-content').height(nameBox);
    });
});