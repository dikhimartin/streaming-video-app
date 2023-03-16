@extends('layouts.backend.login')
@section('bodyClass', 'not-front')
@section('navActive', '')

@section('content')

<!-- main start -->
<section class="main">
    <!-- page intro start -->
   <div class="v-page-heading v-bg-stylish v-bg-stylish-v1">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="heading-text">
                    <h1 class="entry-title">{{ __('main.reset_password') }}</h1>
                </div>
                <ol class="breadcrumb">
                    <li><a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( '/' )) }}"><i class="fa fa-home"></i>{{ __('main.home') }}</a></li>
                    <li class="active">{{ __('main.reset_password') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
    <!-- page intro end -->


    <!-- main content wrapper start -->
</br>
</br>
</br>
    <div class="main-content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-2">
                    
                        
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">{{ __('main.email') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('main.send_password_reset_link') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </div>
    <!-- main content wrapper end -->
</section>
<!-- main end -->

@endsection
