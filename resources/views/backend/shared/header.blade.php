<?php 
    $user = Auth::user();
    $controller = $user->hasRole('agent') ? 'agent' : 'admin';
?>

<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="">
                <!-- Logo icon -->
                <b>
                    <img src="{{ URL::asset('admin_assets/assets/images/logo-icon-small.png') }}" alt="Dashboard" class="dark-logo" width="" />
                </b>
                <!--End Logo icon -->

                <!-- Logo text -->
                 <!-- dark Logo text -->
                <span>
                     <img src="{{ URL::asset('admin_assets/assets/images/logo-text.png') }}" alt="Dashboard" class="dark-logo" />
                     <!-- Light Logo text -->    
                     <img src="{{ URL::asset('admin_assets/assets/images/logo-light-text.png') }}" class="light-logo" alt="Dashboard"/>
                 </span> 
                <!--End Logo Text -->
             </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->

        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto mt-md-0">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>

                <!-- notifications -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                        <div class="notify"> 
                            <span class="heartbit"></span> <span class="point"></span> 
                        </div>
                    </a>
                    <div class="dropdown-menu mailbox animated slideInUp">
                        <ul>
                            <li>
                                <div class="drop-title">Notifications</div>
                            </li>
                            <li>
                                <div class="message-center">
                                    <!-- Message -->
                                    <a href="/">
                                        <div class="mail-contnet">
                                         <h5>Out of Stock</h5> 
                                            <span class="mail-desc">Romano Force Anti..</span> 
                                            <span class="time">9:30 AM</span> 
                                        </div>
                                    </a>
                                    <a href="/">
                                        <div class="mail-contnet">
                                         <h5>Incoming Goods</h5> 
                                            <span class="mail-desc">Romano Force Anti..</span> 
                                            <span class="time">9:30 AM</span> 
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>

            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- language -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img alt="" src="/images/flags_large/{{laravellocalization::getcurrentlocale()}}.png" width="22">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right scale-up"> 
                         @foreach(laravellocalization::getsupportedlocales() as $localecode => $properties)
                            @if ($localecode != laravellocalization::getcurrentlocale())
                            @if ($localecode != 'zh')
                                <a href="/{{ $localecode }}/{{ $controller }}/dashboard">
                                    <img alt="" src="/images/flags_large/{{$localecode}}.png?123" width="22"> {{ $properties['name'] }} </a>
                            @endif
                            @endif
                        </a> 
                         @endforeach
                    </div>
                </li>

                <!-- ============================================================== -->
                <!-- profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ $user->image != '' ? '/images/profile/' . $user->image : '/images/profile/anonymous.png' }}" alt="user" class="profile-pic" /></a>
                    <div class="dropdown-menu dropdown-menu-right scale-up">
                        <ul class="dropdown-user">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="{{ $user->image != '' ? '/images/profile/' . $user->image : '/images/profile/anonymous.png' }}" alt="user"></div>
                                    <div class="u-text">
                                        <h4>{{ $user->name }}</h4>
                                        <p class="text-muted">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </li>

                            <li role="separator" class="divider"></li>

                            <li><a href="{{ laravellocalization::getlocalizedurl(laravellocalization::getcurrentlocale(),url::to( $controller .'/my_profile' )) }}"><i class="ti-user"></i> 
                                {{__('main.profile')}}</a>
                            </li>

                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off"></i> {{ __('main.logout') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>