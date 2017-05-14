$('.nav-menu a[data-toggle="tab"], .nav-mobile-menu a[data-toggle="tab"]').on('show.bs.tab', function (e) {
    var eln = $(e.target);
    var elp = $(e.relatedTarget);

    $('a[href="' + elp.attr('href') + '"]').removeClass('active');
    $('a[href="' + eln.attr('href') + '"]').addClass('active');

    $('#mobileMenu').collapse('hide');
});

$(window).resize(function() {
    var ww = window.innerWidth;
    if(ww > 991) {
        $('#mobileMenu').collapse('hide');
    }
});

$(function(){
    // Set viewport
    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
        var ww = ( $(window).width() < window.screen.width ) ? $(window).width() : window.screen.width; //get proper width
        var mw = 500; // min width of site
        var ratio =  ww / mw; // calculate ratio
        var mxw = 768; // max width of site
        var mxratio = ww / mxw; // calculate max ratio
        if( ww < mw){ // smaller than minimum size
            $('#Viewport').attr('content', 'initial-scale=' + ratio + ', maximum-scale=' + ratio + ', minimum-scale=' + ratio + ', user-scalable=no, width=' + ww);
        }else{ // regular size
            $('#Viewport').attr('content', 'initial-scale=' + mxratio + ', maximum-scale=' + mxratio + ', minimum-scale=' + mxratio + ', user-scalable=no, width=' + mxw);
        }
    }
});