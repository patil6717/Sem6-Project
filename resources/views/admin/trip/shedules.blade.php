@extends('layouts.app', ['pageSlug' => 'shedule'])
@section('content')
    
<div class="content">
  @if (!empty(session('saveroute')))
  <div class="col-12 col-md-12">
    <div class="alert alert-success col-12 col-md-12 text-center">
      <strong>Saved!!</strong> {{ session('saveroute')}}
      </div>
    </div>
      
  @endif
  <div class="col-12 col-md-12">
    <div class="card">
      <div class="card-header text-center">Filter</div>
      <div class="card-body justify-content-center text-center">
        <form class="form-inline justify-content-center" method="GET">
          <div class="form-group mb-2">
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
              <div class="card-header text-center">Shedules</div>
              <div class="card-body"> 
              
              @csrf
              <div class="table-responsive">
                <table class="table justify-content-center text-centers">
                @foreach($datas as $item)
                <tr>
               
              
                <th></th>
                  <th>
                  
                  {{ucfirst($item->from_st)}}
                  </th>
                  <th><img src="https://img.icons8.com/ios/50/000000/arrow.png"/></th> 
                  <th>
                  {{ucfirst($item->to_st)}}
                  </th>
                  <td>
                   
                  </tr>
                  @foreach ($item->shedule as $item1)
                  <tr ><td>{{$loop->index+1}}</td><td>
                    Start Time </td><td> -> </td><td>{{$item1->starttime}}
                     </td> 
                    <td>
                      End Time </td><td> -> </td><td>{{$item1->endtime}}
                       </td> 
                  </tr>
                  @endforeach
                  <tr>
                   <td colspan="7" class="text-center"> <form action="{{route('viewridshedule',$item->rid)}}" method="get">@csrf<button type="submit" class="btn btn-info">Edit</button></form></td>
                </td>
                 </tr>
                 <tr>
                   <td colspan="7"></td>
                 </tr>
                 
                  @endforeach
                 
                </table>
                {{ $datas->links() }}
            </div> 
           
             </form>
              </table>
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
