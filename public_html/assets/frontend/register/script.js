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
function registerInputMasks() {
  $("#birthday").mask('99/99/9999', {
    placeholder: "MM/DD/YYYY"
  });

  $("#citizen_numid").mask('9-9999-99999-99-9', {
    placeholder: "X-XXXX-XXXXX-XX-X"
  });

  var phoneMask = "9999999999";
  var phonePlaceHolder = "XXXXXXXXXX"
  $("#phone").mask(phoneMask, {
    placeholder: phonePlaceHolder
  });
  $("#guardian_phone_1").mask(phoneMask, {
    placeholder: phonePlaceHolder
  });
  $("#guardian_phone_2").mask(phoneMask, {
    placeholder: phonePlaceHolder
  });

  var zipcodeMask = '99999';
  var zipcodePlaceHolder = 'XXXXX'
  $("#address_zipcode").mask(zipcodeMask, {
    placeholder: zipcodePlaceHolder
  });
  $("#guardian_address_zipcode").mask(zipcodeMask, {
    placeholder: zipcodePlaceHolder
  });
}
function registerFileCheck() {
  var pictures = ["image/jpeg", "image/gif", "image/png"];
  var documents = ["application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"];
  var any = pictures.concat(documents);

  var checkInput = function(allowedExts, event) {
    var elemO = $(event.target).get(0);
    var files = elemO.files;
    if(files.length > 0) {
      var valid = $.inArray(files[0].type, allowedExts) > -1;
      if(!valid) {
        alert('ไฟล์ผิดประเภท');

        elemO.value = '';
        if(elemO.value){
          elemO.type = "text";
          elemO.type = "file";
        }
      }
    } else {
      console.log('No file selected');
    }
  }

  $("#a_confirmcurrentgrade").change(checkInput.bind(this, any));
  $("#q_recreation_1_f").change(checkInput.bind(this, pictures));

  if(GlobalOption.camp == 'camp_game') {
    $("#q_game_5").change(checkInput.bind(this, pictures));
  } else if(GlobalOption.camp == 'camp_iot') {
    $("#q_iot_5").change(checkInput.bind(this, pictures));
  }
}
function registerValidateForm() {
  var valid;
  var textValidator = function(i, e) {
    e = $(e);
    e.parent('.form-group').removeClass('has-danger');

    if(!e[0].checkValidity()) {
      e.parent('.form-group').addClass('has-danger');
      valid = false;
    }
  }
  var selectValidator = function(i, e) {
    e = $(e);
    e.parent('.form-group').removeClass('has-danger');

    if($(e).val() == null) {
      e.parent('.form-group').addClass('has-danger');
      valid = false;
    }
  }

  $('#submitBtn').click(function() {
    valid = true;
    $('input[required]').each(textValidator);
    $('select[required]').each(selectValidator);
    $('textarea[required]').each(textValidator);

    if(valid) {
      $("#confirmModal").modal('show');
    } else {
      alert('กรุณากรอกข้อมูลให้ครบ');
    };
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
  if(GlobalOption.mode == "REGISTER") {
    registerOtherFieldHandler();
    registerInputMasks();
    registerFileCheck();
    registerValidateForm();
  }
});