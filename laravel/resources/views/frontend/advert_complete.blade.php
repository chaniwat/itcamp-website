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

    <title>ITCAMP 13 | Link Exchange</title>

    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/app.css') }}?v={{ (int)microtime(true) }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.standalone.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/register/style.css') }}?v={{ (int)microtime(true) }}" />

    <style>
        body {
            background: url('{{ asset('assets/frontend/register/bg.png') }}') repeat fixed;
        }

        .container header {
            margin-bottom: 0px;
        }

        .container hr {
            border-top: 3px dashed rgba(0, 0, 0, 0.1);
            margin: 25px 0;
        }

        .share-group .share-img h4 {
            margin-top: 1.2rem;
            margin-bottom: 0.8rem;
        }

        textarea.form-control {
            font-size: 1.25rem;
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
                        <h1 style="font-weight: bold; margin-bottom: 0.8rem;">บันทึกข้อมูลเสร็จสิ้น</h1>
                        ขอบคุณที่เข้ามาร่วมประชาสัมพันธ์กับเรา <br />
                        ติดตามรายละเอียดเพิ่มเติมได้ที่ <a href="https://www.facebook.com/itcampKMITL" target="_blank">facebook.com/itcampKMITL</a> หรือ Twitter <a href="https://twitter.com/ITCAMP" target="_blank">&#64;ITCAMP</a> <br />
                    </div>
                </div>
                <div class="col-12 offset-lg-4 col-lg-4">
                    <a href="{{ route('view.frontend.index') }}" class="btn btn-block btn-primary">กลับไปยังหน้าแรก</a>
                </div>
            </div>
        </section>

        <hr />

        <section class="body">
            <div class="text-center" style="margin-bottom: 1.5rem;">
                <h3>ภาพสำหรับประชาสัมพันธ์</h3>
            </div>

            @foreach($banners as $banner)
            <div class="share-group">
                <div class="text-center share-img">
                    <img class="img-fluid" src="{{ asset($banner['url']) }}" />
                    <h4>ขนาด {{ $banner['width'] }}x{{ $banner['height'] }}</h4>
                </div>

                <div class="form-group share-url">
                    <textarea class="form-control share-field" rows="2" readonly onclick="this.select()"><a href="http://www.itcamp.in.th"><img src="{{ url($banner['url']) }}" width="{{ $banner['width'] }}" height="{{ $banner['height'] }}" border="0" alt="itcamp#13"></a></textarea>
                </div>
            </div>
            @endforeach
        </section>

    </div>

    <div class="modal fade" id="fileAlert" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"><b class="text-danger">Error</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    เลือกไฟล์ผิดประเภท
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formAlert" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"><b class="text-danger">Error</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    กรุณากรอกข้อมูลให้ครบ
                </div>
                <div class="modal-footer">
                    <button type="indbutton" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="fileSizeAlert" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"><b class="text-danger">Error</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ไฟล์มีขนาดใหญ่เกินไป (ขนาดไม่เกิน 2MB)
                </div>
                <div class="modal-footer">
                    <button type="indbutton" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>

</html>