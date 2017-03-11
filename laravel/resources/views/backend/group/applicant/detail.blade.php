@extends('backend.layout.master')

@section('content-header')
    รายละเอียดผู้สมัคร ID: {{ $applicant->id }}
@endsection

@section('style')
    <style>
        td {
            vertical-align: middle !important;
        }
    </style>
@endsection

@section('content')

    <div class="box box-solid box-info">
        <div class="box-header with-border">
            <h3 class="box-title">กล่องควบคุม</h3>
        </div>
        <div class="box-body">

        </div>
    </div>

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