@extends('layouts.app', ['pageSlug' => 'route'])
@section('content')
    
<div class="content">
  @if (!empty(session('saveroute')))
  <div class="alert alert-success col-12 col-md-12 text-center">
    <strong>Saved!!</strong> {{ session('saveroute')}}
    </div>
    
@endif
@if (!empty(session('deletesuccess')))
<div class="alert alert-danger col-12 col-md-12 text-center">
  <strong>Dleted!!</strong> {{ session('deletesuccess')}}
  </div>
  
@endif

  <div class="col-12 col-md-12">
    <div class="card">
      <div class="card-header text-center">Filter</div>
      <div class="card-body justify-content-center text-center">
        <form class="form-inline justify-content-center" method="GET">
          <div class="form-group mb-2 ">
            <input type="text" class="form-control mr-2 text-center" id="filter" name="filter1" placeholder="From" value="{{$filter1}}">
            <input type="text" class="form-control mr-2 text-center" id="filter" name="filter2" placeholder="To" value="{{$filter2}}">
          </div>
          <button type="submit" class="btn btn-default mb-2">Search</button>
        </form>
        
      </div>
    </div>
  </div>
  
          <div class="col-12 col-md-12">
            <div class="card ">
              <div class="card-header text-center">Routes</div>
              <div class="card-body"> 
              
              @csrf
              <div class="table-responsive">
                <table class="table">
                <tr><td colspan="4" ><button type="button" class="btn btn-black" ><a href="{{route('addroute')}}">Add</a> </button></td></tr>
                  <tr>
                    <td class="text-center">@sortablelink('rid', 'Route ID')</td>
                    <td class="text-center">@sortablelink('from_st', 'From Station')</td>
                    <td class="text-center">@sortablelink('to_st', 'To Station')</td>
                    <td class="text-center">Via</th>
                    <td class="text-center">Action</th>
                  </tr>
                @foreach($routes as $route)
                <tr>
                <form  action="{{route('deleteroute',$route->rid)}}" method="POST">
                @csrf
                @method('delete')
                <td class="text-center">
                  {{$route->rid}}
                </td>
                  <td class="text-center">
                  
                  {{ucfirst($route->from_st)}}
                  </td>
                  <td class="text-center">
                  {{ucfirst($route->to_st)}}
                  </td>
                  <td class="text-center">
                    {{$route->via}}
                  </td>
                  <td class="td-actions text-center">
                    <button type="submit" rel="tooltip" class="btn btn-danger btn-link btn-icon btn-sm">
                      <i class="tim-icons icon-simple-remove"></i>
                  </button>
                  </form>
                  <form action="{{route('viewroute',$route->rid)}}" method="get">@csrf<button  type="submit" rel="tooltip" class="btn btn-info btn-link btn-icon btn-sm"><i class="tim-icons icon-single-02"></i></button></form>
                </td> 
                 </tr>
              
                  @endforeach
                </table>
            </div> 
            {!! $routes->appends(\Request::except('page'))->render() !!}
             </form>
              </table>
              </div>
            </div>
          </div>
</div>



<div class="modal fade" id="longadddata" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class=" modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="adddataLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <!-- <section> -->
                       
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
