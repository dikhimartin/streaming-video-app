@extends('layouts.backend.login')

@section('content')
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register">
            <div class="login-box card">
                <div class="card-body">
                    <!-- Form Login -->
                    <form action="/login" class="form-horizontal form-material login-form" id="loginform" role="form" method="POST" onsubmit="return validasi_input(this)">
                        {{ csrf_field() }}

                            <a href="javascript:void(0)" onclick="location.reload()" class="text-center db"><img src="{{ URL::asset('admin_assets/assets/images/logo-icon.png') }}" alt="MartinCodes" width="100" />
                                <br/>
                                <br/>
                                    <h4 align="center" class="box-title m-b-15 text-muted">{{ config('app.name', 'Laravel') }}</h4>
                                <br/>
                            </a>
                            <p style="margin-top: 10px;"></p>
                            <h3 class="box-title m-b-20"></h3>

                            <div class="form-group" id="username">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text"placeholder="Username" name="nik" value="{{ old('nik') }}">
                                </div>
                                <small class="form-control-feedback" id="alert-username"></small>
                            </div>

                            <div class="form-group" id="password">
                                <div class="col-xs-12">
                                    <input name="password" class="form-control" type="password" placeholder="Password">
                                </div>
                                <small class="form-control-feedback" id="alert-password"></small>
                            </div>

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    <p> {{ session('error') }}</p>
                                </div>
                            @endif


                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">{{__('main.login')}}</button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 font-14">
                                    <div class="checkbox checkbox-primary pull-left p-t-0">
                                        <input id="checkbox-signup" type="checkbox">
                                        <label for="checkbox-signup">{{__('main.remember_me')}}</label>
                                    </div> 
                                    <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> {{ __('main.forgot_password') }}?</a> 
                                </div>
                            </div>

                            <div class="form-group m-b-0">
                                <div class="col-sm-12 text-center">
                                    <div>{{ __('main.dont_have_an_account') }} <a href="javascript:void(0)" class="text-info m-l-5"><b>{{ __('main.signup') }}</b></a></div>
                                </div>
                            </div>
                    </form>

                    <!-- reset password -->
                    <form class="form-horizontal"  id="recoverform" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>{{ __('main.recover_password') }}</h3>
                                <p class="text-muted">{{ __('main.send_password_reset_link_detail') }}</p>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                             <div class="col-xs-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group text-center m-t-20">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('main.send_password_reset_link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                     <!-- reset password -->
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
@endsection

<script type="text/javascript">
    function validasi_input(form){

        $('.has-success').removeClass( "has-success");
        $('.has-danger').removeClass( "has-danger");
        $('.form-control-feedback').text("");

        // validasi
        if (form.nik.value == ""){
            $("#username").addClass("form-group has-danger");
            $("#alert-username").text("Please fill in Username");
            form.nik.focus();
            return (false);
        }
        if (form.password.value == ""){
            $("#password").addClass("form-group has-danger");
            $("#alert-password").text("Please fill in Password");
            form.password.focus();
            return (false);
        }

        return (true);
    }
</script>

