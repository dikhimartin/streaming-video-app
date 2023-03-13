@extends('layouts.app')

@section('content')
<div class="col-xs-12">
  <div class="clearfix">
    <div class="pull-right tableTools-container"></div>
  </div>
  <div class="page-header">
    <h2>{{$pages_title}}</h2>
  </div>
  <div>
    <div class="clearfix">
      <div class="pull-left tableTools-container">
        @permission('doc-upload')
        <button class="btn btn-success btn-xs" onclick="add()"><span class="fa fa-plus"></span> Upload Data</button>
        @endpermission
        {{-- <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button> --}}
      </div>
    </div>
    <div id="notif_success"></div><br>
    <table class="table table-hover table-bordered table-striped" id="dataTable">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Description</th>
          <th>Upload</th>
          <th>Size</th>
          <th>#</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($doc_list as $key => $value)
          <tr>
            <th style="text-align: center; vertical-align: middle;">{{ $key+1 }}</th>
            <th style="vertical-align: middle;">{{ $value->nama }}</th>
            <th style="vertical-align: middle;">{{ $value->description }}</th>
            <th style="vertical-align: middle;">{{ $value->created_at }}</th>
            <th style="vertical-align: middle;">{{ number_format($value->size/1000, 2, ',', '.') }} Kb</th>
            <th style="text-align: center; vertical-align: middle;">
              <form class="" action="{{ route('document.delete') }}" method="post">
                <a href="{{ asset('assets/docs/'.$value->data) }}" target="_blank" class="btn btn-primary btn-xs">
                  <span class="fa fa-download"></span> Download
                </a>
                @permission('doc-delete')
                    {{ csrf_field() }}
                    <button type="submit" name="id" value="{{ $value->id }}" class="btn btn-danger btn-xs" onclick="return check()">
                      <span class="fa fa-trash"></span> Delete
                    </button>
                @endpermission
              </form>
            </th>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="hr hr32 hr-dotted"></div>
  </div>
</div>

<!-- ModalViewAlamat -->
<div class="modal fade" id="dialogUpload" role="dialog">
  <div class="modal-dialog modal-lg">
    <form class="form-horizontal" method="post" id="" action="{{ route('document.upload') }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header center">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <div class="form-group" id="">
            <div class="col-xs-12">
              <input type="text" placeholder="Nama" class="form-control full" name="nama" id="" oninput="">
            </div>
            <div id="" class="help-block none col-xs-12"></div>
          </div>
          <div class="form-group" id="">
            <div class="col-xs-12">
              <input type="text" placeholder="Description" class="form-control full" name="desc" id="" oninput="">
            </div>
            <div id="" class="help-block none col-xs-12"></div>
          </div>
          <div class="form-group" id="">
            <div class="col-xs-12">
              <input type="file" placeholder="Description" class="form-control full" name="docs" id="" oninput="">
            </div>
            <div id="" class="help-block none col-xs-12"></div>
          </div>
        {{-- </div> --}}
        <div class="modal-footer center">
          <button type="submit" class="btn btn-primary btn-white btn-sm" onclick="" id="">
            <span class="fa fa-location-arrow"></span> Upload
          </button>
        </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
@push('js')
<script type="text/javascript">
  $("#dataTable").DataTable();

  var modalAdd = $('#dialogUpload');

  function add(){
    $(".modal-title").html("Upload {{ $pages_title }}");
    $('.form-control').val('');
    $('input').removeClass("has-error");
    $('#btnUpdate').addClass('none');
    $('#btnSave').removeClass('none');
    $('#id').val('');
    modalAdd.modal();
  }

  function check(){
    var r = confirm("Are you sure to delete this item ?");
    if (r == true) {
        return true;
    } else {
        return false;
    }
  }

</script>
@endpush
