$(document).ready(function(){
    $('.panel-grid').each(function(){  
        var nameBox = 0;
        $(this).find('.single-testimonial .testimonial-content-wrap').each(function(){
            if($(this).height() > nameBox){  
                nameBox = $(this).height();  
            }
        });
        $(this).find('.single-testimonial .testimonial-content-wrap').height(nameBox);
    });
    $('.widget-testimonial-slider').each(function(){  
        var nameBox = 0;
        $(this).find('.testimonial-slide .testimonial-content-wrap').each(function(){
            if($(this).height() > nameBox){  
                nameBox = $(this).height();  
            }
        });
        $(this).find('.testimonial-slide .testimonial-content-wrap').height(nameBox);
    });
});