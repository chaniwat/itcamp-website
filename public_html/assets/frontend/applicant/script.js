function registerFileCheck() {
    var pictures = ["image/jpeg", "image/gif", "image/png"];

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
    var setupAllowedFile = function(fieldID, allowedExts) {
        $("#" + fieldID).change(checkInput.bind(this, allowedExts));
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

    setupAllowedFile("evidence_slip", pictures);
    registerShowPicture("evidence_slip");
}

function registerValidateForm(elem) {
    var valid;
    var firstInvalidElement = null;
    var confirmModalOpen = false;
    var submitting = false;

    var textValidator = function(e) {
        e.parent('.form-group').removeClass('has-danger');

        if(!e[0].checkValidity() || e.val().replace(/^\s+|\s+$/g,'') == '') {
            e.parent('.form-group').addClass('has-danger');
            valid = false;

            if(!firstInvalidElement) {
                firstInvalidElement = e;
            }
        }

        if(!e.is('input[type=file]'))  {
            e.val(e.val().replace(/^\s+|\s+$/g,''));
        }
    }
    var selectValidator = function(e) {
        e.parent('.form-group').removeClass('has-danger');

        if($(e).val() == null) {
            e.parent('.form-group').addClass('has-danger');
            valid = false;

            if(!firstInvalidElement) {
                firstInvalidElement = e;
            }
        }
    }

    // for state changing
    $("#confirmModal").on('shown.bs.modal', function() {
        confirmModalOpen = true;
    });
    $("#confirmModal").on('hide.bs.modal', function() {
        if(!submitting) {
            confirmModalOpen = false;
        }
    });
    $("#confirmModal").on('hidden.bs.modal', function() {
        if(submitting) {
            $("#savingModal").modal({
                backdrop: 'static',
                keyboard: false
            });
        }
    });

    elem.submit(function(e) {
        if(!confirmModalOpen) {
            e.preventDefault();

            valid = true;
            firstInvalidElement = null;

            $('elem input[required], elem select[required], elem textarea[required]').each(function (i, e) {
                e = $(e);

                if(e.is('input') || e.is('textarea')) {
                    textValidator(e);
                } else {
                    selectValidator(e);
                }
            });

            if(valid) {
                $("#confirmModal").modal('show');
            } else {
                $("#formAlert").modal('show');
                firstInvalidElement.focus();
            };
        } else {
            submitting = true;
            $("#confirmModal").modal('hide');
        }
    });
}

$('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
    $('a[data-toggle="tab"]').removeClass('active');
    $('a[href="' + $(e.target).attr('href') + '"]').addClass('active');
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
        var ratio = ww / mw; // calculate ratio
        var mxw = 768; // max width of site
        var mxratio = ww / mxw; // calculate max ratio
        if (ww < mw) { // smaller than minimum size
            $('#Viewport').attr('content', 'initial-scale=' + ratio + ', maximum-scale=' + ratio + ', minimum-scale=' + ratio + ', user-scalable=no, width=' + ww);
        } else { // regular size
            $('#Viewport').attr('content', 'initial-scale=' + mxratio + ', maximum-scale=' + mxratio + ', minimum-scale=' + mxratio + ', user-scalable=no, width=' + mxw);
        }
    }
});

$(document).ready(function () {
    if(!window.GlobalOption.evidence) {
        // Register event
        registerFileCheck();
        registerValidateForm($('#evidence_slip_form'));
    }

    if(window.GlobalOption.modal != null) {
        if(window.GlobalOption.modal == 'evidence_upload_complete') {
            $("#uploadComplete").modal('show');
        }
    }

    $('#disclaimForm').submit(function (e) {
        if($("#d_password").val().trim() == "") {
            e.preventDefault();
            alert('กรุณาใส่รหัสผ่าน');
        } else {
            return confirm('น้องต้องการยืนยันการสละสิทธิ์ใช่หรือไม่?');
        }
    });
})