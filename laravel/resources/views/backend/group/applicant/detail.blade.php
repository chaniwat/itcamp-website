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

    {{--
        TODO Confirm Approve/Reject Modal
        TODO Go to applicant id (pre-fetch|ajax|optional), Go previous/next aapplicnt
    --}}

    <div class="box box-solid box-info">
        <div class="box-header with-border">
            <h3 class="box-title">กล่องควบคุม</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12" style="margin-bottom: 1rem;">
                    <div class="input-group" style="width: 250px; margin-bottom: 0.8rem;">
                        <input type="text" class="form-control" placeholder="Applicant ID">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button">Go to ID</button>
                        </span>
                    </div>
                    <button class="btn btn-primary" data-target="all"><< Previous Applicant</button>
                    <button class="btn btn-primary" data-target="all">Next Applicant >></button>
                </div>
                <div class="col-xs-12">
                    <hr style="margin: 1rem 0; border-width: 3px;" />
                </div>
                <div class="col-xs-12">
                    <h2 style="margin-top: 0;">Status: รอการสรวจสอบ (PENDING)</h2>
                </div>
                <div class="col-xs-12">
                    <button class="btn btn-success" data-target="all">Approve</button>
                    <button class="btn btn-danger" data-target="all">Reject</button>
                </div>
            </div>
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