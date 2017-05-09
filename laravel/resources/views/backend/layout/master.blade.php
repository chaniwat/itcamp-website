<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ITCAMP13 - Backend</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- favicon -->
        <link rel="icon" type="image/png" href="{{ asset('assets/frontend/favicon/favicon-32x32.png') }}" sizes="32x32" />
        <link rel="icon" type="image/png" href="{{ asset('assets/frontend/favicon/favicon-16x16.png') }}" sizes="16x16" />

        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{ asset('assets/backend/bootstrap/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('assets/backend/plugins/datatables/dataTables.bootstrap.css') }}"/>
        <!-- addition style for each pages -->
        @yield('style')
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/backend/adminlte/css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('assets/backend/adminlte/css/skins/_all-skins.min.css') }}">
        <!-- Custom style for application -->
        <link rel="stylesheet" href="{{ asset('assets/backend/css/app.css') }}?v=1">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="hold-transition skin-black sidebar-mini">
        <div class="wrapper">

            @include('backend.component.navbar')

            @include('backend.component.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        @yield('content-header')
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    {!! $viewHelper->makeAlertStatus('backend.component.alert') !!}

                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            @include('backend.component.footer')

        </div>

        <!-- jQuery 2.2.3 -->
        <script src="{{ asset('assets/backend/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="{{ asset('assets/backend/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- Utility -->
        <script src="{{ asset('assets/backend/js/utility.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('assets/backend/plugins/fastclick/fastclick.js') }}"></script>
        <!-- DataTables -->
        <script src="{{ asset('assets/backend/plugins/datatables/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('assets/backend/plugins/datatables/dataTables.bootstrap.js') }}"></script>
        <!-- addition script for each pages -->
        @yield('script')
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/backend/adminlte/js/app.min.js') }}"></script>
    </body>
</html>
