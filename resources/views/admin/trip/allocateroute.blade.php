@extends('layouts.app', ['pageSlug' => 'allocation'])
@section('content')
<div class="content">
    <div class="col-12 col-md-12 text-center justify-content-center">
        <div class="card">
            <div class="card-header text-center">Allocation OF Route</div>
            <div class="card-body">
                <form action="{{route('saveallocation')}}" method="post">
                    @csrf
                <div class="row text-center">
                    <div class=" col-6">Start Date : <input type="text" class="form-control text-center" name="startdate" value="{{$date}}" style="background-color: white;" ></div>
                      <div class=" col-6"> Start Time :<input type="text" class="form-control text-center" name="starttime"  value="{{$starttime}}" style="background-color: white;" ></div>
                </div>
                <br>
                <div class="row text-center">
                     
                      <div class="col col-6"><input type="text" name="rid" value="{{$rid}}" hidden> End Time : <input type="text" class="form-control text-center" name="endtime" value="{{$endtime}}" style="background-color: white;"></div>
                      <div class="col col-6">End Date : <input type="text" class="form-control text-center" name="enddate" value="{{$enddate}}" style="background-color: white;" ></div>
                    </div>
                    <br>
                <div class="row text-center">
                <div class="col-6 text-center">
                    <div class="form-group ">
                     Select Number : 
                      <select class="form-control text-center justify-content-center" aria-label="Default select example" name="bid">
                        <option selected value="NULL">Select Bus</option>
                        @foreach ($bus as $item)
                        <option value="{{$item->bid}}" >{{$item->number}}</option>      
                        @endforeach      
                      </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                     Select Number :
                      <select class="form-control" aria-label="Default select example" name="did" >
                        <option selected value="NULL">Select Driver</option>
                        @foreach ($driver as $item)
                        <option value="{{$item->did}}" >{{$item->name}}</option>      
                        @endforeach      
                      </select>
                    </div>
                </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col col-12 text-center">
                    <button class="btn btn-info" type="submit">Save</button></div>
                </div>
            </div>
                
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 text-center">
        <button class="btn btn-danger">Cancel</button>
    </div>
</div>
@endsection