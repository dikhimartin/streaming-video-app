<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('admin_assets/assets/images/favicon.png') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{URL::asset("admin_assets/assets/plugins/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{URL::asset("admin_assets/css/style.css")}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{URL::asset("admin_assets/css/colors/blue-dark.css")}}" id="theme" rel="stylesheet">
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    @yield("content")
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{URL::asset("admin_assets/assets/plugins/jquery/jquery.min.js")}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{URL::asset("admin_assets/assets/plugins/bootstrap/js/popper.min.js")}}"></script>
    <script src="{{URL::asset("admin_assets/assets/plugins/bootstrap/js/bootstrap.min.js")}}"></script>
    <!--Wave Effects -->
    <script src="{{URL::asset("admin_assets/js/waves.js")}}"></script>
</body>

</html>
