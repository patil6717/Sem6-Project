@extends('layouts.userlayout')

@section('content')
<nav class="navbar navbar-light navbar-expand-md sticky-top navigation-clean-button" style="height: 80px;background-color: #0d7994;color: #fffff0;">
    <div class="container-fluid"><a class="navbar-brand" href="/"><i class="fa fa-globe"></i>&nbsp;Om Sai Travels</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav ml-auto" style="background-color: #0d7994;">
                <li class="nav-item"><a class="nav-link" style="color:#fffff0;" href="/">Trip</a></li>
                <li class="nav-item"><a class="nav-link" style="color:#fffff0;" href="{{route('tour')}}">Tour</a></li>
                <li class="nav-item"><a class="nav-link active" style="color:#18e0e0;" href="#">Bus HIre</a></li>
            </ul>
        </div>
    </div>
  </nav>
<body id="page-top">
  
    <header class="masthead" style="background-image:url('{{asset('/img/bus2.jpg')}}');">
        <div class="container">
                <div class="collapse navbar-collapse"></div>
                <section class="contact-clean">
                    <header class="header-dark">
                        <div class="container hero">
                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <h1 class="text-center" style="color: #8B4513">Bus Hiring Option</h1>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                    <a href="{{route('viewotprequestbushire')}}">
                                        <i class="tim-icons icon-zoom-split"></i>
                                        <p><h6>View Request Status</h6></p>
                                    </a>
                            </div>
                        
                        
                    </header>
                   
                    <form method="post" action="{{route('requestbus')}}">
                    @csrf
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                    {{Session::get('success')}}
                        </div>
                    @endif
                    @if(Session::has('err'))
                    <div class="alert alert-danger">
                    {{Session::get('err')}}
                        </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <p><h2>Request Bus </h2></p>
                        <div class="row justify-content-center">
                            <div class="column"><h6>First Name :</h6><input type="text" name="fname"value="{{ old('fname') }}" class="form-control justify-content-center"></div>
                            <div class="column"><h6>Last Name :</h6><input type="text" name="lname" value="{{ old('lname') }}" class="form-control justify-content-center"></div>
                        </div>
                        <br>
                        <div class="form-group">
                            <h6>Phone No :</h6> <input type="text" name="phone" value="{{ old('phone') }}" class="form-control text-center">
                        </div>
                        <div class="form-group">
                            <h6>Email :</h6> <input type="text" name="email" value="{{ old('email') }}" class="form-control text-center">
                        </div>
                    
                        <div class="row justify-content-center">
                            <div class="form-group column"> <h6>From :</h6><input list="stations"class="form-control" name="from" value="{{ old('from') }}" type="text"></div>
                            <div class="form-group column"> <h6>To :</h6><input list="stations" class="form-control" name="to" value="{{ old('to') }}" type="text" ></div>
                    
                        </div>
                                <datalist id="stations">
                                @foreach($stations as $station1)
                                     <option value="{{$station1}}">
                                @endforeach
                              </datalist>
                        <div class="row justify-content-center">
                                    <div class="form-group justify-content-center column"><h6>Start-Date :</h6><input class="form-control text-center" name="startdate" value="{{ old('startdate') }}"  type="date" style="width: 190px;"  ></div>
                                    <div class="form-group justify-content-center column"><h6>Start-Time :</h6><input class="form-control text-center" name="starttime" value="{{ old('starttime') }}" type="time" style="width: 190px;"  ></div>
                        </div>
                        <div class="row justify-content-center">
                                    <div class="form-group justify-content-center column"><h6>End-Date :</h6><input class="form-control text-center" name="enddate" value="{{ old('enddate') }}" type="date" style="width: 190px;"   ></div>
                                    <div class="form-group justify-content-center column"><h6>End-Time :</h6><input class="form-control text-center" name="endtime" value="{{ old('endtime') }}" type="time" style="width: 180px;"></div>
                        </div>
                        <br>
                            <div class="row justify-content-center">
                              
                                <select class="form-select form-select-lg mb-3 text-center" id="bus" style="width: 380px; height:40px;" name="buscount" value="{{ old('buscount') }}" aria-label="Default select example" onchange="myfunction()">
                                    <option selected>Select How Many Bus</option>
                                    @for ($i = 0; $i < 10; $i++)
                                    <option value="{{($i+1)}}">{{($i+1)}}</option>
                                    @endfor
                                   </select>
                              
                             </div>
                             <br>
                             <div class="size">
                                <div class="row justify-content-center">
                               
                                    <select class="form-select form-select-lg mb-3 text-center" style="width: 380px; height:40px;"  name="size[]" value="{{ old('size[]') }}" aria-label="Default select example">
                                        <option selected>Select Seat Size Of Bus</option>
                                         <option value="30">30 - Sleeper</option>
                                         <option value="36">36 - Sleeper</option>
                                         <option value="40">40 - Non - Sleeper</option>
                                         <option value="50">50 - Non - Sleeper</option>
                                    </select>
                                  
                                 </div>
                         
                            </div>
                          
                      
                             <div class="row justify-content-center">
                            <div class="column"><h6>Wifi</h6></div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group justify-content-center column">  
                                    <input type="radio" name="wifi" value="true" >
                                    <label>
                                      <p><b>Yes</b></p> 
                                    </label>
                                    <input type="radio" name="wifi" value="false" >
                                    <label>
                                      <p ><b>No</b></p>  
                                    </label>                      
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="column"><h6>Ac</h6></div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group justify-content-center column">  
                                    <input type="radio" name="ac" value="true" >
                                    <label>
                                      <p><b>Yes</b></p> 
                                    </label>
                                    <input type="radio" name="ac" value="false" >
                                    <label>
                                      <p ><b>No</b></p>  
                                    </label>                      
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="column"><h6>Return</h6></div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group justify-content-center column">  
                                    <input type="radio" name="return" value="true" >
                                    <label>
                                      <p><b>Yes</b></p> 
                                    </label>
                                    <input type="radio" name="return" value="false" >
                                    <label>
                                      <p ><b>No</b></p>  
                                    </label>                      
                            </div>
                        </div>

                      
                        
                        <div class="form-group"><button class="btn btn-primary" type="submit">Request</button></div>
                    </form>
                </section><button class="navbar-toggler" data-toggle="collapse"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="intro-lead-in"></div>
                <div class="intro-heading text-uppercase"></div>           
        </div>
    </header>
    
@endsection
@section('script')
<script>
    function myfunction()
    {
        
        var wrapper=$(".size");
        var count=document.getElementById('bus').value;
        console.log(count);
        $('.number').remove();
        for (let index = 1; index < count; index++) {
              
            $(wrapper).append('<div class="row justify-content-center number"><select class="form-select form-select-lg mb-3 text-center" style="width: 380px; height:40px;" name="size[]" aria-label="Default select example"><option selected>Select Seat Size Of Bus</option><option value="30">30 - Sleeper</option><option value="36">36 - Sleeper</option><option value="40">40 - Non - Sleeper</option><option value="50">50 - Non - Sleeper</option></select> </div>');
        }
    }
   
  </script>

@endsection

