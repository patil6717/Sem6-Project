<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Om Sai Tour</title>
    <link rel="apple-touch-icon" sizes="76x76" href="https://img.icons8.com/fluent/48/000000/bus.png">
    <link rel="icon" type="image/png" href="https://img.icons8.com/fluent/48/000000/bus.png">
    <!-- <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css?h=553e1c2a2573c524c40439f9d0b80bb8')}}"> -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link href="{{asset('css/nucleo-icons.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('css/Contact-Form-Clean-1.css')}}">
    <link rel="stylesheet" href="{{asset('css/Contact-Form-Clean-2.css')}}">
    <link rel="stylesheet" href="{{asset('css/Contact-Form-Clean.css')}}">
    <link rel="stylesheet" href="{{asset('css/design.css')}}">
    <link rel="stylesheet" href="{{asset('css/Footer-Clean.css')}}">
    <link rel="stylesheet" href="{{asset('css/Footer-Dark.css')}}">
    <link rel="stylesheet" href="{{asset('css/Header-Dark.css')}}">
    <link rel="stylesheet" href="{{asset('css/Navigation-with-Button.css')}}">
    <link rel="stylesheet" href="{{asset('css/seat.css')}}">
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.seat-charts.css')}}">
@yield('header')
</head>

@yield('content')
<footer class="footer-dark" style="background-image:url('{{asset('/img/map-image.png')}}'); ">
    <div class="container" style="color:#ADD8E6">
        <div class="row justify-content-center">
            <div class="col-md-6 item text-center" style="opacity:100%">
                <h3>Om Sai Tours &amp; Travels Pvt. Ltd.</h3>
                <p>67,Swagat Complex, Kadodara-394327, Tal:Palsana, Dist:Surat</p>
                <p>Contact No:9727707949</p>
                <p></p>
            </div>
        </div>
        <div class="row">
            <div class="col item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a></div>
        </div>
        <p class="copyright" style="color: #F08080; opacity:100%">Om Sai Travel © 2021 <br>Made with Love By Yogesh patil</p>
    </div>
</footer>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    {{-- <script src="{{asset('js/agency.js?h=55603d8db4181fc7bc80e0433e95435c')}}"></script> --}}

    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 
<script src="{{asset('js/jquery.seat-charts.js')}}"></script> 
@yield('script')
</body>

</html>
