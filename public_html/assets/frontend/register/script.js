function registerOtherFieldHandler() {
  $('input[data-other-of]').each(function(i, o) {
    $(o).attr('disabled', true);
    var parent_id = $(o).data('other-of');

    $('#' + parent_id).change(function(e) {
      var target = e.target;
      var val = $(target).val();

      if(val == 'other') {
        $(o).removeAttr('disabled')
      } else {
        $(o).attr('disabled', true);
        $(o).val('');
      }
    });
  });
}

$(function(){
  if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
    var ww = ( $(window).width() < window.screen.width ) ? $(window).width() : window.screen.width; //get proper width
    var mw = 580; // min width of site
    var ratio =  ww / mw; //calculate ratio
    if( ww < mw){ //smaller than minimum size
      $('#Viewport').attr('content', 'initial-scale=' + ratio + ', maximum-scale=' + ratio + ', minimum-scale=' + ratio + ', user-scalable=no, width=' + ww);
    }else{ //regular size
      $('#Viewport').attr('content', 'initial-scale=1.0, maximum-scale=2, minimum-scale=1.0, user-scalable=no, width=' + ww);
    }
  }
});

$(document).ready(function() {
  registerOtherFieldHandler();
});