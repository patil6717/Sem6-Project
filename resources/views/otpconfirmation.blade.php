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
<div style="padding-top: 100px" >
    <form action="{{route('confirmtrip')}}" method="post">
        @csrf
        <table class="table">
            @if(Session::has('err'))
            <div class="alert alert-danger">
            {{Session::get('err')}}
                </div>
                @endif
            <tr class="row justify-content-center">
                <td class="column"><h2> Enter Otp : </h2></td>
            </tr>
            <tr class="row justify-content-center">
                <td class="column justify-content-center">Otp:</td>
                <td class="column justify-content-center">
                    <input type="text" name="otp" class="form-control">
                </td>
            </tr>
            <tr class="row justify-content-center">
            <td class="column justify-content-center"><button type="submit" class="btn btn-primary form-control">Submit</button></td>
            <td class="column justify-content-center"><a href="{{route('reotp')}}">Resend Otp</a></td>
            </tr>
        </table>
    </form>
</div>
@endsection