<!DOCTYPE html>
<html>
<head>
    <title>Applicant Control | ITCAMP#13</title>

    <meta charset="UTF-8" />
    <meta id="Viewport" name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <meta name="theme-color" content="#292B2C">

    <link rel="icon" type="image/png" href="{{ asset('assets/frontend/favicon/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('assets/frontend/favicon/favicon-16x16.png') }}" sizes="16x16" />

    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/app.css') }}?v={{ (int)microtime(true) }}" />

    <style>
        html {
            font-size: 16px;
            min-width: 580px;
        }

        body {
            height: auto;
            background: url('{{ asset('assets/frontend/register/bg.png') }}') repeat fixed;
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border-radius: 15px;
            padding: 25px;
        }

        .side-form, .login-form {
            align-self: center;
        }

        .side-form .logo {
            height: 325px;
        }

        .header-row {
            margin-bottom: 0.6rem;
        }

        @media screen and (max-width: 991px) {
            .side-form {
                margin-bottom: 1.2rem;
            }
        }

        @media screen and (max-width: 767px) {
            .side-form .logo {
                height: 275px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-5 side-form text-center">
                <img class="logo" src="{{ asset('assets/frontend/images/logo.png') }}" />
            </div>
            <div class="col-lg-7 login-form">
                <form action="{{ route('frontend.applicant.auth.login') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-12 header-row">
                            <h1>เข้าสู่ระบบไอทีแคมป์</h1>
                        </div>
                        {!! $viewHelper->makeAlertStatus('frontend.applicant.component.alert', 'frontend') !!}
                        <div class="form-group col-12">
                            <label class="form-control-label" for="username"> ชื่อผู้ใช้<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            <small class="form-text text-muted" style="font-size: 1rem;">ชื่อผู้ใช้งานของน้องๆ จะได้มาจาก username หน้าชื่อน้อง <b>ในหน้าประกาศผล</b></small>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-control-label" for="password"> รหัสผ่าน<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            <small class="form-text text-muted" style="font-size: 1rem;">รหัสผ่านเป็น <b>หมายเลขบัตรประชาชน</b> ที่น้องใช้ในการสมัครเข้ามา</small>
                        </div>
                        <div class="col-12" style="margin-top: 1rem;">
                            <button type="submit" class="btn btn-block btn-success force-cloud" id="submitBtn">เข้าสู่ระบบ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script type="text/javascript">
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
    </script>
</body>
</html>

