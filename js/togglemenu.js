$(document).ready(function(){
    $('#menutoggle a, #toggle_touchClose').click(function(e){
        e.preventDefault();
        $('header nav').toggleClass('show');
    });
});