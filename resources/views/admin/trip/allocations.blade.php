@extends('layouts.app', ['pageSlug' => 'allocation'])
@section('content')
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
     
<div class="content">
  @if (!empty(session('success')))
  <div class="alert alert-success col-12 col-md-12 text-center">
    <strong>Saved!!</strong> {{ session('success')}}
    </div>
    
@endif
<div class="col-12 col-md-12">
      <table class="table table-responsive">
        <tr >
          <form action="{{route('admin.allocation')}}">
          <input type="text" name="date" value={{\Carbon\Carbon::now()->format('Y-m-d')}} hidden>
          <td><button type="submit" class="btn btn-info btn-simple">Today-Tommorow</button></td>
        </form>
          @for ($i = 0; $i < 30; $i++)
          <form action="{{route('admin.allocation')}}" method="get">
            
          <input type="text" name="date" value={{\Carbon\Carbon::now()->add($i+1,'day')->format('Y-m-d')}} hidden>
          <td style="width: 100px" class=" col-6 col-md-6"><button type="submit" class="btn btn-info btn-simple">{{\Carbon\Carbon::now()->add($i+1,'day')->format('d/m')}}-{{\Carbon\Carbon::now()->add($i+2,'day')->format('d/m')}}</button></td>        
            </form>
          @endfor
        </tr>
      </table>
    
    </div>
    <div class="col-12 col-md-12">
      <div class="card">
          <div class="card-header text-center">
           {{session()->get('today')}} 
          </div>
          <div class="card-body">
            
                <table class="table ">
                  <tr><td>From</td>
                    <td>To</td>
                    <td>Starttime</td>
                    <td>End Time</td>
                    <td>Bus NUmber</td>
                    <td>Driver Name</td>
                    <td>Action</td>
                  </tr>
                  @foreach ($todaydata as $item)
                      @foreach ($item->shedule as $in)
                          <tr>
                            <td>{{$item->from_st}}</td><td>{{$item->to_st}}</td>
                          <td>{{$in->starttime}}</td>
                            <td>{{$in->endtime}}</td>
                            <form action="{{route('viewallocate')}}" method="get">
                            @if(empty($in->busallocation))
                            <td>Not Assigned</td>
                            <td>Not Assigned</td>
                                <td>
                                  <input type="text" name="date" value="{{session()->get('today')}}" hidden>
                                  <input type="text" name="rid" value="{{$item->rid}}" hidden>
                                  <input type="text" name="starttime" value="{{$in->starttime}}" hidden>
                                  <input type="text" name="endtime" value="{{$in->endtime}}" hidden>
                                
                                  <button type="submit" rel="tooltip" class="btn btn-success btn-sm btn-icon">
                                  <i class="tim-icons icon-settings"></i>
                              </button</td>
                            @else
                                <td>{{$in->bus->number}}</td>
                                <td>{{$in->driver->name}}</td>
                                <td>    <input type="text" name="date" value="{{session()->get('today')}}" hidden>
                                  <input type="text" name="rid" value="{{$item->rid}}" hidden>
                                  <input type="text" name="starttime" value="{{$in->starttime}}" hidden>
                                  <input type="text" name="endtime" value="{{$in->endtime}}" hidden>
                              
                                  <button type="submit" rel="tooltip" class="btn btn-success btn-sm btn-icon">
                                  <i class="tim-icons icon-settings"></i>
                              </button</td>
                            @endif
                          </form>
                        </tr>
                      @endforeach
                  @endforeach
               
                </table>
                {{ $todaydata->links() }}
          </div>
      </div>
    </div>
    <div class="col-12 col-md-12">
      <div class="card">
          <div class="card-header text-center">
            {{session()->get('tomorrow')}}
          </div>
          <div class="card-body">
            
                <table class="table">
                  <tr><td>From</td>
                    <td>To</td>
                    <td>Starttime</td>
                    <td>End Time</td>
                    <td>Bus NUmber</td>
                    <td>Driver Name</td>
                    <td>Action</td>
                  </tr>
                  @foreach ($tomorrowdata as $item)
                      @foreach ($item->shedule as $in)
                          <tr>
                            <td>{{$item->from_st}}</td><td>{{$item->to_st}}</td>
                          <td>{{$in->starttime}}</td>
                            <td>{{$in->endtime}}</td>
                            <form action="{{route('viewallocate')}}" method="get">
                          
                            @if(empty($in->busallocation))
                            <td>Not Assigned</td>
                            <td>Not Assigned</td>
                            <td>   <input type="text" name="rid" value="{{$item->rid}}" hidden>
                              <input type="text" name="date" value="{{session()->get('tomorrow')}}" hidden>
                              <input type="text" name="starttime" value="{{$in->starttime}}" hidden>
                              <input type="text" name="endtime" value="{{$in->endtime}}" hidden>
                              
                              <button type="submit" rel="tooltip" class="btn btn-success btn-sm btn-icon">
                               
                                
                                <i class="tim-icons icon-settings"></i>
                              </button></td>
                            @else
                                <td>{{$in->bus->number}}</td>
                                <td>{{$in->driver->name}}</td>
                                <td>   <input type="text" name="rid" value="{{$item->rid}}" hidden>
                                  <input type="text" name="date" value="{{session()->get('tomorrow')}}" hidden>
                                  <input type="text" name="starttime" value="{{$in->starttime}}" hidden>
                                  <input type="text" name="endtime" value="{{$in->endtime}}" hidden>
                              
                                  <button type="submit" rel="tooltip" class="btn btn-success btn-sm btn-icon">
                                    <i class="tim-icons icon-settings"></i>
                              </button></td>
                            @endif
                            </form>
                        </tr>
                      @endforeach
                  @endforeach
                 
                </table>
                {{ $tomorrowdata->links() }}
          </div>
      </div>
    </div>
  
</div>

@stop
@section('script')
<style>
  .w-5{
    display: none;
  }
</style>
   
@endsection