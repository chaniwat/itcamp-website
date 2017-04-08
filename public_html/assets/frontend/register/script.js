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

  var setupAllowedFile = function(elem, allowedExts) {
    elem.change(checkInput.bind(this, allowedExts));
  }
  var checkInput = function(allowedExts, event) {
    var elemO = $(event.target).get(0);
    var files = elemO.files;
    if(files.length > 0) {
      var valid = $.inArray(files[0].type, allowedExts) > -1;

      if(!valid) {
        $("#fileAlert").modal('show');

        elemO.value = '';
        if(elemO.value) {
          elemO.type = "text";
          elemO.type = "file";
        }
      }

      if (files.length > 0 && files[0].size > 2097152) {
        $("#fileSizeAlert").modal('show');

        elemO.value = '';
        if(elemO.value) {
          elemO.type = "text";
          elemO.type = "file";
        }
      }
    } else {
      console.log('No file selected');
    }
  }

  var registerShowPicture = function(fieldID) {
    $("#" + fieldID).change(function() {
      if (!$("#" + fieldID + "_show").length) {
        $("<img class='showImg' id='" + fieldID + "_show'>").insertBefore("#" + fieldID);
      }

      if (this.files && this.files[0]) {
        var isPic = $.inArray(this.files[0].type, pictures) > -1;

        if(isPic) {
          var reader = new FileReader();

          reader.onload = function (e) {
            $("#" + fieldID + "_show")
              .attr('src', e.target.result)
              .height(300);
          };

          reader.readAsDataURL(this.files[0]);
          return;
        }
      }

      if ($("#" + fieldID + "_show").length) {
        $("#" + fieldID + "_show").remove();
      }
    });
  }

  setupAllowedFile($("#a_confirmcurrentgrade"), any);
  setupAllowedFile($("#q_recreation_1_f"), pictures);
  registerShowPicture("a_confirmcurrentgrade");
  registerShowPicture("q_recreation_1_f");
  if(GlobalOption.camp == 'camp_game') {
    setupAllowedFile($("#q_game_5"), pictures);
    registerShowPicture("q_game_5");
  } else if(GlobalOption.camp == 'camp_iot') {
    setupAllowedFile($("#q_iot_5"), pictures);
    registerShowPicture("q_iot_5");
  }
}

function registerValidateForm() {
  var valid;

  var textValidator = function(i, e) {
    e = $(e);
    e.parent('.form-group').removeClass('has-danger');

    if(!e[0].checkValidity() || e.val().replace(/^\s+|\s+$/g,'') == '') {
      e.parent('.form-group').addClass('has-danger');
      valid = false;
    }

    e.val(e.val().replace(/^\s+|\s+$/g,''));
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
      $("#formAlert").modal('show');
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