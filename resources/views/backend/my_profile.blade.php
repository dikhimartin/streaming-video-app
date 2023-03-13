@extends('layouts.backend.app')
@section('content')

<!-- style -->
<link href="{{ URL::asset('admin_assets/assets/plugins/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet" />
<style type="text/css">

    .msg {
    display: none;
    }
    .error {
        color: red;
    }
    .success {
        color: green;
    }
    .img-profile {
      border-radius: 50%;
    }

    /* Image Profile*/
    .bgColor {
        background-color: #ffff;
        border-radius: 4px;
        text-align: center;    
    }
    .upload-preview {border-radius:4px;width: 200px;height: 200px;}
    #targetOuter{   
        position:relative;
        text-align: center;
        background-color: #dddddd;
        margin: 20px auto;
        width: 200px;
        height: 200px;
        border-radius: 4px;
    }
    .btnSubmit {
        background-color: #565656;
        border-radius: 4px;
        padding: 10px;
        border: #333 1px solid;
        color: #FFFFFF;
        width: 200px;
        cursor:pointer;
    }
    .inputFile{
        margin-top: 0px;
        left: 0px;
        right: 0px;
        top: 0px;
        width: 200px;
        height: 36px;
        background-color: #FFFFFF;
        overflow: hidden;
        opacity: 0;
        position: absolute;
        cursor: pointer;
    }
    .icon-choose-image {
        position: absolute;
        opacity: 0.5;
        top: 50%;
        left: 50%;
        margin-top: -24px;
        margin-left: -24px;
        width: 48px;
        height: 48px;
        cursor:pointer;
        
    }
    #profile-upload-option{
        display:none;
        position: absolute;
        top: 163px;
        left: 23px;
        margin-top: -24px;
        margin-left: -24px;
        border: #d8d1ca 1px solid;
        border-radius: 4px;
        background-color: #dddddd;
        width: 200px;
    }
    .profile-upload-option-list{
        margin: 1px;
        height: 25px;
        border-bottom: 1px solid #c4c4c4;
        cursor: pointer;
        position: relative;
        padding:5px 0px;
    }
    .profile-upload-option-list:hover{
        background-color: #fffaf5;
    }
</style>
<!-- style -->

<!-- Bread crumb and right sidebar toggle -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">{!! $pages_title !!}</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'admin' )) }}">{{ __('main.dashboard') }}</a></li>
            <li class="breadcrumb-item active">{!! $pages_title !!}</li>
        </ol>
    </div>
</div>
<!-- End Bread crumb and right sidebar toggle -->


<form action="javascript:void(0)" class="form-horizontal" method="POST" id="form_update_data_user" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30">
                            <!-- Upload Image Profile -->
                            <div class="form-group">
                                <div class="bgColor">
                                    <div id="targetOuter">
                                        <div id="targetLayer"><img src="{{ $image != '' ? '/images/profile/' . $image : '/images/profile/anonymous.png' }}" alt="" width="200px" height="200px" class="upload-preview " /></div>
                                            <img src="{{ URL::asset('admin_assets/assets/images/photo.png') }}"  class="icon-choose-image"/>
                                            

                                            <div class="icon-choose-image" onClick="showUploadOption()"></div>
                                                <div id="profile-upload-option">
                                                    <div class="profile-upload-option-list">
                                                        <input name="image" id="userImage" type="file" class="inputFile" onChange="showPreview(this);" accept="image/*">
                                                        </input>
                                                        <span>{{__('main.upload')}}</span>
                                                    </div>
                                                    <div class="profile-upload-option-list" onClick="removeProfilePhoto();">{{__('main.delete')}}</div>
                                                    <div class="profile-upload-option-list" onClick="hideUploadOption();">{{__('main.cancel')}}</div>
                                                </div>
                                        </div>  
                                    <div>
                                </div>  
                                <h4 class="card-title m-t-10">
                                    <a href="javascript:void(0)" id="name" data-type="text" data-pk="{{ $data_user->id_users }}" 
                                        data-title="Edit Name">
                                        {!! $data_user->name !!}
                                    </a>
                                </h4>
                                <h6 id="account_groups" class="card-subtitle">{{ $get_roles->name }}</h6>
                            </div>

                            <div class="row text-center justify-content-md-center">
                            </div>

                        </center>
                    </div>
                    <div><hr></div>
                   <div id="_token" class="hidden" data-token="{{ csrf_token() }}"></div>
                    <div class="card-body"> 
                        <small class="text-muted"></small>
                        <h6></h6> 
                        <small class="text-muted">{{ __('main.date_birth') }}</small>
                        <h6>{!! date('d M Y', strtotime(Auth::user()->date_birth)) !!}</h6> 

                        <small class="text-muted">{{__('main.email')}}</small>
                        <h6> <a href="javascript:void(0)" id="email" data-type="text" data-pk="{{ $data_user->id_users }}" 
                                data-title="Edit Email">{!! $data_user->email !!}
                            </a>
                        </h6> 

                        <small class="text-muted">{{__('main.telephone')}}</small>
                        <h6>
                            <a href="javascript:void(0)" id="telephone" data-type="text" data-pk="{{ $data_user->id_users }}" 
                                data-title="Edit telephone">{!! $data_user->telephone !!}
                            </a>
                        </h6> 

                        <small class="text-muted">{{__('main.address')}}</small>
                        <h6>

                        <a href="javascript:void(0)" id="address" data-type="textarea" data-pk="{{ $data_user->id_users }}" 
                            data-title="Edit Address">{!! $data_user->address !!}
                        </a>

                        <!--<div class="map-box">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div> <small class="text-muted p-t-30 db">Social Profile</small>

                        <br/>
                        <button class="btn btn-circle btn-secondary"><i class="fa fa-facebook"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fa fa-twitter"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fa fa-youtube"></i></button>-->
                    
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs profile-tab" role="tablist">
                        <li class="nav-item"> <a class="nav-link active profile" data-toggle="tab" href="#profile" role="tab">{{__('main.profiles')}}</a> </li>
                        <li class="nav-item"> <a class="nav-link account" data-toggle="tab" href="#account" role="tab">{{__('main.account')}}</a> </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!--profile-->
                        <div class="tab-pane active" id="profile" role="tabpanel">
                            <p style="margin-top: 25px;"></p>
                            <div class="card-body">

                                    <div class="form-group" id="name">
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-bottom: 5px;">{{ __('main.name') }} &nbsp;<span class="required">*</span></label>
                                        <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
                                            <input type="text" class="form-control" name="names" placeholder="Full Name" value="{{$name}}" autocomplete="off" />
                                            <small class='form-control-feedback' id="alert-full-name"></small>
                                        </div>
                                    </div>

                                    <!-- gender -->
                                    <div class="form-group">
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-bottom: 5px;">{{ __('main.gender') }} &nbsp;<span class="required">*</span></label>
                                        <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
                                            <label class="custom-control custom-radio">
                                                <input id="jk1" name="gender" type="radio" class="custom-control-input" value="L" {{ $gender == 'L' ? "checked" : "" }} >
                                                <span class="custom-control-label">{{__('main.male')}}</span>
                                            </label>
                                            <label class="custom-control custom-radio">
                                                <input id="jk2" name="gender" type="radio" class="custom-control-input" value="P"  {{ $gender == 'P' ? "checked" : "" }}>
                                                <span class="custom-control-label">{{__('main.female')}}</span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- email -->
                                    <div class="form-group" id="email_verif">
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-bottom: 5px;">{{ __('main.email') }} &nbsp;<span class="required">*</span></label>
                                        <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
                                            <input name="email" type="email" class="form-control" placeholder="Email" value="{{$email}}" autocomplete="off" >
                                            <small class='form-control-feedback msg error'>{{__('main.not_valid_email')}}</small>
                                            <small class='form-control-feedback msg success'>{{__('main.valid_email')}}</small>
                                            <small class='form-control-feedback' id="alert-email"></small>
                                        </div>
                                    </div>

                                    <!-- telephone -->
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-5" style="margin-bottom: 5px;">{{__('main.telephone')}}</label>
                                            <div class=" controls col-md-9">
                                                <input type="telephone" name="telephone" class="form-control" minlength="12" maxlength="20" placeholder="Telephone" value="{!! $data_user->telephone !!}" autocomplete="off"> 
                                                <small class="form-control-feedback"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- address -->
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-5" style="margin-bottom: 5px;">{{__('main.address')}}</label>
                                            <div class="col-md-9">
                                               <textarea name="address" class="form-control" placeholder="Address" data-autosize="" style="overflow: hidden visible; overflow-wrap: break-word;">{!! $data_user->address !!}</textarea>
                                                <small class="form-control-feedback"></small>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <!-- Account -->
                        <div class="tab-pane" id="account" role="tabpanel">
                            <div class="card-body">
                                <p style="margin-top: 25px;"></p>

                                <input type="hidden" name="type_check" value="2">
                                <input type="hidden" name="remove_image">
                                
                                <div class="form-group" id="username">
                                    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-bottom: 5px;">{{ __('main.username') }} &nbsp;<span class="required">*</span></label>
                                    <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
                                        <input type="hidden" name="username_old" value="{{$nik}}" autocomplete="off" />
                                        <input type="text" class="form-control" name="username" value="{{$nik}}" autocomplete="off" />
                                        <small class='form-control-feedback' id='alert-username'></small>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="m-b-10">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input check_password">
                                            <span class="custom-control-label">{{__('main.change_password')}}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
                                        <div class="alert alert-success"> 
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                            {{__('main.change_password_remarks')}}
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- changes passsword -->
                                <div class="option_changes_password" style="display: none;">
                                    <div id="option_changes_password"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <a href="javascript:void(0)" id="update_button" class="btn btn-sm btn-info">
                                    <i class="fa fa-paper-plane"></i>&nbsp;&nbsp;{{__('main.update')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End PAge Content -->
    </div>
    <div class="modal fade col-md-12" id="modals_confirm" role="dialog" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title text-white"></h4>
                    <button type="button" class="close text-white" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <!-- Modal Form -->
                <div class="modal-body">
                    <div class="widget-box">
                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5>{{__('main.please_enter_password')}}</h5>
                                        <hr>
                                        <input type="hidden" name="type_submit" value="profile">
                                        <!-- Password -->
                                        <div class="form-group">
                                            <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-bottom: 5px;">{{__('main.password')}}</label>
                                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
                                                <input type="password" class="form-control" name="password_confirm">
                                                <small class="form-control-feedback" id="alert-password"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnSave" onclick="update_users()" class="btn btn-sm btn-info"><i
                                class="fa fa-paper-plane"></i> {{__('main.confirm')}}</button>
                        <button type="button" class="btn-sm btn waves-effect waves-light btn-secondary"
                            data-dismiss="modal"><i class="fa fa-reply"></i> {{__('main.cancel')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{ URL::asset('admin_assets/assets/plugins/jquery/jquery.min.js') }}"></script>

@endsection

@push('js')
    <script type="text/javascript" src="{{ URL::asset('admin_assets/assets/plugins/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js') }}">
    </script>   

    <script type="text/javascript">

        //type_submit
        $(".profile").on("click", function () {
            $("input[name=type_submit]").val("profile")
        });
        $(".account").on("click", function () {
            $("input[name=type_submit]").val("account")
        });

        $("#update_button").on("click", function () {
            $('#modals_confirm').modal('show');
            $("input[name=password_confirm]").val("");
            $(".modal-title").text("{{__('main.confirm_of_change')}}")
        });

        function update_users() {
            var url;
            url = "{{url('admin/update_profile')}}";
            // ajax adding data to database
            var formdata = new FormData($('#form_update_data_user')[0]);

            $.ajax({
                url: url,
                type: "POST",
                data: formdata,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (data) {
                    data_result = data.data_result;
                    if (data_result.message == "update_success") {
                        $('#modals_confirm').modal('hide');
                        swal("{{__('main.success')}}","{{__('main.data_has_been_changed')}}","success");
                    }
                    if (data_result.message == "password_confirm_required") {
                        $('#modals_confirm').modal('show');
                        swal("{{__('main.failed')}}", "{{__('main.warning_password')}}", "error");
                    }
                    if (data_result.message == "password_false") {
                        $('#modals_confirm').modal('show');
                        swal("{{__('main.failed')}}", "{{__('main.wrong_password')}}", "error");
                    }
                },
                error: function (data) {
                }
            });
        }

        $(".check_password").change(function() {
            if(this.checked) {
                $(".option_changes_password").show();

                data = '<div class="form-group" id="password">'+
                            '<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-bottom: 5px;">{{__('main.password')}}</label>'+
                            '<div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">'+
                                '<input type="password" class="form-control password" name="password" />'+
                                '<small class="form-control-feedback" id="alert-password"></small>'+
                            '</div>'+
                        '</div>'+

                       '<div class="form-group" id="confirm_password">'+
                            '<label class="col-lg-5 col-md-5 col-sm-5 col-xs-12" style="margin-bottom: 5px;">{{__('main.repeat_password')}}</label>'+
                           '<div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">'+
                                '<input type="password" class="form-control confirm_password" name="confirm_password"/>'+
                                '<small class="form-control-feedback" id="alert-confirm-password"></small>'+
                            '</div>'+
                        '</div>';
                $("#option_changes_password").html(data);
            }else{
                $(".option_changes_password").hide();
                $("#option_changes_password div.form-group").remove();
            }
        });

        function validasi_input(form){

            $('.has-success').removeClass( "has-success");
            $('.has-danger').removeClass( "has-danger");
            $('.form-control-feedback').text("");

            // validasi
            if (form.full_name.value == ""){
                $("#full_name").addClass("form-group has-danger");
                $("#alert-full-name").text("Please fill in Full Name");
                form.full_name.focus();
                return (false);
            }
            if (form.email.value == ""){
                $("#email_verif").addClass("form-group has-danger");
                $("#alert-email").text("Please fill in Email");
                form.email.focus();
                return (false);
            }
            var id_grup   = $("select[name='id_group']").select().val();
            if (id_grup == null){
                $("#id_grup").addClass("form-group has-danger");
                $("#alert-id-grup").text("Please fill in Group");
                form.id_group.focus();
                return (false);
            }
            if (form.username.value == ""){
                $("#username").addClass("form-group has-danger");
                $("#alert-username").text("Please fill in Username");
                form.username.focus();
                return (false);
            }

            // cek username
                var type_check     = $("input[name=type_check]").val()
                var username       = $("input[name=username]").val()
                var username_old   = $("input[name=username_old]").val()

                $('.has-danger').removeClass( "has-danger");
                $('.has-success').removeClass( "has-success");
                $('.form-control-feedback').text("");

                var value = $("input[name='username']").val();
                if (value.length < 5) {
                    $("#username").addClass("form-group has-danger");
                    $("#alert-username").text("Must be at least 5 characters");
                    return false;
                }


                $.ajax({
                    url: "/lib/setting/user/check_username/",
                    type: "POST",
                    data: {
                            "username"   :username,
                            "type_check" :type_check,
                            "username_old" :username_old
                            },
                    contentType: 'application/json',
                }).then(function (res) {

                    if (res.kode == "1") {
                        $("#username").addClass("form-group has-danger");
                        $("#alert-username").text("Sorry , Username is already used");
                        return (false);
                    }else{
                        return (false);
                    }

                }).catch(function (a) {
                    alert("ERROR");
                });
            // end            

            // cek password
            var password = $("input[name=password]").val();
            if (password != "") {
                if(password.length < 8){
                    $("#password").addClass("form-group has-danger");
                    $("#alert-password").text("must be at least 8 characters");
                    return false
                }
                if(!/\d/.test(password)){
                    $("#password").addClass("form-group has-danger");
                    $("#alert-password").text("should contain at least one number");
                    return false
                }
                if(!/[a-z]/.test(password)){
                    $("#password").addClass("form-group has-danger");
                    $("#alert-password").text("should contain at least one lower case");
                    return false
                }
                if(!/[A-Z]/.test(password)){
                    $("#password").addClass("form-group has-danger");
                    $("#alert-password").text("should contain at least one upper case");
                    return false
                }
                if(/[^0-9a-zA-Z]/.test(password)){
                    $("#password").addClass("form-group has-danger");
                    $("#alert-password").text("should contain at least 8 from the mentioned characters");
                    return false
                }               
                if ($('.password').val() != $('.confirm_password').val()) {
                    $("#password").addClass("form-group has-danger");
                    $("#alert-password").text("Password Not Match");

                    $("#confirm_password").addClass("form-group has-danger");
                    $("#alert-confirm-password").text("Password Not Match");
                    return false
                }            
            }
            // end
          

            return (true);
        }

        // cek username
        $("input[name='username']").on("submit keyup", function (e) {

            var type_check     = $("input[name=type_check]").val()
            var username       = $("input[name=username]").val()
            var username_old   = $("input[name=username_old]").val()


            $('.has-danger').removeClass( "has-danger");
            $('.has-success').removeClass( "has-success");
            $('.form-control-feedback').text("");

            var value = $("input[name='username']").val();
            if (value.length < 5) {
                $("#username").addClass("form-group has-danger");
                $("#alert-username").text("Must be at least 5 characters");
                return false;
            }
            $.ajax({
                url: "{{url('admin/check_username')}}",
                type: "POST",
                data: {
                        'type_check'    :type_check,
                        'username'      :username,
                        'username_old'  :username_old
                      },
                headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                },
            }).then(function (res) {
                if (res == 1) {
                    $("#username").addClass("form-group has-danger");
                    $("#alert-username").text("{{__('main.alert_username_false')}}");
                }else if (res == 0) {
                    $("#username").addClass("form-group has-success");
                    $("#alert-username").text("{{__('main.alert_username_true')}}");
                }
            }).catch(function (a) {
                alert("ERROR");
            });
        });

        $('.password, .confirm_password').on('submit keyup', function () {

            $('.has-danger').removeClass( "has-danger");
            $('.has-success').removeClass( "has-success");
            $('.form-control-feedback').text("");

            var value = $("input[name=password]").val();
            if(value.length < 8){
                $("#password").addClass("form-group has-danger");
                $("#alert-password").text("must be at least 8 characters");
                return false
            }
            if(!/\d/.test(value)){
                $("#password").addClass("form-group has-danger");
                $("#alert-password").text("should contain at least one number");
                return false
            }
            if(!/[a-z]/.test(value)){
                $("#password").addClass("form-group has-danger");
                $("#alert-password").text("should contain at least one lower case");
                return false
            }
            if(!/[A-Z]/.test(value)){
                $("#password").addClass("form-group has-danger");
                $("#alert-password").text("should contain at least one upper case");
                return false
            }
            if(/[^0-9a-zA-Z]/.test(value)){
                $("#password").addClass("form-group has-danger");
                $("#alert-password").text("should contain at least 8 from the mentioned characters");
                return false
            }

            // match
            if ($('.password').val() == $('.confirm_password').val()) {

                $("#password").addClass("form-group has-success");
                $("#alert-password").text("Password Match");

                $("#confirm_password").addClass("form-group has-success");
                $("#alert-confirm-password").text("Password Match");
            } else {

                $("#password").addClass("form-group has-danger");
                $("#alert-password").text("Password Not Match");

                $("#confirm_password").addClass("form-group has-danger");
                $("#alert-confirm-password").text("Password Not Match");
            }
        });  

        // email validation
        $('form input[name="email"]').blur(function () {
            var email = $(this).val();
            var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/igm;
            if (re.test(email)) {
                $('.msg').hide();
                $('.success').show();
            } else {
                $('.msg').hide();
                $('.error').show();
            }
        });   

        //text inline update
        $(document).ready(function() {

         $.fn.editable.defaults.mode = 'inline';

           $.fn.editable.defaults.params = function (params) 
           {
            params._token = $("#_token").data("token");
            return params;
           };


            $('#name').editable({
                    validate: function(value) {
                        if($.trim(value) == '') 
                            return 'Value is required.';
                        },
                    type: "text",
                    url:'{{url('admin/UpdateInlineName')}}',  
                    send:'always',
                    ajaxOptions: {
                    dataType: 'json'
                    }
            });


            $('#email').editable({
                    validate: function(value) {
                        if($.trim(value) == '') 
                            return 'Value is required.';
                        },
                    type: "text",
                    url:'{{url('admin/UpdateInlineEmail')}}',  
                    send:'always',
                    ajaxOptions: {
                    dataType: 'json'
                    }
            });

            $('#telephone').editable({
                validate: function(value) {
                    if($.trim(value) == '') 
                        return 'Value is required.';
                    },
                type: "text",
                url:'{{url('admin/UpdateInlineTelephone')}}',  
                send:'always',
                ajaxOptions: {
                dataType: 'json'
                }
            });

            $('#address').editable({
                validate: function(value) {
                    if($.trim(value) == '') 
                        return 'Value is required.';
                    },
                type: "text",
                url:'{{url('admin/UpdateInlineAddress')}}',  
                send:'always',
                ajaxOptions: {
                dataType: 'json'
                }
            });
        });     

        // image profile
        function showPreview(objFileInput) {
            hideUploadOption();
            if (objFileInput.files[0]) {
                var fileReader = new FileReader();
                fileReader.onload = function (e) {
                    $("#targetLayer").html('<img src="'+e.target.result+'" width="200px" height="200px" class="upload-preview" />');
                    $("#targetLayer").css('opacity','0.7');
                    $(".icon-choose-image").css('opacity','0.5');
                    $("input[name=remove_image]").val('');
                }
                fileReader.readAsDataURL(objFileInput.files[0]);
            }
        }
        function showUploadOption(){
            $("#profile-upload-option").css('display','block');
        }
        function hideUploadOption(){
            $("#profile-upload-option").css('display','none');
        }
        function removeProfilePhoto(){
            hideUploadOption();
            $("#userImage").val('');
            $("input[name=remove_image]").val('1');
            $("#targetLayer").html('');
        }
    </script>
@endpush