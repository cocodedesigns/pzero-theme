$(document).ready(function(){
    var stickyNavTop = $('.to-stick').offset().top;
    
    var stickyNav = function(){
        var scrollTop = $(window).scrollTop();
        
        if (scrollTop > stickyNavTop) {
            $('.to-stick').addClass('sticky');
        } else {
            $('.to-stick').removeClass('sticky');
        }
    };
    
    stickyNav();
    
    $(window).scroll(function(){
        stickyNav();
    });
});