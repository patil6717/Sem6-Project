@extends('layouts.app', ['pageSlug' => 'route'])
@section('content')
<div class="content">
    @if (!empty(session('saveroute')))
      <div class="alert alert-success col-12 col-md-12 text-center">
        <strong>Saved!!</strong> {{ session('saveroute')}}
        </div>
        
    @endif
  
    
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header text-center">
                Route
            </div>
            <div class="card-body ">
               
                  
                        <div class="row form-inline mb-2 justify-content-center text-center">
                 
                            <div class="form-group column mx-sm-3 text-center justify-content-center">
                              <h4>  From : <input type="text" name="from" value="{{$route->from_st}}" class="form-control-plaintext text-center" disabled></h4>
                            </div>
                            
                            <div class=" form-group column  justify-content-center text-center">
                             <h4>  To : <input type="text" name="from" value="{{$route->to_st}}" class="form-control-plaintext text-center" disabled> </h4>
                            </div>
                            
                 
                    </div>
               
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header text-center">
                Stations
            </div>
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table">
                        <div class="row justify-content-center text-center">
                        <tr>
                         
                               <td class="text-center">Station Order</td>
                               <td  class="text-center"> Station Name</td>
                               <td  class="text-center">  Time From Previous Station</td>
                               <td  class="text-center">  Hault-time / Delay</td>
                            
                        </tr>
                        </div>  
                            
                        @foreach ($map as $item)
                       
           
                        <div class="row justify-content-center text-center">
                            <tr>
                                <td class="text-center">   {{$loop->index+1}}</td>
                                <td class="text-center">{{$item->sname}}</td>
                                <td class="text-center"> {{$item->tfromp}}</td>
                                <td class="text-center">{{$item->delay}}</td>
                            </tr>   
                        </div>    
                        
                        @endforeach
                      
                      
                   
                </table>
            </div>
            <form action="{{route('admin.editroutemap',$route->rid)}}" method="get">
                <div class="row justify-content-center text-center">
                    <tr>
                        <td class="text-center"> <button class="btn btn-info">Edit</button> </td>     
                    </tr>   
                </div>    
            </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header text-center">
                Shedules
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                
                @foreach ($shedule as $item)
                       
           
                <div class="row justify-content-center text-center">
                    <tr>
                        <td class="text-center">   {{$loop->index+1}}</td>
                        <td class="text-center">{{$item->starttime}}</td>
                       
                    </tr>   
                </div>    
                    
                
                @endforeach
               
            </table>
        </div>
         <form action="{{route('admin.editrouteshedule',$route->rid)}}" method="get">
                    <div class="row justify-content-center text-center">
                        <tr>
                            <td class="text-center"> <button class="btn btn-info">Edit</button> </td>     
                        </tr>   
                    </div>    
                </form>
    </div>
    
        </div>
            </div>
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="column">
                        <form action="{{route('admin.routes')}}" method="get">
                            <button class="btn btn-black">< Go Back</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection