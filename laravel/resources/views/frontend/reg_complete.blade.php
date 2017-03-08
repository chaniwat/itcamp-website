<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta id="Viewport" name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <meta name="theme-color" content="#292B2C">

    <title>ITCAMP 13 | Register</title>

    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/app.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.standalone.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/register/style.css') }}" />

    <style>
        body {
            background: url('{{ asset('assets/frontend/register/bg.png') }}') repeat fixed;
        }
    </style>
</head>

<body>
{{-- TODO Design form bootstrap.v4 --}}

<div class="container register-from">
    <section class="body">
        <div class="row">
            <div class="col-12" style="margin-bottom: 1rem;">
                <div class="alert alert-success" role="alert" style="margin: 0;">
                    <strong>สมัครเสร็จสิ้น</strong> ยังไม่ใช่ดีไซน์ล่าสุดนาาา~~
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
<script src="{{ asset('assets/frontend/register/script.js') }}" type="text/javascript"></script>
</body>

</html>