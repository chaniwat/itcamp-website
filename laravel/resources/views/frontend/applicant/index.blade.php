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
        <link rel="stylesheet" href="{{ asset('assets/frontend/applicant/style.css') }}?v={{ (int)microtime(true) }}" />

        <style>
            @if(isset($applicant))
                body {
                    background: url('{{ asset('assets/frontend/register/bg-'.$applicant->camp->name.'.png') }}') repeat fixed;
                }
            @endif
        </style>
        @yield('style')
    </head>

    <body>
        <nav class="navbar fixed-top navbar-inverse bg-inverse navbar-applicant">
            <a href="#" class="nav-hamburger hidden-lg-up" data-toggle="collapse" data-target="#mobileMenu" aria-controls="mobileMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </a>
            <div class="logo">
                <img src="{{ asset('/assets/frontend/images/logo-only-text.png') }}" />
            </div>
            <div class="nav-menu hidden-md-down">
                <a class="nav-linker active" data-toggle="tab" href="#detail" role="tab">รายละเอียด</a>
                <a class="nav-linker" data-toggle="tab" href="#evidence" role="tab">ส่งหลักฐาน</a>
                <a class="nav-linker" data-toggle="tab" href="#download" role="tab">ดาวน์โหลดเอกสาร</a>
                <a class="nav-linker" data-toggle="tab" href="#prepare" role="tab">เตรียมพร้อมพจญภัย</a>
                <a class="nav-linker" data-toggle="tab" href="#disclaim" role="tab">สละสิทธิ์</a>
            </div>
            <div class="nav-control">
                <a href="{{ route('frontend.applicant.auth.logout') }}" class="btn btn-danger" style="padding: 0.35rem 0.5rem;"><i class="fa fa-sign-out"></i> ออกจากระบบ</a>
            </div>
            <div class="nav-mobile bg-inverse collapse" id="mobileMenu">
                <div class="nav-mobile-menu">
                    <a class="nav-linker active" data-toggle="tab" href="#detail" role="tab">รายละเอียด</a>
                    <a class="nav-linker" data-toggle="tab" href="#evidence" role="tab">ส่งหลักฐาน</a>
                    <a class="nav-linker" data-toggle="tab" href="#download" role="tab">ดาวน์โหลด</a>
                    <a class="nav-linker" data-toggle="tab" href="#prepare" role="tab">เตรียมพร้อม</a>
                    <a class="nav-linker" data-toggle="tab" href="#disclaim" role="tab">สละสิทธิ์</a>
                </div>
            </div>
        </nav>

        <header>
            <div class="container">
                <h3 style="margin-bottom: 0;"><span class="force-fredoka" style="font-size: 1.2em;">ITCAMP#13</span> ระบบยืนยันสิทธิ์</h3>
                <span class="badge badge-pill badge-default">ค่าย @lang('camp.'.$applicant->camp->name)</span>
                <hr />
                <h4><b>ข้อมูลผู้สมัคร</b></h4>
                <b>ชื่อ:</b> {{ $applicant->getDetailValue('p_name').$applicant->getDetailValue('f_name')." ".$applicant->getDetailValue('l_name') }}<br />
                <b>ชื่อเล่น:</b> {{ $applicant->getDetailValue('nickname') }}<br />
                <b>วันที่สมัคร:</b> {{ \Carbon\Carbon::parse($applicant->created_at)->format('d/m/Y') }} <br />
                <b>สถานะปัจจุบัน:</b> @lang('frontend_applicant_state.'.$applicant->state) <br />
                <b>สถานะการส่งหลักฐานยืนยันระดับชั้นที่เรียนในปัจจุบัน:</b> เสร็จสิ้น <br />
                <b>สถานะการส่งหลักฐานยืนยันการโอนเงิน:</b> ยังไม่ส่งหลักฐาน
            </div>
        </header>

        <section class="body">
            <div class="container">
                <div class="tab-content">
                    <div class="tab-pane fade" id="detail" role="tabpanel">
                        @include('frontend.applicant.detail')
                    </div>
                    <div class="tab-pane fade show active" id="evidence" role="tabpanel">
                        @include('frontend.applicant.evidence')
                    </div>
                    <div class="tab-pane fade" id="download" role="tabpanel">oh</div>
                    <div class="tab-pane fade" id="prepare" role="tabpanel">wow</div>
                    <div class="tab-pane fade" id="disclaim" role="tabpanel">haha</div>
                </div>
            </div>
        </section>

        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <script type="text/javascript">
            var GlobalOption = {};
            GlobalOption.evidence = false;
        </script>
        <script src="{{ asset('assets/frontend/applicant/script.js') }}" type="text/javascript"></script>
    </body>
</html>