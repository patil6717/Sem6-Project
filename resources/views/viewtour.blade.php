@extends('layouts.userlayout')
@section('content')
<nav class="navbar navbar-light navbar-expand-md sticky-top navigation-clean-button" style="height: 80px;background-color: #0d7994;color: #fffff0;">
    <div class="container-fluid"><a class="navbar-brand" href="/"><i class="fa fa-globe"></i>&nbsp;Om Sai Travels</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav ml-auto" style="background-color: #0d7994;">
                <li class="nav-item"><a class="nav-link" style="color:#fffff0;" href="{{route('gettrip')}}">Trip</a></li>
                <li class="nav-item"><a class="nav-link" style="color:#18e0e0;" href="{{route('tour')}}">Tour</a></li>
                <li class="nav-item"><a class="nav-link" style="color:#fffff0;" href="{{route('getbushire')}}">Bus HIre</a></li>
   </ul>
        </div>
    </div>
  </nav>
<div style="padding-top: 100px; padding-left:40px; padding-right:40px;" class=" justify-content-center">
        <div class="row justify-content-center">
            <p>
                <h5>Your Bookings</h5>
            </p>

        </div>
        @foreach ($data as $value)
        <table  class="table text-center" style="border: 2px solid black;">
            <div class="row justify-content-center">
                <tr>
                    <div class="column">
                        <th colspan="7">Sr no : {{($loop->index+1)}}</th>
                    </div>
                </tr>    
            </div>   
            <div class="row">
                <tr>
                    <div class="column">
                        <th>Seat No </th>
                    </div>
                    
                    <div class="column">
                        <th>Name </th>
                    </div>
                    <div class="column">
                        <th>Age </th>
                    </div>
                    <div class="column">
                        <th>Gender </th>
                    </div>
                    <div class="column">
                        <th>Phone </th>
                    </div>
                    <div class="column">
                        <th>EmailId </th>
                    </div>
                    <div class="column">
                        <th>Price </th>
                    </div>
                </tr>
            </div>
                <div class="row">
                    <tr>
                    <div class="column">
                        <td>{{$value->seatno}}</td>
                    </div>
                    <div class="column">
                        <td>{{$value->name}}</td>
                    </div>
                    <div class="column">
                        <td>{{$value->age}}</td>
                    </div>
                    <div class="column">
                        <td>{{$value->gender}}</td>
                    </div>
                    <div class="column">
                        <td>{{$value->phone}}</td>
                    </div>
                    <div class="column">
                        <td>{{$value->email}}</td>
                    </div>
                    <div class="column">
                        <td>{{$value->price}}</td>
                    </div>
                    </tr>
                </div>

            <div class="row">
                <tr>
                    <div class="column">
                        <th > Date </th>
                    </div>
                    <div>
                        <td> <p></p></td>
                     </div>
                     <div>
                        <td> <p></p></td>
                    </div>
                     <div class="column">
                        <th > Place </th>
                    </div>
                    <div>
                        <td> <p></p></td>
                    </div>
                    <div class="column">
                        <th >Starttime </th>
                    </div>
                   
                    
                    <div class="column">
                        <th >Bus Number</th>
                    </div>
                </tr>
            </div>
           
            <div class="row">
                <tr>
                    <div class="column">
                        <td> {{$value->startdate}}</td>
                    </div>
                    <div>
                        <td> <p></p></td>
                    </div>
                    <div>
                        <td> <p></p></td>
                    </div>
                    <div class="column">
                        <td > {{$value->main}}</td>
                    </div>
                    <div>
                        <td> <p></p></td>
                    </div>
                    <div class="column">
                        <td>{{$value->starttime}} </td>
                    </div>
                   
                   
                    <div>
                        <td>{{$value->number}} </td>
                    </div>
                  </tr>
            </div>
            <div class="row">
                <tr>
                   
                    <div class="column text-center">
                        <td>
                            <form action="{{route('deletetourview')}}" method="post">
                                @method('delete')
                                @csrf
                                <input type="text" name="name" id="" value="{{$value->name}}" hidden>
                                <input type="text" name="taid" id="" value="{{$value->taid}}" hidden>
                           
                                <input type="text" name="email" value="{{$value->email}}" hidden>
                       <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            
                        </td>
                    </div>
                   
                    <div class="column">
                        <td colspan="1">
                            <p></p>
                        </td>
                    </div>
                    <div class="column">
                        <td colspan="1">
                            <p></p>
                        </td>
                    </div>
                    <div class="column">
                        <td colspan="1">
                            <p></p>
                        </td>
                    </div>
                    <div class="column">
                        <td colspan="1">
                            <p></p>
                        </td>
                    </div>
                    <div class="column">
                        <td colspan="1">
                            <p></p>
                        </td>
                    </div>
                    <div class="column text-center">
                        <td>
                            <form action="{{route('printtourview')}}" method="post" target="_blank">
                                @csrf
                                <input type="text" name="taid" id="" value="{{$value->taid}}" hidden>
                                <input type="text" name="email" value="{{$value->email}}" hidden>
                                <input type="text" name="name" id="" value="{{$value->name}}" hidden>
                                <button class="btn btn-info" type="submit">Print Ticket</button>
                            </form>
                       
                        </td>
                    </div>
                    
                </tr>
            </div>
        </table>
           
        @endforeach
        <div class="row justify-content-center">
            <div class="column">
                <form action="/" method="get">
                <button class="btn btn-primary"> Go home</button>
            </form>
            </div>
        </div>
        <br>
</div>
@endsection