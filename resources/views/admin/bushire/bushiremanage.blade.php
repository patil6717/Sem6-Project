@extends('layouts.app', ['pageSlug' => 'bushire','page'=>'Bus hire'])
@section('content')
  <div class="content">
    <div class="col-12 col-md-12 card">
      @if(Session::has('acceptbushire'))
      <div class="alert alert-success justify-content-center text-center">
        {{Session::get('acceptbushire')}}
      </div>
      @endif
      @if(Session::has('deleted'))
      <div class="alert alert-danger justify-content-center text-center">
        {{Session::get('deleted')}}
      </div>
      @endif
      @if(Session::has('rdatanot'))
      <div class="alert alert-info text-center">
      {{Session::get('rdatanot')}}
      </div>
      @endif
      <div class="col col-12  justify-content-center text-center card">
        Requested
      </div>
      
      
      <div class="row"> 
      @foreach ($rdata as $request)
        <div class="col-lg-4 justify-content-center">
          <form action="{{route('acceptbushire',$request->bhrid)}}" method="get">
      
          <input type="text" class="form-group" value="{{$request->bhrid}}" hidden>
          <div class="card text-center">
            <div class="card-header">
              <h5 class="card-category">Requested Trip</h5>
              <h4 class="card-title">From : {{$request->from}}</h4>
              <h4 class="card-title">To    : {{$request->to}}</h4>
            </div>
            <div class="card-body text-center">
              <h3 class="card-category">Start Date : {{$request->startdate}}</h3>
              <h5 class="card-category">Start Time : {{$request->starttime}}</h5>
              <h5 class="card-category">End Date : {{$request->enddate}}</h5>
              <h5 class="card-category">End Time : {{$request->endtime}}</h5>
              <button type="submit" class="btn btn-black">View</button>
            </div>
          </div>
        </form>
        </div>
     

      @endforeach
            </div>
            </div>
            <div class="col-12 col-md-12 card">
              <div class="col col-12  justify-content-center text-center">
                Accepted
              </div>
              @if(Session::has('adatanot'))
                    <div class="alert alert-info text-center">
                    {{Session::get('adatanot')}}
                        </div>
                    @endif
                 
              <div class="row"> 
                @foreach ($adata as $request)
                <div class="col-lg-4 justify-content-center">
                  <form action="{{route('viewbushire1',$request->bhrid)}}" method="get">
                    @csrf
                  <input type="text" class="form-group" value="{{$request->bhrid}}" hidden>
                  <div class="card text-center">
                    <div class="card-header">
                      <h5 class="card-category">Accepted Trip</h5>
                      <h4 class="card-title">From : {{$request->from}}</h4>
                      <h4 class="card-title">To    : {{$request->to}}</h4>
                    </div>
                    <div class="card-body text-center">
                      <h3 class="card-category">Start Date : {{$request->startdate}}</h3>
                      <h5 class="card-category">Start Time : {{$request->starttime}}</h5>
                      <h5 class="card-category">End Date : {{$request->enddate}}</h5>
                      <h5 class="card-category">End Time : {{$request->endtime}}</h5>
                      <button type="submit" class="btn btn-black">View</button>
                    </div>
                  </div>
                </form>
                </div>
             
        
              @endforeach
               
              
            </div>
          </div>
          
</div>
@endsection