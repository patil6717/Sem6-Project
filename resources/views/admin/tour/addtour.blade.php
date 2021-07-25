@extends('layouts.app', ['pageSlug' => 'tour'])
@section('content')
<div class="content">
        <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.savetour')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <table class="table">
                                <tr><td colspan="3" class="text-center"><h1>Tour Form</h1></td></tr>
                                <tr><td>
                                    Main Attraction <input type="text" class="form-control " name="main" id=""></td>
                                    <td>Pickup <input type="text" class="form-control " name="pickup" id=""></td>
                                        <td>Start Station
                                            <select name="city" class="form-control" id="">
                                                <option>Select Station</option>
                                                @foreach ($station as $item)
                                                <option value="{{$item->sid}}">{{$item->sname}}</option>    
                                                @endforeach
                                            </select>
                                        </td>
                                  
                                     </tr>
                                <tr>
                                    <td>Day<input type="number" class="form-control" name="day" ></td>
                                    <td>Night<input type="number" class="form-control" name="night" ></td> 
                                    <td>Price<input type="text" class="form-control" name="price" ></td>
                                </tr>
                                <tr>
                                    <td>StartDate<input type="date" class="form-control" name="startdate" ></td>
                                    <td>StartTime<input type="time" class="form-control" name="starttime" ></td>  
                                </tr>
                                <tr>
                                    <td>Bus 
                                        <select name="bus" class="form-control" id="">
                                            <option>Select Bus</option>
                                            @foreach ($bus as $item)
                                            <option value="{{$item->bid}}">{{$item->number}}</option>    
                                            @endforeach
                                        </select>
                                        </td>
                                        <td>Driver 
                                            <select name="driver" class="form-control" id="">
                                                <option>Select Driver</option>
                                                @foreach ($driver as $item)
                                                <option value="{{$item->did}}">{{$item->name}}</option>    
                                                @endforeach
                                            </select>
                                            </td>
                                         
                                </tr>
                                <tr>
                                    <td colspan="3">Select Picture
                                       <input type="file" name="image" class="form-control col-4" placeholder="Choose file" id="file">
                                       
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-center">
                                        <button class="btn btn-black">Save</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
        </div>
    </div>
@endsection