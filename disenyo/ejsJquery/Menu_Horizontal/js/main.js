$(function() {
    $('ul li:has(ul)').hover(function() {
        $(this).find('ul').css({display: "block"});
    }),
    function() {
        $(this).find('ul').css({display: "none"});
    }
})