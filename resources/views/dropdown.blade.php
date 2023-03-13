<!DOCTYPE html>
<html>
<head>
    <title>Laravel Dependent Dropdown</title>
    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
</head>
<body>
<h1>Laravel Dependent Dropdownn</h1>

<div class="col-lg-12">

  <div class="form-group">
          <label for="title">Select Propinsi:</label>
          <select name="propinsi" class="form-control" style="width:350px">
              <option value="">--- Select State ---</option>
              @foreach ($propinsi as $key => $value)
                  <option value="{{ $key }}">{{ $value }}</option>
              @endforeach
          </select>
      </div>
      <div class="form-group">
          <label for="title">Select Kabupaten:</label>
          <select name="city" class="form-control" style="width:350px">
              <option value="">--- Select State ---</option>
          </select>
      </div>
      <div class="form-group">
          <label for="title">Select Kecamatan:</label>
          <select name="kecamatan" class="form-control" style="width:350px">
              <option value="">--- Select State ---</option>
          </select>
      </div>
      <div class="form-group">
          <label for="title">Select Kelurahan:</label>
          <select name="kelurahan" class="form-control" style="width:350px">
          </select>
      </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function()
    {
        $('select[name="propinsi"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID)
            {
                $.ajax({
                    url: '/home/kabupaten/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data)
                    {
                        console.log(data);
                        $('select[name="city"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="city"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else
            {

                $('select[name="city"]').empty();
            }
        });
    });

    $(document).ready(function()
    {
        $('select[name="city"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID)
            {
                $.ajax({
                    url: '/home/kecamatan/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data)
                    {
                        console.log(data);
                        $('select[name="kecamatan"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="kecamatan"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else
            {
                $('select[name="kecamatan"]').empty();
            }
        });
    });

    $(document).ready(function()
    {
        $('select[name="city"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID)
            {
                $.ajax({
                    url: '/home/kecamatan/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data)
                    {
                        console.log(data);
                        $('select[name="kecamatan"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="kecamatan"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else
            {
                $('select[name="kecamatan"]').empty();
            }
        });
    });

    $(document).ready(function()
    {
        $('select[name="kecamatan"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID)
            {
                $.ajax({
                    url: '/home/kelurahan/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data)
                    {
                        console.log(data);
                        $('select[name="kelurahan"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="kelurahan"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else
            {
                $('select[name="kelurahan"]').empty();
            }
        });
    });

</script>

</body>
</html>