(function ( $ ){
    $.fn.parallaxScroll = function(){
        var $ps = $( this );
        $ps.each(function() {
            var $w = $(window);
            var $bgO = $( $ps );
            var $yP = -( ( $w.scrollTop() - $bgO.offset().top ) / $bgO.data('speed'));

            // Put together our final background position
            var $coO = '50% '+ $yP + 'px';

            // Move the background
            $bgO.css({ backgroundPosition: $coO });
        });
        return this;
    }
}( jQuery ));

$(document).ready(function($){
    $('[data-type="parallax-scrolling"]').parallaxScroll();
});
$(window).scroll(function() {
    $('[data-type="parallax-scrolling"]').parallaxScroll();
}); 