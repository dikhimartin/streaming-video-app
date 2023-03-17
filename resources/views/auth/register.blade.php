@extends('layouts.backend.login')

@section('content')
<section id="wrapper">
        <div class="login-register">
            <div class="login-box card">
                <div class="card-body">
                    <!-- Form Registrasi -->
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <a href="javascript:void(0)" onclick="location.reload()" class="text-center db"><img src="{{ URL::asset('admin_assets/assets/images/logo-icon.png') }}" alt="MartinCodes" width="100" />
                        <br/>
                        <br/>
                            <h4 align="center" class="box-title m-b-15 text-muted">{{ config('app.name', 'Laravel') }}</h4>
                        <br/>
                    </a>
                    <p style="margin-top: 10px;"></p>
                    <h3 class="box-title m-b-20"></h3>

                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" placeholder="Name" name="name" value="{{ old('name') }}">
                        </div>
                        @if ($errors->has('name'))
                            <small class="form-control-feedback">{{ $errors->first('name') }}</small>
                        @endif
                    </div>    

                    <div class="form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" placeholder="Username" name="username" value="{{ old('username') }}">
                        </div>
                        @if ($errors->has('username'))
                            <small class="form-control-feedback">{{ $errors->first('username') }}</small>
                        @endif
                    </div>    

                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="Password" name="password" value="{{ old('password') }}">
                        </div>
                        @if ($errors->has('password'))
                            <small class="form-control-feedback">{{ $errors->first('password') }}</small>
                        @endif
                    </div>    

                    <div class="col-xs-12">
                        <input class="form-control" id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required">
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Register</button>
                        </div>
                    </div>                
                  
                </form>
                </div>
            </div>
        </div>
</section>
@endsection
