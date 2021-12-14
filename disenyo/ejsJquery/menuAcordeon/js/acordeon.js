(function() {
    var dds = $('dd');
    dds.hide();

    //dds.eq(0).show();

    $('dt').on('mouseenter',function(){
        //dds.hide();
        //dds.slideUp(200);
        $(this).next().slideDown(200);
    });

    $('dt').on('mouseleave',function(){
        dds.slideUp(200);
    });
})();