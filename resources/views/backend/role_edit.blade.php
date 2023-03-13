@extends('layouts.backend.app')
@section('content')
    @section('css')
        <style type="text/css">
            fieldset.scheduler-border {
            border: 1px groove #ddd !important;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow:  0px 0px 0px 0px #000;
                    box-shadow:  0px 0px 0px 0px #000;
            }

            legend.scheduler-border {
                font-size: 1.2em !important;
                font-weight: bold !important;
                text-align: left !important;
                width:auto;
                padding:0 10px;
                border-bottom:none;
            }
        </style>
    @endsection

    <!-- Bread crumb and right sidebar toggle -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{!! $pages_title !!}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'dashboard' )) }}">{{ __('main.dashboard') }}</a></li>
                <li class="breadcrumb-item active">{!! $pages_title !!}</li>
            </ol>
        </div>
    </div>
    <!-- End Bread crumb and right sidebar toggle -->
        
    <div class="container-fluid">
        <div class="row ">
            <div class="loading" style="display: none;">Loading&#8230;</div>
            <!-- Data -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h4 class="card-title m-b-0 text-white">{{__('main.edit_data')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-horizontal ">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                
                                {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <h4 class="card-title text-info">{{__('main.information_group')}}</h4>
                                            <hr>

                                            <!--Name -->
                                            <div class="form-group">
                                                <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="margin-bottom: 10px;">{{__('main.name_group')}} <span class="required">*</span></label>
                                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" >
                                                    {!! Form::text('name', null, array('placeholder' => "Name Group",'class' => 'form-control')) !!}
                                                </div>
                                            </div>

                                            <!--Display Name -->
                                            <div class="form-group">
                                                <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="margin-bottom: 10px;">{{__('main.display_name')}} </label>
                                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" >
                                                    {!! Form::text('display_name', null, array('placeholder' => "Display Name",'class' => 'form-control')) !!}
                                                </div>
                                            </div>

                                            <!-- Description -->
                                            <div class="form-group">
                                                <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="margin-bottom: 10px;">{{__('main.description')}} </label>
                                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" >
                                                    {!! Form::textarea('description', null, array('placeholder' => "Description",'class' => 'form-control', 'data-autosize')) !!}
                                                </div>
                                            </div>


                                            <!-- status -->
                                            <div class="form-group">
                                                <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="margin-bottom: 10px;">{{__('main.status')}} <span class="required">*</span></label>
                                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                    <label class="custom-control custom-radio">
                                                        <input id="radio1" name="status" type="radio" class="custom-control-input" value="Y" checked="">
                                                        <span class="custom-control-label">{{__('main.active')}}</span>
                                                    </label>
                                                    <label class="custom-control custom-radio">
                                                        <input id="radio2" name="status" type="radio" class="custom-control-input" value="N">
                                                        <span class="custom-control-label">{{__('main.non-active')}}</span>
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <p style="margin-bottom: 50px"></p>
                                        <div class="form-group">
                                            <h4 class="card-title text-info">{{__('main.permissions_menu')}}</h4>
                                            <h6 class="card-subtitle">{{__('main.permissions_detail')}}</h6>
                                            <hr>                                         
                                        </div>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="parent-checkbox-hapus" onClick="toggle(this)">
                                            <span class="custom-control-label"></span>
                                            {{__('main.check_all')}}
                                        </label>
                                        <p style="margin-bottom: 20px"></p>
                                        <div class="form-group">
                                            <div class="row show-grid">
                                                <!-- LIST MENU -->
                                                @foreach ($arrGroup as $groupName => $data)
                                                <div class="col-sm-3" style="min-height: 175px;">
                                                    <fieldset class="scheduler-border">
                                                        <legend class="scheduler-border">{{ strtoupper($groupName) }}</legend>
                                                        @foreach($data as $value)
                                                            <div>
                                                                <label class="custom-control custom-checkbox">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name custom-control-input')) }}
                                                                {{ $value->display_name }}
                                                                    <span class="custom-control-label"></span>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </fieldset>
                                                </div>
                                                @endforeach
                                            </div>
                                            <p style="margin-bottom: 50px"></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <button class="btn btn-sm btn-info btn-submit" type="submit">
                                                <i class="fa fa-paper-plane"></i>&nbsp;&nbsp;{{__('main.edit')}}
                                            </button>
                                            <a href="{{ route('roles.index') }}" class="btn-sm btn waves-effect waves-light btn-secondary">
                                                <i class="fa fa-reply"></i>&nbsp;&nbsp;{{__('main.cancel')}}
                                            </a>
                                        </div>
                                    </div>
                                 {!! Form::close() !!}    


                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(".btn-submit").on("click", function () {
            $(".loading").show("fast");
        });    

        // ceklis_data
        function toggle(source) {
          checkboxes = document.getElementsByName('permission[]');
          for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
          }
        }   
    </script>
@endpush
