function resetHeight() {
    $('.full-height .eqblock').css("min-height", 1);
}

var currentTallest = 0,
    currentRowStart = 0,
    rowDivs = new Array();

function setConformingHeight(element, newHeight) {
    element.css("min-height", newHeight);
}

function getOriginalHeight(element) {
    return (element.data("originalHeight") == undefined) ? (element.outerHeight()) : (element.data("originalHeight"));
}

function columnConform() {
    $('.full-height .eqblock').each(function() {
        var $element = $(this);
        var topPosition = $element.position().top;
        if (currentRowStart != topPosition) {
            for(currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) setConformingHeight(rowDivs[currentDiv], currentTallest);
            rowDivs.length = 0;
            currentRowStart = topPosition;
            currentTallest = getOriginalHeight($element);
            rowDivs.push($element);
        } else {
            rowDivs.push($element);
            currentTallest = (currentTallest < getOriginalHeight($element)) ? (getOriginalHeight($element)) : (currentTallest);
        }
        for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) setConformingHeight(rowDivs[currentDiv], currentTallest);
        });
}

// Dom Ready
// You might also want to wait until window.onload if images are the things that
// are unequalizing the blocks
$(document).ready(function() {
    columnConform();
});
$(window).resize(function(){
    resetHeight();
    columnConform();
});