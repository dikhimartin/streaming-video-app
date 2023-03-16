<?php 
    $user = Auth::user();
?>

<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile">
            <!-- User profile image -->
            <div class="profile-img"> <img src="{{ $user->image != '' ? '/images/profile/' . $user->image : '/images/profile/anonymous.png' }}" alt="user" width="150"/> 
                <div class="notify setpos">
                    <span class="heartbit"></span> 
                    <span class="point"></span> 
                </div>
            </div>

            <!-- User profile text-->
            <div class="profile-text"> 
                <h5>{{ $user->name }}</h5>
                 <h6 id="account_group" class="text-muted">Superadmin</h6>
                <a href="javascript:void(0)" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                    <i class="mdi mdi-settings"></i>
                </a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="" data-toggle="tooltip" title="{{ __('main.logout') }}">
                    <i class="mdi mdi-power"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>

                <div class="dropdown-menu animated flipInY">
                    <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'admin/my_profile' )) }}" class="dropdown-item">
                        <i class="ti-user"></i> {{__('main.profile')}}
                    </a>

                    <div class="dropdown-divider"></div>

                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                        <i class="fa fa-power-off"></i> {{ __('main.logout') }}
                    </a>
                </div>
            </div>
        </div>
        <!-- End User profile text-->

        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                 <li class="nav-devider"></li>

                <li class="hover {!! trim($__env->yieldContent('sidebarActive')) == 'bank' ? ' active' : '' !!}">
                    <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'admin/dashboard' ))}}" class="waves-effect" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">{{ __('main.dashboard') }}</span></a>
                </li>

                <!--SETTING MODUL-->
                @if ($user->can('users-list') || $user->can('roles-list') || $user->can('group_user-list') )
                    <li>
                        <a class="has-arrow waves-effect" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></i>&nbsp;<span class="hide-menu">{{ __('main.setting') }}</span>
                        </a>
                        <ul id="setting_expand" aria-expanded="false" class="collapse">
                            @if ($user->can('users-list') || $user->can('roles-list') || $user->can('group_user-list') )
                                <li id="users_privilege"> 
                                    <a class="has-arrow" href="javascript:void:0" aria-expanded="false">
                                        <i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;{{__('main.user_access')}}
                                    </a>
                                    <ul aria-expanded="false" class="collapse">
                                        
                                        @if ($user->can('users-list'))
                                             <li class="hover {!! trim($__env->yieldContent('sidebarActive')) == 'users' ? ' active' : '' !!}">
                                                <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'admin/users' ))}}">
                                                    <span class="menu-text"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;{{ __('main.user_list') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($user->can('group_user-list'))
                                             <li class="hover {!! trim($__env->yieldContent('sidebarActive')) == 'group_user' ? ' active' : '' !!}">
                                                <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'admin/group_user' ))}}">
                                                    <span class="menu-text"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;{{ __('main.group_user') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($user->can('roles-list'))
                                             <li class="hover {!! trim($__env->yieldContent('sidebarActive')) == 'setting' ? ' active' : '' !!}">
                                                <a href="{{ route('roles.index') }}">
                                                    <span class="menu-text"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;{{ __('main.user_role') }}</span>
                                                </a>
                                            </li>
                                        @endif
                                       


                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                 
            </ul>
        </nav>
        <!-- End Sidebar navigation -->

    </div>
    <!-- End Sidebar scroll-->
</aside>
