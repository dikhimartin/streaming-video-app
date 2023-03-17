<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('admin_assets/assets/images/favicon.png') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{URL::asset("admin_assets/assets/plugins/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{URL::asset("admin_assets/css/style.css")}}" rel="stylesheet">
    <link href="{{URL::asset("admin_assets/css/colors/blue-dark.css")}}" id="theme" rel="stylesheet">
</head>

<body class="fix-header card-no-border">
    <!-- Main wrapper - style you can find in pages.scss -->
    @yield("content")
    <script src="{{URL::asset("admin_assets/assets/plugins/jquery/jquery.min.js")}}"></script>
    <script src="{{URL::asset("admin_assets/assets/plugins/bootstrap/js/popper.min.js")}}"></script>
    <script src="{{URL::asset("admin_assets/assets/plugins/bootstrap/js/bootstrap.min.js")}}"></script>
    <script src="{{URL::asset("admin_assets/js/waves.js")}}"></script>
</body>

</html>
