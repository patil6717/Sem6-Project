@extends('layouts.userlayout')
@section('content')
<nav class="navbar navbar-light navbar-expand-md sticky-top navigation-clean-button" style="height: 80px;background-color: #0d7994;color: #fffff0;">
    <div class="container-fluid"><a class="navbar-brand" href="/"><i class="fa fa-globe"></i>&nbsp;Om Sai Travels</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav ml-auto" style="background-color: #0d7994;">
                <li class="nav-item"><a class="nav-link active" style="color:#fffff0;" href="#">Trip</a></li>
                <li class="nav-item"><a class="nav-link" style="color:#fffff0;" href="{{route('tour')}}">Tour</a></li>
                <li class="nav-item"><a class="nav-link" style="color:#fffff0;" href="{{route('getbushire')}}">Bus HIre</a></li>
                <li class="nav-item"><a class="nav-link" style="color:#fffff0;" href="{{route('tour')}}">Shedules</a></li>
            </ul>
        </div>
    </div>
  </nav>
<div style="padding-top:80px;">
    
        <div class="row justify-content-center text-center"><h4>Required Authentication</h4></div>
        @if ($errors->any())
        <div class="alert alert-danger row justify-content-center">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form action="{{route('otpviewbooking')}}" method="post">
             @csrf
        <div class="row justify-content-center text-center">
            <div class="column col-md-4 px-md-1 "><label for="">Email Id: </label><input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="email"></div>
        </div>
        <br>
        <div class="row justify-content-center text-center">
            <div class="column col-md-2 px-md-1"><button class="btn btn-success" type="submit">Send Otp</button></div>
        </div>
        <br>
        </form>
        <form action="{{route('viewtrip')}}" method="post">
       @csrf
        <div class="row justify-content-center text-center">
            <div class="column col-md-2 px-md-1 "><label for="">OTP : </label><input type="text" class="form-control" name="otp" placeholder="xxxxxx"></div>     
        </div>
        <br>
        <div class="row justify-content-center text-center">
            <div class="column col-md-2 px-md-1"><button class="btn btn-info" type="submit">Submit</button></div>
        </div>
       <br>
        </form>
</div>    
@endsection