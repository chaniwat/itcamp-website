<header class="main-header">

    {{-- Logo --}}
    <a href="{{ route('view.backend.index') }}" class="logo">
        {{-- mini logo for sidebar mini 50x50 pixels --}}
        <span class="logo-mini"><b>#13</b></span>
        {{-- logo for regular state and mobile devices --}}
        <span class="logo-lg"><b>ITCAMP13</b></span>
    </a>

    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{ Auth::guard('backend')->user()->staff->name }} <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ asset('assets/backend/img/kids-avatars/boy.png') }}" class="img-circle" alt="User Image">

                            <p>
                                {{ Auth::guard('backend')->user()->staff->name }}
                                <small>{{ Auth::guard('backend')->user()->staff->is_head ? "เฮดฝ่าย" : "ลูกทีม" }} | @lang('section.'.Auth::guard('backend')->user()->staff->section->name)</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="{{ route('backend.auth.logout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

</header>