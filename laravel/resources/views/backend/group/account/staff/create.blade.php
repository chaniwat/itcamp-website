@extends('backend.layout.master')

@section('content-header')
    เพิ่มบัญชีผู้ใช้ <small>กลุ่ม Staff</small>
@endsection

@section('content')

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">ฟอร์มเพิ่มบัญชีใหม่สำหรับ Staff</h3>
        </div>
        <form class="form-horizontal" action="{{ route("backend.account.staff.create") }}" method="post">
            {{ csrf_field() }}

            <div class="box-body">
                <div class="form-group">
                    <label for="inputUsername" class="col-sm-2 control-label">Username</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username" value="{{ old('username') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary btn-block" id="generate-password">Generate</button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCPassword" class="col-sm-2 control-label">Confirm Password</label>

                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputCPassword" name="password_confirmation" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSection" class="col-sm-2 control-label">ฝ่าย</label>

                    <div class="col-sm-10">
                        <select class="form-control" id="inputSection" name="section">
                            @foreach($data['sections'] as $section)
                                <option value="{{ $section->id }}" {{ old('section') == $section->id ? "selected" : "" }}>@lang('section.'.$section->name)</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="head" {{ old('head') ? "checked" : "" }}> เป็นเฮดฝ่าย?
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <a href="{{ route("view.backend.account.staff") }}" class="btn btn-default">ยกเลิกการสร้าง</a>
                <button type="submit" class="btn btn-info pull-right">สร้างบัญชีใหม่</button>
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $("#generate-password").click(function() {
            var randPassword = randomString(12);
            $("#inputPassword").attr('type', 'text');
            $("#inputCPassword").attr('readonly', 'readonly');
            $("#inputPassword").val(randPassword);
            $("#inputCPassword").val(randPassword);
        });
    </script>
@endsection