@extends('layouts.app', ['pageSlug' => 'bushire'])
@section('content')

<div class="content">
    <div class="row ">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header text-center">
              <h5 class="title">Allocation of Request Bus</h5>
            </div>
            <div class="card-body">
              <form class="justify-content-center" action="{{route('bookbushire')}}" method="post">
                @csrf
                <div class="row justify-contetn-center text-center">
                  <div class="col-md-2 px-md-1">
                    <div class="form-group">
                      <label>First Name :</label>
                      <input type="text" class="form-control text-center"  value="{{$rdata->fname}}" disabled>
                      <input type="text" class="form-control text-center" name="id"  value="{{$rdata->bhrid}}" hidden>
                
                    </div>
                  </div>
                  <div class="col-md-2 px-md-1 ">
                    <div class="form-group">
                      <label>Last Name :</label>
                      <input type="text" class="form-control text-center"  value="{{$rdata->lname}}" disabled>
                    </div>
                  </div>
                  <div class="col-md-3 px-md-1 ">
                    <div class="form-group">
                      <label>Phone Number :</label>
                      <input type="text" class="form-control text-center"  value="{{$rdata->phone}}" disabled>
                    </div>
                  </div>
                  <div class="col-md-5 px-md-1 ">
                    <div class="form-group">
                      <label>Email Id :</label>
                      <input type="text" class="form-control text-center" name="email" value="{{$rdata->email}}" >
                    </div>
                  </div>
                  
                </div>
                <div class="row justify-contetn-center text-center">
                  <div class="col-md-3 px-md-1">
                    <div class="form-group">
                      <label>From :</label>
                      <input type="text" class="form-control"  value="{{$rdata->from}}" disabled>
                    </div>
                  </div>
                  <div class="col-md-3 px-md-1 ">
                    <div class="form-group">
                      <label>To :</label>
                      <input type="text" class="form-control"  value="{{$rdata->to}}" disabled>
                    </div>
                  </div>
                  
                </div>
              
                <div class="row">
                  <div class="col-md-3 pr-md-1">
                    <div class="form-group">
                      <label>Start Data :</label>
                      <input type="text" class="form-control" placeholder="Company" value="{{$rdata->startdate}}" disabled>
                    </div>
                  </div>
                  <div class="col-md-3 pr-md-1">
                    <div class="form-group">
                      <label>Start Time :</label>
                      <input type="text" class="form-control" placeholder="Company" value="{{$rdata->starttime}}" disabled>
                    </div>
                  </div>
                  <div class="col-md-3 pr-md-1">
                    <div class="form-group">
                      <label>End Data :</label>
                      <input type="text" class="form-control" placeholder="Company" value="{{$rdata->enddate}}" disabled>
                    </div>
                  </div>
                  <div class="col-md-3 pr-md-1">
                    <div class="form-group">
                      <label>End Time :</label>
                      <input type="text" class="form-control" placeholder="Company" value="{{$rdata->endtime}}" disabled>
                    </div>
                  </div>
                 
                </div>
                  @foreach ($busdata as $items)
                  <div class="row">
             
                  <div class="col-md-1">
                    <div class="form-group">
                     <label >Sr No. :</label> 
                     <p class="form-control">{{$loop->index+1}}</p>
                    </div>
                  </div>
                  <div class="col-md-1 pr-md-1">
                    <div class="form-group">
                      <label>Bus Size :</label>
                      <input type="text" class="form-control" name="size[]" value="{{$rdata->size[$loop->index]}}" readonly>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>Select Number :</label>
                      <select class="form-select" aria-label="Default select example" name="bid[]" style="height: 40px; border-radius:5px;">
                        <option selected>Select Bus</option>
                        @foreach ($items as $item)
                        <option value="{{$item->number}}">{{$item->number}}</option>      
                        @endforeach      
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3 pr-md-1">
                    <div class="form-group">
                      <label>Select Driver :</label>
                      <select class="form-select" aria-label="Default select example" name="did[]" style="height: 40px; border-radius:5px;">
                        <option selected>Select Driver</option>
                        @foreach ($driver as $item)
                        <option value="{{$item->did}}">{{$item->name}}</option>      
                        @endforeach      
                      </select>
                    </div>
                  </div>
                  </div>
                  @endforeach
                <div class="row">
                  <div class="col-md-2 pr-md-1">
                    <div class="form-group">
                      <label>Total Kilometer : </label>
                      <input type="text" class="form-control" name="distance" placeholder="City" value="{{session()->get('distance')}}" readonly>
                    </div>
                  </div>
              
                  <div class="col-md-4 pr-md-1">
                    <div class="form-group">
                      <label>Total Amount : </label>
                      <input type="text" class="form-control" name="total" placeholder="City" value="{{session()->get('finalamount')}}" readonly>
                    </div>
                  </div>
               
                </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-fill btn-primary">Save</button>
                </div>
              </form>
                <form method="POST" action="{{route('deletebushire',$rdata->bhrid)}}">    <div class="card-footer">
                  @csrf @method('DELETE') <button type="submit" class="btn btn-fill btn-danger" >  Delete</button> 
                </div>
              </form>
            </div>
           
          </div>
        </div>
        
      </div>
    </div>
</div>
@endsection