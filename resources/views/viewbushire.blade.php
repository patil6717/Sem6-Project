@extends('layouts.userlayout')
@section('content')
<nav class="navbar navbar-light navbar-expand-md sticky-top navigation-clean-button" style="height: 80px;background-color: #0d7994;color: #fffff0;">
    <div class="container-fluid"><a class="navbar-brand" href="/"><i class="fa fa-globe"></i>&nbsp;Om Sai Travels</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav ml-auto" style="background-color: #0d7994;">
                <li class="nav-item"><a class="nav-link" style="color:#fffff0;" href="{{route('gettrip')}}">Trip</a></li>
                <li class="nav-item"><a class="nav-link" style="color:#fffff0;" href="{{route('tour')}}">Tour</a></li>
                <li class="nav-item"><a class="nav-link" style="color:#18e0e0;" href="{{route('getbushire')}}">Bus HIre</a></li>
    </ul>
        </div>
    </div>
  </nav>
<div style="padding-top:90px;  padding-left:40px; padding-right:40px;">
    @if ($adata->isEmpty() && $rdata->isEmpty())
    <div class="row justify-content-center text-center">
        <div class="alert alert-danger">
           You Havent Made Any Request Till Now
        </div>
    </div> 
    @else
    <div class="row justify-content-center text-center">
       <h5> Accepted Requests.</h5>
    </div>
    @if ($adata->isEmpty())
        <div class="row justify-content-center text-center">
            <div class="alert alert-danger">
                YOur Booking Is OVer Or Your Request Are Not Accepted 
            </div>
        </div>
    @else
        
        @if ($rdata->isEmpty())
        <div class="row justify-content-center text-center">
            <div class="alert alert-danger">
               You Havent Made Any Request Or Your Request Are Accepted
            </div>
        </div>
        @else          

        @foreach ($adata as $item)
            <table class="table  text-center" style="border: 2px solid black;">
                <div class="row justify-content-center">
                    <tr>
                        <div class="column">
                            <th colspan="3">Sr no : {{($loop->index+1)}}</th>
                        </div>
                    </tr>    
                </div>
                <div class="row justify-content-center text-center">
                    <tr>
                        <div class="column">
                            <td>From : {{$item->from }}</td>
                        </div>
                        <div class="column">
                            <td>To : {{$item->to}}  </td>
                        </div>
                        <div class="column">
                            <td>Bus Count : {{$item->buscount}}  </td>
                        </div>  
                    </tr>
                </div>
                <div class="row justify-content-center text-center">
                    <tr>
                        <div class="column">
                            <td>
                                Start Date : {{$item->startdate}} 
                            </td>
                        </div>
                        <div class="column">
                            <td>
                                End Date : {{$item->enddate}} 
                            </td>
                        </div>
                        <div class="column">
                            <td>
                                Size : {{$item->size}} 
                            </td>
                        </div>
                    </tr>
                </div>
                <div class="row justify-content-center text-center">
                    <tr>
                        <div class="column">
                            <td>
                                Phone :  {{$item->phone}}
                            </td>
                        </div>
                        <div class="column">
                            <td>
                                Email : {{$item->email}}
                            </td>
                        </div>
                        <div class="column">
                            <td>
                                Return : @if ($item->return == 1)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                        </div>
                    </tr>
                </div>
                <div class="row text-center">
                    <tr>
                        <div class="column">
                            <td>
                                <form action="{{route('deleterequestbushire')}}">
                                    @method('delete')
                                    @csrf
                                    <input type="text" name="id" value="{{$item->bhrid}}" hidden>
                                    <input type="text" name="email" value="{{$item->email}}" hidden>
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </div>
                        <div class="column">
                            <td><p><div></div></p></td>
                        </div>
                        <div class="column">
                            <td>
                                <form action="{{route('printacceptedbushire')}}" method="post" target="_blank">
                                    @csrf
                                    <input type="text" name="id" value="{{$item->bhrid}}" hidden>
                                    <input type="text" name="email" value="{{$item->email}}" hidden>
                                    <button class="btn btn-info">Print Ticket   </button>
                                </form> 
                            </td>
                        </div>
                    </tr>
                </div>
            </table>
        @endforeach 
        @endif       
    @endif
    <div class="row justify-content-center text-center">
        <h5>Pending Requests.</h5>
     </div>
    @if ($rdata->isEmpty())
        <div class="row justify-content-center text-center">
            <div class="alert alert-danger">
                 No Request Are Pending
            </div>
        </div>
    @else
        @foreach ($rdata as $item)
            <table class="table  text-center" style="border: 2px solid black;">
                <div class="row justify-content-center">
                    <tr>
                        <div class="column">
                            <th colspan="3">Sr no : {{($loop->index+1)}}</th>
                        </div>
                    </tr>    
                </div>
                <div class="row justify-content-center text-center">
                    <tr>
                        <div class="column">
                            <td>From : {{$item->from }}</td>
                        </div>
                        <div class="column">
                            <td>To : {{$item->to}}  </td>
                        </div>
                        <div class="column">
                            <td>Bus Count : {{$item->buscount}}  </td>
                        </div>  
                    </tr>
                </div>
                <div class="row justify-content-center text-center">
                    <tr>
                        <div class="column">
                            <td>
                                Start Date : {{$item->startdate}} 
                            </td>
                        </div>
                        <div class="column">
                            <td>
                                End Date : {{$item->enddate}} 
                            </td>
                        </div>
                        <div class="column">
                            <td>
                                Size : {{$item->size}} 
                            </td>
                        </div>
                    </tr>
                </div>
                <div class="row justify-content-center text-center">
                    <tr>
                        <div class="column">
                            <td>
                                Phone :  {{$item->phone}}
                            </td>
                        </div>
                        <div class="column">
                            <td>
                                Email : {{$item->email}}
                            </td>
                        </div>
                        <div class="column">
                            <td>
                                Return : @if ($item->return == 1)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                        </div>
                    </tr>
                </div>
                <div class="row justify-content-center text-center">
                    <tr>
                        <div class="column">
                            <td colspan="3">
                                <form action="{{route('deleterequestbushire')}}">
                                    @method('delete')
                                    @csrf
                                    <input type="text" name="id" value="{{$item->bhrid}}" hidden>
                                    <input type="text" name="email" value="{{$item->email}}" hidden>
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </div>
                    </tr>
                </div>
            </table>
        @endforeach        
    @endif
    @endif
    <div class="row justify-content-center text-center">
        <div class="column">
            <form action="/bushire" method="get">
                <button class="btn btn-primary"> Go Home</button>
                
            </form>
        </div>
    </div>
    <br>
</div>
    
@endsection