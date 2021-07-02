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
    <body id="page-top" style="padding-top: 100px;">      
           <div class="container-fluid">
               
                
            <form action="{{route('bookticket')}}" method="post" class="input_fields_wrap contact-clean d-flex justify-content-center " >
              @csrf
             
              
                <table class="table ">
                    <tr class="row justify-content-center"><td class="column"><h2>Registration Form</h2></td></tr>
                    <tr class="row justify-content-center"><td class="column"><h5>Enter User Detail</h5></td></tr>
                    <tr class="row justify-content-center">
                        <td class="column text-center"><label for="price">Price :</label><p class="text-center form-control">{{ session()->get('price')}} </p></td>
                        <td class="column text-center"><p class="text-center form-control" hidden>{{ session()->get('baid')}} </p></td>
                        <td class="column text-center"><label for="busnumber">Bus Number :</label><p class="text-center form-control">{{ session()->get('number')}} </p></td>    
                        <td class="column text-center"><label for="price">  Total Price :</label><p class="text-center form-control">{{(session()->get('total')*session()->get('price'))}} </p>  </td>
                    </tr>
                    <tr class="row justify-content-center">
                        <td class="column text-center"><label for="price">Starting Date :</label><p class="text-center form-control" >{{ session()->get('date')}} </p></td>
                        <td class="column text-center"><label for="price">Starting Time :</label><p class="text-center form-control" >{{ session()->get('starttime')}} </p></td>
                        <td class="column text-center"><label for="price">Ending Date :</label><p class="text-center form-control" >{{ session()->get('enddate')}} </p></td>
                        <td class="column text-center"><label for="price">End Time :</label><p class="text-center form-control" >{{ session()->get('endtime')}} </p></td>
                       

                    </tr>
                    @foreach($data as $item)               
                <tr class="row justify-content-center">
                    <td class="column text-center"><label for="index">  Sr No :</label><p class="text-center form-control" >{{($loop->index+1)}} </p>  </td>
                    <td class="column text-center"><label for="Seat"> Seat No :</label><input type="text" class="form-control" name="seat[]" value="{{$item->scalar}}" readonly></td>
                    <td class="column text-center"><label for="Seat">Name :</label> <input type="text" class="form-control " name="name[]" required> </td>
                    <td class="column text-center"><label for="Seat">Age :</label> <input type="text" class="form-control" name="age[]" required> </td>
                    <td class="column text-center"><label for="Seat">Gender :</label> 
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender[{{$loop->index}}]"  value="male" checked>
                        <label class="form-check-label" for="exampleRadios1">
                          Male
                        </label>
                        </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender[{{$loop->index}}]"  value="female">
                        <label class="form-check-label" for="exampleRadios2">
                            Female
                        </label>
                      </div>
                    </td>
                </tr>
               
                @endforeach
                <tr class="row justify-content-center">
                    <td class="column text-center"><label for="phone">Phone No :</label> <input type="text" class="form-control" name="phone" required> </td>
                  
                    <td class="column text-center"><label for="email">Email Id:</label> <input type="text" class="form-control" name="email" required> </td>    
                
                
                  
                </tr>
                <tr class="row justify-content-center">
                    <td class="columen text-center">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </td>
                </tr>
            </table>
        
    </form>
    
</div>
    </body>
@endsection