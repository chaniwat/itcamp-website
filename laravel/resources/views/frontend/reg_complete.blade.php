<?php
//  $lazyModeDir = "/13";
//  $lazyModeDir = "/dev13";
  $lazyModeDir = "";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta id="Viewport" name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <meta name="theme-color" content="#292B2C">

    <link rel="icon" type="image/png" href="{{ $lazyModeDir }}/assets/frontend/favicon/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ $lazyModeDir }}/assets/frontend/favicon/favicon-16x16.png" sizes="16x16" />

    <title>ITCAMP 13 | Register</title>

    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/app.css') }}?v={{ (int)microtime(true) }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.standalone.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/register/style.css') }}?v={{ (int)microtime(true) }}" />

    <style>
        body {
            background: url('{{ asset('assets/frontend/register/bg.png') }}') repeat fixed;
        }
    </style>
</head>

<body>
    <div class="container register-from">
        <section class="body">
            <div class="row">
                <div class="col-12" style="margin-bottom: 1rem;">
                    <div class="text-center" style="margin: 0; font-size: 20px;">
                        <img src="{{ asset('assets/frontend/images/logo.png') }}" width="300" style="margin-bottom: 0.8rem;" />
                        <h1 style="font-weight: bold; margin-bottom: 0.8rem;">สมัครเสร็จสิ้น</h1>
                        ประกาศผู้ผ่านการคัดเลือกในวันที่ xx พฤษภาคม 2560 นี้ <br />
                        และอย่าลืม เข้ามาร่วมพูดคุยกับพี่ๆ และเพื่อนคนอื่นๆ ได้ในกรุ๊ป <a href="https://www.facebook.com/groups/ITCampSociety/" target="_blank">ITCAMP Society &#64; ITKMITL</a> นะครับ <br />
                        ติดตามรายละเอียดเพิ่มเติม ที่ <a href="https://www.facebook.com/itcampKMITL" target="_blank">facebook.com/itcampKMITL</a> หรือ twitter <a href="https://twitter.com/ITCAMP" target="_blank">&#64;ITCAMP</a> <br />
                    </div>
                </div>
                <div class="col-12 offset-lg-4 col-lg-4">
                    <a href="{{ route('view.frontend.index') }}" class="btn btn-block btn-primary">กลับไปยังหน้าแรก</a>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script src="{{ asset('assets/frontend/register/jquery.maskedinput.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
      var GlobalOption = {};
      GlobalOption.mode = 'COMPLETE';
    </script>
    <script src="{{ asset('assets/frontend/register/script.js') }}?v={{ (int)microtime(true) }}" type="text/javascript"></script>
</body>

</html>