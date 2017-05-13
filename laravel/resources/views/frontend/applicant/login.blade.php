@extends('frontend.applicant.master')

@section('style')
    <style>
        body {
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
@endsection

@section('body')
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
                        {!! $viewHelper->makeAlertStatus('frontend.applicant.component.alert') !!}
                        <div class="form-group col-12">
                            <label class="form-control-label" for="username"> ชื่อผู้ใช้<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-control-label" for="password"> รหัสผ่าน<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="col-12" style="margin-top: 1rem;">
                            <button type="submit" class="btn btn-block btn-success" id="submitBtn">เข้าสู่ระบบ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection