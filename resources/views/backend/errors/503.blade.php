@extends('layouts.backend.errors')
@section('content')
    <section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body text-center">
                <h1>503</h1>
                <h3 class="text-uppercase">Oops!</h3>
                <p class="text-muted m-t-30 m-b-30">Be Right Back</p>
                <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'admin/dashboard' ))}}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">{{__('main.back_to_home')}}</a> </div>
                <footer class="footer text-center" id="copyright_footer"></footer>
        </div>
    </section>
<script type="text/javascript">
    var dt   = new Date();
    var data = ''+dt.getFullYear()+' &copy; PHP | Laravel Framework 5.6 | '+
                '<a href="http://dikhimartin.com/" class="m-link">'+
                    'Dikhi Martin'+
                '</a>';
    document.getElementById("copyright_footer").innerHTML = data;
</script>
@endsection