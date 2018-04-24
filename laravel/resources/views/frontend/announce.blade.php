<?php
  $lazyModeDir = env("APP_ROOT");
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/app.css') }}?v={{ (int)microtime(true) }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.standalone.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/register/style.css') }}?v={{ (int)microtime(true) }}" />

    <style>
        body {
            background: url('{{ asset('assets/frontend/register/bg-'.$camp.'.png') }}') repeat fixed;
        }

        .custom-control-input:checked ~ .custom-control-indicator {
            background-color: {{ $colors[0] }};
        }

        .custom-control-input:active ~ .custom-control-indicator {
            background-color: {{ $colors[1] }};
        }

        .custom-control-input:focus ~ .custom-control-indicator {
            box-shadow: 0 0 0 1px #fff, 0 0 0 3px {{ $colors[0] }};
        }

        .form-control:focus {
            border-color: {{ $colors[1] }};
        }

        @media (min-width: 1200px) {
            .register-from {
                padding: 25px 50px;
            }
        }
    </style>
</head>

<body>
    <div class="container register-from">
        <header>
            <div class="text-center">
                <img src="{{ asset('assets/frontend/images/'.implode('-', explode('_', $camp)).'-o.png') }}" height="325" />
                <h1>ประกาศผลการสมัครค่ายไอทีแคมป์ ครั้งที่ 13</h1>
                <h2>ค่ายย่อย <span class="force-fredoka" style="color: {{ $colors[1] }}">"@lang("camp.".$camp)"</span></h2>
            </div>
        </header>

        <section class="body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>โรงเรียน</th>
                    <th>สถานะ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($applicants as $applicant)
                    <tr>
                        <td>{{ $applicant->username }}</td>
                        <td>{{ $applicant->pname.$applicant->fname." ".$applicant->lname }}</td>
                        <td>{{ $applicant->school }}</td>
                        <td>{{ $applicant->state == 'SELECT' ? 'ตัวจริง' : 'ตัวสำรอง' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="row">
                <div class="col-12 offset-lg-4 col-lg-4" style="margin-top: 1.5rem;">
                    <a href="{{ route('view.frontend.applicant.login') }}" class="btn btn-block btn-success" id="submitBtn">เข้าสู่ระบบการยืนยันสิทธิ์</a>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script type="text/javascript">
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
    </script>
</body>

</html>