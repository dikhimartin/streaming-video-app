@extends('layouts.backend.app')
@section('content')

    <!-- CSS -->
    <style type="text/css">
        .modal-lg {
            max-width: 80% !important;
        }
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
            max-width: 440px;
            height: 400px;
            background-color: #ffff;
            padding: 30px;
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
        #DivtargetOuter{   
            position:relative;
            text-align: center;
            margin: auto;
            width: 200px;
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

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('admin_assets/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">

    <!-- Bread crumb and right sidebar toggle -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{!! $pages_title !!}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'dashboard' )) }}">{{ __('main.dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{__('main.setting')}}</a></li>
                <li class="breadcrumb-item active">{!! $pages_title !!}</li>
            </ol>
        </div>
    </div>
    <!-- End Bread crumb and right sidebar toggle -->


    <!-- Konten -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h4 class="card-title m-b-0 text-white">List Data</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Button -->
                                <div class="button-group">
                                    @permission('users-create')
                                     <a href="javascript:void(0)" onclick="add_data()">
                                         <button class="btn btn-info btn-sm waves-light" type="button" data-toggle="tooltip" data-placement="top" title="{{ __('main.add_new') }}"><span class="btn-label"><i class="fa fa-plus"></i></span>&nbsp;{{ __('main.add_new') }}
                                         </button>
                                     </a>
                                    @endpermission
                                     <button class="btn btn-warning btn-sm" onclick="reload_table()">
                                        <i class="fa fa-refresh"></i>&nbsp&nbsp;{{__('main.reload')}}
                                     </button>      
                                </div>
                            </div>
                        </div>

                        <!-- Data -->
                        <p style="margin-bottom: 20px;"></p>
                        <div id="notif_success"></div>
                        <div class="table-responsive m-t-40">
                            <table id="data-users" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('main.no') }}</th>
                                        <th>{{ __('main.role') }}</th>
                                        <th>{{ __('main.name') }}</th>
                                        <th>{{ __('main.email') }}</th>
                                        <th>{{ __('main.gender') }}</th>
                                        <th>{{ __('main.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Form Modal -->
    <div class="modal fade col-md-12" id="modal_form" role="dialog" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg">
        <form class="form-horizontal" method="post" id="form" enctype="multipart/form-data">
          {{ csrf_field() }}
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header center bg-info">
              <h4 class="modal-title text-white"></h4>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <!-- Modal Form -->
            <div class="modal-body">
                <div class="widget-box">
                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="hidden" value="" name="id_users" id="id_users"/>
                                    <div class="row ">

                                            <!-- Image Session -->
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="profile-info-inner">
                                                            <div class="profile-image">
                                                                <!-- Upload Image Profile -->
                                                                <div class="form-group">

                                                                    <div class="bgColor">
                                                                             <div id="DivtargetOuter">
                                                                                <div class="alert alert-info">For the best view 300 x 300 px</div>
                                                                             </div>

                                                                             <div id="targetOuter">
                                                                                <div id="targetLayer"></div>
                                                                                <img src="{{URL::asset('admin_assets/assets/images/photo.png')}}"  class="icon-choose-image"/>
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

                                                                            <input type="button" value="{{ __('main.choose_image') }}" class="btnSubmit" onClick="showUploadOption()"/>
                                                                            </div>


                                                                    </div>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  

                                            <!-- Data -->
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="form-horizontal">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                                                <ul class="nav nav-tabs profile-tab" role="tablist">
                                                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">{{__('main.profiles')}}</a> </li>
                                                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#account" role="tab">{{__('main.account')}}</a> </li>
                                                                </ul>


                                                                <div class="tab-content">
                                                                    <div class="tab-pane active" id="profile" role="tabpanel">
                                                                        <div class="card-body">
                                                                            <p style="margin-top: 25px;"></p>

                                                                            <input type="hidden" name="status_image">

                                                                            <!--names-->
                                                                            <div class="form-body">
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-5">{{ __('main.name') }} <span class="required">*</span></label>
                                                                                    <div class="col-md-9">
                                                                                        <input name="names" id="name" placeholder="{{ __('main.name') }}" class="form-control" type="text"  required>
                                                                                        <small class="form-control-feedback"></small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!-- date of birth -->
                                                                            <div class="form-body">
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-5">{{ __('main.date_birth') }} <span class="required">*</span></label>
                                                                                    <div class="col-md-9">
                                                                                        <input name="date_birth" id="date_birth" placeholder="{{ __('main.date_birth') }}" class="form-control" type="text"  required>
                                                                                        <small class="form-control-feedback"></small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!--email-->
                                                                            <div class="form-body">
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-5">{{ __('main.email') }} <span class="required">*</span></label>
                                                                                    <div class="col-md-9 controls">
                                                                                        <input name="email" id="email" placeholder="{{ __('main.email') }}" class="form-control" type="email"  required>

                                                                                        <small class="form-control-feedback"></small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!--telepon-->
                                                                            <div class="form-body">
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-5">{{ __('main.telephone') }} <span class="required">*</span></label>
                                                                                    <div class=" controls col-md-9">
                                                                                        <input type="telephone" name="telephone" class="form-control"    minlength="12" maxlength="20" placeholder="{{ __('main.telephone') }}"> 
                                                                                        <small class="form-control-feedback"></small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!--address-->
                                                                            <div class="form-body">
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-5">{{ __('main.address') }} <span class="required">*</span></label>
                                                                                    <div class="col-md-9">
                                                                                       <textarea name="address" class="form-control" placeholder="{{ __('main.address') }}" data-autosize></textarea>
                                                                                        <small class="form-control-feedback"></small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!--pilih_gender-->    
                                                                            <div class="form-body" id="pilih_gender">
                                                                                <div class="form-group">
                                                                                    <label for="pilih_gender" class="col-md-5 control-label">{{ __('main.gender') }} <span class="required" aria-required="true"> * </span></label>
                                                                                    <div class="col-md-10">
                                                                                       <div class="demo-radio-button">
                                                                                            <label class="custom-control custom-radio">
                                                                                                <input id="radio1" name="gender" type="radio" class="custom-control-input" value="L" checked="">
                                                                                                <span class="custom-control-label">{{__('main.male')}}</span>
                                                                                            </label>
                                                                                            <label class="custom-control custom-radio">
                                                                                                <input id="radio2" name="gender" type="radio" class="custom-control-input" value="P">
                                                                                                <span class="custom-control-label">{{__('main.female')}}</span>
                                                                                            </label>
                                                                                        </div>


                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane" id="account" role="tabpanel">
                                                                        <div class="card-body">
                                                                            <p style="margin-top: 25px;"></p>
                                                                            <!--username-->
                                                                            <div class="form-group">
                                                                               <label class="control-label col-md-5">{{ __('main.username') }} &nbsp;<span class="required">*</span></label>
                                                                                <div class="col-md-9">
                                                                                    <input type="nik" name="nik" required="" placeholder="{{__('main.username')}}" class="form-control">
                                                                                     <small class="form-control-feedback"></small>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Hak akses Pengguna -->
                                                                            <div class="form-body" id="id_roles">
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-5">{{ __('main.user_role') }} <span class="required">*</span></label>
                                                                                    <div class="col-md-9">
                                                                                        <select name="id_role" class="form-control">
                                                                                            <option value="" disabled selected>--{{ __('main.choose') }} {{ __('main.user_role') }}--</option>
                                                                                            <option id="id_roles_superadmin" value="3" style="display: none;"></option>
                                                                                            @foreach ($dt_level as $kdt_level => $vdt_level)
                                                                                                <option value="{{ $vdt_level->id }}">{{ $vdt_level->display_name }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                         <small class="form-control-feedback"></small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Option Change Password -->
                                                                            <div class="check_changes_password" style="display: none;">
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
                                                                                            {{__('main.notice_change_password')}}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Change Password -->
                                                                            <div class="option_changes_password" style="display: none;">
                                                                                <div class="form-body">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-5">{{ __('main.password') }} <span class="required">*</span></label>
                                                                                        <div class="col-md-9">
                                                                                            <input name="password" id="password1" onkeyup="checkPass1(); return false;" placeholder="{{ __('main.password') }}" class="form-control" type="password"  required>
                                                                                            <small id="confirmMessage1" class="form-control-feedback"></small>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-body">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-5">{{ __('main.confirm') }} {{ __('main.password') }} <span class="required">*</span></label>
                                                                                        <div class="col-md-9">
                                                                                            <input name="name" placeholder="{{ __('main.confirm') }} {{ __('main.password') }}" class="form-control" type="password" id="password2" required="required" onkeyup="checkPass(); return false;">
                                                                                            <small id="confirmMessage" class="help-block form-control-feedback confirmMessage"></small>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                   
                <div class="modal-footer">
                    <button type="submit" id="btnSave" onclick="save()" class="btn btn-info btn-sm"></button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-reply">&nbsp;</i>Cancel</button>
                </div>
            </div>

          </div>
        </form>
      </div>
    </div>    


    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ URL::asset('admin_assets/assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
  
    <!-- ============================================================== -->
    <!-- Plugins for this page -->
    <!-- ============================================================== -->
    <!-- Plugin JavaScript -->
    <script src="{{ URL::asset('admin_assets/assets/plugins/moment/moment.js') }}"></script>
    <script src="{{ URL::asset('admin_assets/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

    <!-- Date Picker Plugin JavaScript -->
    <script src="{{ URL::asset('admin_assets/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">
        $('#date_birth').bootstrapMaterialDatePicker({ weekStart: 0, time: false });

        // Date Picker
        jQuery('.mydatepicker, #datepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        jQuery('#date-range').datepicker({
            toggleActive: true
        });
        jQuery('#datepicker-inline').datepicker({
            todayHighlight: true
        });
    </script>
@endsection

@push('js')
    <script type="text/javascript">

        $(".check_password").change(function() {
            if(this.checked) {
                $(".option_changes_password").show();

                data = '<div class="form-group" id="password">'+
                            '<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-bottom: 5px;">Password</label>'+
                            '<div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">'+
                                '<input type="password" class="form-control password" name="password" />'+
                                '<small class="form-control-feedback" id="alert-password"></small>'+
                            '</div>'+
                        '</div>'+

                       '<div class="form-group" id="confirm_password">'+
                            '<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-bottom: 5px;">Repeat Password</label>'+
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

        var save_method; //for save method string
        var table;
        $("#notif_success").hide();

        $(function(){
            table =$('#data-users').DataTable( {
                    "ajax": '{{ url("admin/get_users_data") }}'
            });
        });

        function reload_table(){ 
            $("#data-users tbody tr").remove();
            table.ajax.reload(null,false); //reload datatable ajax
        }

        function edited(id){
            save_method = 'update';
            document.getElementById("btnSave").disabled = false;
            $("#id_roles").show();
            $(".check_changes_password").show();
            $(".option_changes_password").hide();
            $("#btnSave").html('<i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Update');
            $('#form')[0].reset(); // reset form on modals
            $('.has-success').removeClass( "has-success");
            $('.has-danger').removeClass( "has-danger");
            $('.form-control-feedback').text("");
            $('.help-block').empty(); // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url : "{{ url('admin/get_users_data_byid') }}",
                type: "GET",
                dataType: "JSON",
                data: {"id":id},
                success: function(result)
                {

                    $('[name="id_users"]').val(result.data_users.id_users);
                    $('[name="nik"]').val(result.data_users.nik);
                    $('[name="email"]').val(result.data_users.email);
                    $('[name="names"]').val(result.data_users.name);
                    $('[name="telephone"]').val(result.data_users.telephone);
                    $('[name="address"]').val(result.data_users.address);
                    $('[name="date_birth"]').val(result.data_users.date_birth);

                    var jk =result.data_users.gender;
                    if(jk == 'L'){
                        $('#pilih_gender').find(':radio[name=gender][value="L"]').prop('checked', true);
                    }else{
                        $('#pilih_gender').find(':radio[name=gender][value="P"]').prop('checked', true);
                    }


                    if (result.data_role.role_id == "3") {
                        $("#id_roles").hide();
                        $('[name="id_role"] option[value=1]').prop('selected',false);
                        $('[name="id_role"] option[value=2]').prop('selected',false);
                        $('[name="id_role"] option[value=3]').prop('selected',true);
                    }else{
                        $('[name="id_role"] option[value='+result.data_role.role_id+']').prop('selected',false);
                        $('[name="id_role"] option[value='+result.data_role.role_id+']').prop('selected',true);
                    }

                    $('#modal_form').modal('show');

                    if(result.data_users.image){
                        var url="{{ URL::asset('images/profile') }}";
                        // Get Image Profile
                         $("#targetLayer").html('<img src="'+ url +'/'+ result.data_users.image +'" width="200px" height="200px" class="upload-preview" />');
                         $("#targetLayer").css('opacity','0.7');
                         $(".icon-choose-image").css('opacity','0.5');
                    }else{
                        $("#userImage").val('');
                        $("#targetLayer").html('');                        
                    }

                    $('.modal-title').text('{{ __("main.edit") }} Users');

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function add_data(){
            save_method = 'add';
            $(".check_changes_password").hide();
            $("#id_roles").show();
            $(".option_changes_password").show();
            $("#btnSave").html('<i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Save');
            $('#form')[0].reset(); // reset form on modals
            $('.has-success').removeClass( "has-success");
            $('.has-danger').removeClass( "has-danger");
            $('.form-control-feedback').text("");
            $('.help-block').empty(); // clear error string
            $('#modal_form').modal('show'); // show bootstrap modal
            $("#userImage").val('');
            $("#targetLayer").html('');
            $('.modal-title').text('{{ __("main.add_new") }} {{ __("main.users") }}');
        }

        function save(){
            var url;
            if(save_method == 'add') {
                url ="{{url('admin/save_users')}}";
                $('#btnSave').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Saving ...'); //change button text
            } else {
                url ="{{url('admin/update_users')}}";
                $('#btnSave').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Updated ...'); //change button text
            }
            $('#btnSave').attr('disabled',true); //set button disable
            // ajax adding data to database
            var formData = new FormData($('#form')[0]);

            $.ajax({
                url : url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {
                    if(data.data_post){
                            $('#modal_form').modal('hide');
                            $("#notif_success").animate({
                                    left: "+=50",
                                    height: "toggle"
                                }, 100, function() {
                            });
                            document.getElementById("notif_success").innerHTML ="<div class='alert alert-"+data.data_post['class']+"'>"+data.data_post['message']+"</div>";
                            setTimeout(function() {
                                $('#notif_success').hide();
                            }, 1500);
                            reload_table();
                    }else{
                        for (var i = 0; i < data.inputerror.length; i++){
                            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-danger'); //select parent twice to select div form-group class and add has-danger class
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }
                    if(save_method == 'add') {
                        url ="{{url('admin/save_users')}}";
                        $('#btnSave').html('<i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Save'); //change button text
                    } else {
                        url ="{{url('admin/update_users')}}";
                        $('#btnSave').html('<i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Update'); //change button text
                    }
                    $('#btnSave').attr('disabled',false); //set button enable

                },
                error: function (data)
                {
                    alert('Error adding data');
                    $('#btnSave').attr('disabled',false); //set button enable
                }
            });
        }

        function removed(id){
                swal({
                    title: "{{ __('main.are_you_sure') }}",   
                    text: "{{ __('main.are_you_sure_detail') }}",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#dc3545",   
                    confirmButtonText: "{{ __('main.yes_deleted') }}",   
                    cancelButtonText: "{{ __('main.no_cancel') }}",   
                    closeOnConfirm: false,   
                    closeOnCancel: false,
                    showLoaderOnConfirm: true
                },
                 function(isConfirm){
                   if (isConfirm) {
                    var url ="{{url('admin/deleted_users')}}";
                    $.ajax({
                        url : url,
                        type: "POST",
                        data: {"id":id},
                        dataType: "JSON",
                        headers:
                        {
                            'X-CSRF-Token': $('input[name="_token"]').val()
                        },
                        success: function(result)
                        {
                             if(result.data_post.status) //if success close modal and reload ajax table
                            {   
                                swal("{{ __('main.done') }}","{{ __('main.done_detail') }}","success");
                                $('#modal_form').modal('hide');
                                $("#notif_success").animate({
                                        left: "+=50",
                                        height: "toggle"
                                    }, 100, function() {
                                    });
                                document.getElementById("notif_success").innerHTML ="<div class='alert alert-"+result.data_post['class']+"'>"+result.data_post['message']+"</div>";

                                setTimeout(function() {
                                        $('#notif_success').hide();
                                    }, 1500);
                                reload_table();
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            console.log(url);
                            alert('Error deleting data');
                        }
                    });
                  }else{
                        swal("{{ __('main.cancelled') }}", "{{ __('main.cancelled_detail') }}", "error");
                  } 
               })
        }

        function checkPass(){
            //Store the password field objects into variables ...
            var pass1 = document.getElementById('password1');
            var pass2 = document.getElementById('password2');
            //Store the Confimation Message Object ...
            var message = document.getElementById('confirmMessage');
            //Set the colors we will be using ...
            var goodColor = "#66cc66";
            var badColor = "#ff6666";
            //Compare the values in the password field
            //and the confirmation field
            if(pass1.value =="" && pass2.value ==""){
                pass2.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "Passwords Not empty!";
                document.getElementById("btnSave").disabled = true;
            }
            else if (pass1.value == pass2.value) {
                pass2.style.backgroundColor = goodColor;
                message.style.color = goodColor;
                message.innerHTML = "Passwords Match!";
                document.getElementById("btnSave").disabled = false;
            } else {
                pass2.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "Passwords Do Not Match!";
                document.getElementById("btnSave").disabled = true;
            }
        }

        function checkPass1(){
            //Store the password field objects into variables ...
            var pass1 = document.getElementById('password1');
            var pass2 = document.getElementById('password2');
            //Store the Confimation Message Object ...
            var message = document.getElementById('confirmMessage');
            //Set the colors we will be using ...
            var goodColor = "#66cc66";
            var badColor = "#ff6666";
            //Compare the values in the password field
            //and the confirmation field
            if(pass1.value =="" && pass2.value ==""){
                pass2.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "Passwords Not empty!";
                document.getElementById("btnSave").disabled = true;
            }
            else if (pass1.value == pass2.value) {
                pass2.style.backgroundColor = goodColor;
                message.style.color = goodColor;
                message.innerHTML = "Passwords Match!";
                document.getElementById("btnSave").disabled = false;
            } else {
                pass2.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "Passwords Do Not Match!";
                document.getElementById("btnSave").disabled = true;
            }
        }

        // image profile
        function showPreview(objFileInput) {
            hideUploadOption();
            $("input[name=status_image]").val("1")
            if (objFileInput.files[0]) {
                var fileReader = new FileReader();
                fileReader.onload = function (e) {
                    $("#targetLayer").html('<img src="'+e.target.result+'" width="200px" height="200px" class="upload-preview" />');
                    $("#targetLayer").css('opacity','0.7');
                    $(".icon-choose-image").css('opacity','0.5');
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
            $("input[name=status_image]").val("0")
            $("#userImage").val('');
            $("#targetLayer").html('');
        }
    </script>
@endpush
