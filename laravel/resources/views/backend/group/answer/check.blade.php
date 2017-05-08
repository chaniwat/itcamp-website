@extends('backend.layout.master')

@section('content-header')
    ตรวจคำตอบ
@endsection

@section('style')
    <style>
        td {
            vertical-align: middle !important;
        }
    </style>
@endsection

@section('content')

    <div class="box box-solid box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">ข้อมูลผู้ตรวจ</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ฝ่าย</th>
                            <th>ผู้ตรวจ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>@lang('section.'.$checker->section->name)</td>
                            <td>({{ $checker->id }}) {{ $checker->name }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-primary">
        <form action="{{ route('backend.answers.save.score') }}" method="POST">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="row">
                    @foreach($questions as $question)
                        {!! $viewHelper->formBuilder()->buildBackendInputField($question, $applicant, \App\Answer::class) !!}

                        @if($question->has_score)
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="{{ $question->id }}_score">Score: </label>
                                    <select class="form-control" id="{{ $question->id }}_score" name="{{ $question->id }}_score">
                                        <option value="null" {{ in_array(old($question->id."_score"), [null, 'null']) ? 'selected' : '' }}></option>
                                        @for($i = $question->min_score; $i <= $question->max_score; $i++)
                                            <option value="{{ $i }}" {{ old($question->id."_score") === (string) $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <hr />
                            </div>
                        @endif
                    @endforeach

                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-success">บันทึกคะแนนและตรวจคนถัดไป</button>
                        <span class="text-danger" style="margin-left: 1rem;"><b>*โปรดตรวจสอบคะแนนอีกครั้งก่อนทำการบันทึก (ไม่สามารถแก้คะแนนย้อนหลังได้)</b></span>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection