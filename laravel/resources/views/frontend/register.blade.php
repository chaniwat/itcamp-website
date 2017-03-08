<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#292B2C">

    <title>ITCAMP 13 | Register</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>

<body>
    {{-- TODO Design form bootstrap.v4 --}}

    <div class="container">
        <h1>หมายเหตุ</h1>
        <p>ยังไม่ใช่ดีไซน์ล่าสุด ตอนนี้แค่ลองฟังก์ชันอยู่ เหมือนจะมีบัคแฝงนิดหน่อยๆ ;w;</p>
    </div>

    <div class="container">
        <form action="{{ route('frontend.register', ['camp' => $camp]) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}

            <h2>ส่วนที่ 1 : ข้อมูลของผู้สมัคร</h2>
            <hr />
            <div class="row">
                @foreach($applicantQuestions as $question)
                    {!! $viewHelper->formBuilder()->buildInputField($question) !!}
                @endforeach
            </div>
            <div style="margin-top: 2rem;"></div>
            <h2>ส่วนที่ 2 : คำถามค่าย</h2>
            <hr />
            <div class="row">
                @foreach($campQuestions as $question)
                    {!! $viewHelper->formBuilder()->buildInputField($question) !!}
                @endforeach
            </div>
            <hr />
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-block btn-success">สมัคร eiei</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>

</html>