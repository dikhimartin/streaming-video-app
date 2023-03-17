@extends('layouts.backend.app')
@section('content')
    <!-- Bread crumb and right sidebar toggle -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{!! $pages_title !!}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'admin/dashboard' )) }}">{{ __('main.dashboard') }}</a></li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">        
                        <h4 class="card-title" id="1">Welcome Back!&nbsp;&nbsp;<strong>{{ $data_user->name }}</strong></h4>
                        <h4 class="card-subtitle">{{ $data_user->display_name }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor_js')
  <script src="{{ URL::asset('admin_assets/assets/plugins/toast-master/js/jquery.toast.js') }}"></script>
  <script type="text/javascript">
        @if (session()->has('success'))
             $.toast({
                heading: 'Welcome {{ $data_user->name }}',
                text: '{!! session()->get('success') !!}',
                position: 'top-right',
                loaderBg:'#ff6849',
                icon: 'info',
                hideAfter: 5500, 
                stack: 6
              });
        @endif
  </script>
@endsection
