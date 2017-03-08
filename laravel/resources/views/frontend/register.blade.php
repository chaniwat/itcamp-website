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
            background: url('{{ asset('assets/frontend/register/bg-'.$camp.'.png') }}') repeat fixed;
        }
    </style>
</head>

<body>
    {{-- TODO Design form bootstrap.v4 --}}

    <div class="container register-from">
        <header>
            <div class="text-center">
                <img src="{{ asset('assets/frontend/images/logo.png') }}" width="300" />
                <h1>แบบฟอร์มสมัครค่ายไอทีแคมป์</h1>
                <h2>ค่ายย่อย "@lang("camp.".$camp)"</h2>
            </div>
        </header>

        <section class="body">
            <form action="{{ route('frontend.register', ['camp' => $camp]) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <h2>ส่วนที่ 1 : ข้อมูลทั่วของผู้สมัคร</h2>
                <hr />
                <h3>ข้อมูลส่วนตัว</h3>
                <div class="row">
                    @foreach($applicantQuestions->where('priority', '<=', '1000')->where('priority', '>=', '992') as $question)
                        {!! $viewHelper->formBuilder()->buildInputField($question) !!}
                    @endforeach
                </div>
                <h3>ที่อยู่ปัจจุบันที่สามารถติดต่อได้</h3>
                <div class="row">
                    @foreach($applicantQuestions->where('priority', '<=', '950')->where('priority', '>=', '917') as $question)
                        {!! $viewHelper->formBuilder()->buildInputField($question) !!}
                    @endforeach
                </div>
                <h3>ข้อมูลผู้ปกครอง</h3>
                <div class="row">
                    @foreach($applicantQuestions->where('priority', '<=', '800')->where('priority', '>=', '789') as $question)
                        {!! $viewHelper->formBuilder()->buildInputField($question) !!}
                    @endforeach
                </div>
                <h3>ข้อมูลการศึกษา</h3>
                <div class="row">
                    @foreach($applicantQuestions->where('priority', '<=', '850')->where('priority', '>=', '846') as $question)
                        {!! $viewHelper->formBuilder()->buildInputField($question) !!}
                    @endforeach
                </div>
                <h3>ข้อมูลอื่นๆ</h3>
                <div class="row">
                    @foreach($applicantQuestions->where('priority', '<=', '680')->where('priority', '>=', '674') as $question)
                        {!! $viewHelper->formBuilder()->buildInputField($question) !!}
                    @endforeach
                </div>
                <div style="margin-top: 1rem;"></div>
                <h2>ส่วนที่ 2 : คำถามค่าย</h2>
                <hr />
                <h3>คำถามทั่วไป</h3>
                <div class="row">
                    @foreach($campQuestions->where('priority', '<=', '1000')->where('priority', '>=', '499') as $question)
                        {!! $viewHelper->formBuilder()->buildInputField($question) !!}
                    @endforeach
                </div>
                <h3>คำถามค่ายย่อย "@lang("camp.".$camp)"</h3>
                <div class="row">
                    @foreach($campQuestions->where('priority', '<', '499') as $question)
                        {!! $viewHelper->formBuilder()->buildInputField($question) !!}
                    @endforeach
                </div>
                <hr />
                <div class="row">
                    <div class="col-12 offset-lg-4 col-lg-4">
                        <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#confirmModal">สมัคร</button>
                    </div>
                </div>

                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">ยืนยันการสมัคร</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                <button type="submit" class="btn btn-success">ยืนยัน</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script src="{{ asset('assets/frontend/register/script.js') }}" type="text/javascript"></script>
</body>

</html>