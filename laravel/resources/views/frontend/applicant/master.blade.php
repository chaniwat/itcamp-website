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

        @yield('style')
    </head>

    <body>
        @yield('body')

        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $(function(){
                if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
                    var ww = ( $(window).width() < window.screen.width ) ? $(window).width() : window.screen.width; //get proper width
                    var mw = 580; // min width of site
                    var ratio =  ww / mw; //calculate ratio
                    if( ww < mw){ //smaller than minimum size
                        $('#Viewport').attr('content', 'initial-scale=' + ratio + ', maximum-scale=' + ratio + ', minimum-scale=' + ratio + ', user-scalable=no, width=' + ww);
                    }else{ //regular size
                        $('#Viewport').attr('content', 'initial-scale=1.0, maximum-scale=2, minimum-scale=1.0, user-scalable=no, width=' + ww);
                    }
                }
            });
        </script>
    </body>
</html>