$.fn.contrastColor = function() {
    return this.each(function() {
        var bg = $(this).css('background-color');
        //use first opaque parent bg if element is transparent
        if(bg == 'transparent' || bg == 'rgba(0, 0, 0, 0)') { 
            $(this).parents().each(function(){
                bg = $(this).css('background-color')
                if(bg != 'transparent' && bg != 'rgba(0, 0, 0, 0)') return false; 
            });
            //exit if all parents are transparent
            if(bg == 'transparent' || bg == 'rgba(0, 0, 0, 0)') return false;
        }
        //get r,g,b and decide
        var rgb = bg.replace(/^(rgb|rgba)\(/,'').replace(/\)$/,'').replace(/\s/g,'').split(',');
        var yiq = ((rgb[0]*299)+(rgb[1]*587)+(rgb[2]*114))/1000;
        if(yiq >= 128) $(this).addClass('dark-color').removeClass('light-color');
        else $(this).addClass('light-color').removeClass('dark-color');
    });
};