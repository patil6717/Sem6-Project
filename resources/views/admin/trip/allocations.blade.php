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
          <td><button type="submit" @if (\Carbon\Carbon::now()->format('Y-m-d') == session()->get('today'))  class="btn btn-info btn-active"@else class="btn btn-info btn-simple" @endif>Today-Tommorow</button></td>
        </form>
          @for ($i = 0; $i < 30; $i++)
          <form action="{{route('admin.allocation')}}" method="get">
            
          <input type="text" name="date" value={{\Carbon\Carbon::now()->add($i+1,'day')->format('Y-m-d')}} hidden>
          <td style="width: 100px" class=" col-6 col-md-6"><button type="submit" @if (\Carbon\Carbon::now()->add($i+1,'day')->format('Y-m-d') == session()->get('today'))  class="btn btn-info btn-active"@else  class="btn btn-info btn-simple" @endif>{{\Carbon\Carbon::now()->add($i+1,'day')->format('d/m')}}-{{\Carbon\Carbon::now()->add($i+2,'day')->format('d/m')}}</button></td>        
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
                 
                    @if (session()->get('today')!=\Carbon\Carbon::now()->format('Y-m-d'))
                    <form action="{{route('admin.copydata',session()->get('today'))}}">
                    <tr>
                      <td colspan="7" class="justify-content-center text-center"><button type="submit" class="btn btn-black">Copy Data From PRevious Record</button></td>
                  </tr>
                </form>
                  @endif
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
                            <td style="color: red;"bgcolor="#FF6347">Not Assigned</td>
                            <td style="color: red;" bgcolor="#FF6347">Not Assigned</td>
                              
                            @else
                            @if($in->bus==null)
                            <td style="background-color: red;"bgcolor="#FF6347">Not Assigned</td>
                            @else
                            <td>{{$in->bus->number}}</td>
                            @endif
                              @if ($in->driver==null)
                              <td style="background-color: red;" bgcolor="#FF6347">Not Assigned</td>
                              @else
                              <td>{{$in->driver->name}}</td>  
                              @endif
                              
                                
                                <input type="text" name="date" value="{{session()->get('today')}}" hidden>
                                  <input type="text" name="rid" value="{{$item->rid}}" hidden>
                                  <input type="text" name="starttime" value="{{$in->starttime}}" hidden>
                                  <input type="text" name="endtime" value="{{$in->endtime}}" hidden>
                                  <input type="text" name="shid" value="{{$in->shid}}" hidden>
                                
                            @endif
                            <td>
                            <button type="submit" rel="tooltip" class="btn btn-success btn-sm btn-icon">
                              <i class="tim-icons icon-settings"></i>
                          </button>
                        </td>  
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
                  <form action="{{route('admin.copydata',session()->get('tomorrow'))}}">
                    
                  <tr>
                    <td colspan="7" class="justify-content-center text-center"><button type="submit" class="btn btn-black">Copy Data From PRevious Record</button></td>
                </tr>
                  </form>
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
                            <td style="color:red;"  bgcolor="#FF6347" style="border-radius: 5px;">Not Assigned</td>
                            <td   bgcolor="#FF6347">Not Assigned</td>
                            @else
                            @if($in->bus==null)
                            <td bgcolor="#FF6347">Not Assigned</td>
                            @else
                            <td  >{{$in->bus->number}}</td>
                            @endif
                              @if ($in->driver==null)
                              <td bgcolor="#FF6347">Not Assigned</td>
                              @else
                              <td>{{$in->driver->name}}</td>  
                              @endif
                                  <input type="text" name="rid" value="{{$item->rid}}" hidden>
                                  <input type="text" name="date" value="{{session()->get('tomorrow')}}" hidden>
                                  <input type="text" name="starttime" value="{{$in->starttime}}" hidden>
                                  <input type="text" name="endtime" value="{{$in->endtime}}" hidden>
                                  <input type="text" name="shid" value="{{$in->shid}}" hidden>
                            @endif
                            <td>
                              <button type="submit" rel="tooltip" class="btn btn-success btn-sm btn-icon">
                                <i class="tim-icons icon-settings"></i>
                            </button>
                          </td> 
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