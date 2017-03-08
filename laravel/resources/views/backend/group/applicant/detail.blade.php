@extends('backend.layout.master')

@section('content-header')
    รายละเอียดผู้สมัคร ID: {{ $applicant->id }}
@endsection

@section('style')
    <style>
        td {
            vertical-align: middle !important;
        }

        .row {
            margin-left: 0;
            margin-right: 0;
        }
    </style>
@endsection

@section('content')

    <div class="box box-primary">
        <form>
            <div class="box-body">
                <div class="row">
                    @foreach($applicantQuestions as $question)
                        {!! $viewHelper->formBuilder()->buildBackendInputField($question, $applicant) !!}
                    @endforeach
                </div>
            </div>
        </form>
    </div>

@endsection