@extends('layouts.userlayout')
@section('content')
<nav class="navbar navbar-light navbar-expand-md sticky-top navigation-clean-button" style="height: 80px;background-color: #0d7994;color: #fffff0;">
    <div class="container-fluid"><a class="navbar-brand" href="/"><img src="https://img.icons8.com/plasticine/32/ffffff/bus--v2.png"/></i>&nbsp;Om Sai Travels</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav ml-auto" style="background-color: #0d7994;">
                <li class="nav-item"><a class="nav-link" style="color:#fffff0;" href="{{route('gettrip')}}">Trip</a></li>
                <li class="nav-item"><a class="nav-link" style="color:#18e0e0;" href="#">Tour</a></li>
                <li class="nav-item"><a class="nav-link" style="color:#fffff0;" href="{{route('getbushire')}}">Bus HIre</a></li>
            </ul>
        </div>
    </div>
  </nav>
<div style="padding-top: 100px" class="container justify-content-center text-center">
    <div class="container justify-content-center">
        <div class="row text-center">
                <div class="col text-center"><h5>Tour Booking Detail</h5></div>
        </div>
        <form action="{{route('printtourticket')}}" method="POST" target="_blank">
            @csrf
       @for ($i = 0; $i < count($data->name); $i++)
       <div class="row text-center">
        <div class="col col-3 text-center">Seat No : <input type="text" name="seatno[]" class="form-control" value="{{$data->seatno[$i]}}" readonly> <input type="text" name="tid" class="form-control" value="{{$data->tid}}" hidden></div>
        <div class="col col-3 text-center">Name : <input type="text" name="name[]" class="form-control"  value="{{$data->name[$i]}}" readonly></div>
        <div class="col col-3 text-center">Age : <input type="text" name="age[]" class="form-control"  value="{{$data->age[$i]}}" readonly></div>
        <div class="col-3">Gender :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender[{{$i}}]" id="inlineRadio1" value="male" @if($data->gender[$i]=="male") checked @endif>
            <label class="form-check-label" for="inlineRadio1">Male</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender[{{$i}}]" id="inlineRadio2" value="female" @if($data->gender[$i]=="female") checked @endif>
            <label class="form-check-label" for="inlineRadio2">Female</label>
          </div>
        </div>
    </div>
       <br>
       @endfor
   
       <div class="row text-center">
            <div class="col col-4 "> Mobile no <input type="text" name="phone" class="form-control" value="{{$data->phone}}" id="" readonly></div>
            <div class="col col-6 "> Email Id <input type="text" name="email" class="form-control"value="{{$data->email}}" id="" readonly></div>
       </div>
       <br>
       <div class="row text-center">
        <div class="col  "><form action="{{route('printtourticket')}}"><button class="btn btn-info" type="submit">Print Out</button></form></div></form>
        <div class="col  "><form action="{{route('tour')}}"> <button class="btn btn-primary" type="submit">Go Home</button></form></div>
  
    </div>

   <br>
</div> 
    </div>
 </div>


@stop
  @section('script')

  @endsection