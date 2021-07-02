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
<div style="padding-top: 100px">
    <form action="{{route('printticket')}}" method="post" class="input_fields_wrap contact-clean d-flex justify-content-center " target="_blank" >
        @csrf
    <div class="d-flex justify-content-center" >
    <table class="table justify-content-center">
        <tr class="row">
            <td class="column"></td>
        </tr>
        <tr class="row justify-content-center">
            <td class="column text-center"><label for="busnumber">Bus Number :</label><p class="text-center form-control">{{ session()->get('number')}} </p></td>    
            <td class="column text-center"><label for="busnumber">From :</label><p class="text-center form-control">{{ session()->get('starting')}} </p></td>    
            <td class="column text-center"><label for="busnumber">To :</label><p class="text-center form-control">{{ session()->get('ending')}} </p></td>    

        </tr>
        <tr class="row justify-content-center">
            <td class="column text-center"><label for="price">Starting Date :</label><p class="text-center form-control" >{{ session()->get('date')}} </p></td>
                        <td class="column text-center"><label for="price">Starting Time :</label><p class="text-center form-control" >{{ session()->get('starttime')}} </p></td>
                        <td class="column text-center"><label for="price">Ending Date :</label><p class="text-center form-control" >{{ session()->get('enddate')}} </p></td>
                        <td class="column text-center"><label for="price">End Time :</label><p class="text-center form-control" >{{ session()->get('endtime')}} </p></td>
                              </tr>
        @foreach ($data as $item)
        <tr class="row justify-content-center">
            <td class="column"><label for="price">Seatno :</label> <input type="text" name="seatno[]" class="form-control" value="{{$item->seatno}}" readonly> </td>
            <td class="column"><label for="price">Name :</label> <input type="text" name="name[]" class="form-control" value="{{$item->name}}" readonly></td>
            <td class="column"> <label for="price">Age :</label><input type="text" name="age[]" class="form-control" value="{{$item->age}}" readonly></td>
            <td class="column"><label for="price">Gender :</label><input type="text" name="gender[]" class="form-control" value="{{$item->gender}}"  readonly></td>
        </tr>
        @endforeach
        <tr class="row justify-content-center">
            <td class="column"><label for="price">Phone :</label><input type="text" name="phone" class="form-control" value="{{session()->get('phone')}}" readonly></td>
            <td class="column"><label for="price">Email :</label><input type="text" name="email" class="form-control" value="{{session()->get('email')}}"  readonly></td>
            <td class="column"><label for="price">Total :</label><input type="text" name="price" class="form-control" value="{{session()->get('totalprice')}}"  readonly></td>
       </tr>    
       <tr class="row justify-content-center">
           <td class="column">
           <button class="btn btn-info" type="submit">Print Out</button>
        </td>
        <td class="column">
           <button class="btn btn-info" ><a href="/" > Home </a></button>
        </td>
       </tr>
    </table>
</div>
    </form>
</div>

@stop
