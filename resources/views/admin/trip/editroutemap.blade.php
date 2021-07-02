@extends('layouts.app', ['pageSlug' => 'route'])
@section('content')
    <div class="content">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    Edit Station Name
                </div>
                <div class="card-body table table-responsive justify-content-center text-center">
                    <form action="{{route('saverouteeditdata')}}" method="post">
                        @csrf
                        @foreach ($map as $item)
                            @if ($loop->index < count($map)-1)
                            <div class="row ram justify-content-center text-center  mt-md-3   pl-md-2">
                          
                                {{-- <div >
                                    <input type="text" name="" class="column form-control col-6 col-md-6 mx-sm-2" value="{{$item->sorder}}">
                                </div> --}}
                                <div class="">
                                    
                                    <input type="text" name="sname[]" list="fromstation" id="" class="form-control col-12 col-md-10  mt-sm-auto" value="{{$item->sname}}">
                                </div>
                               
                                <div >
                                    <input type="text" name="tfromp[]" id="" class="form-control col-6 col-md-6" value="{{$item->time}}">
                                </div>
                               
                                <div>
                                    <input type="text" name="delay[]" id="" class="form-control col-6 col-md-6" value="{{$item->delay}}">
                                </div>
                                <br>
                                <div>
                                    @if ($loop->index==0 || $loop->index==count($map)-1)
                                    <button class="btn btn btn-danger add_field_button"  style="margin-left: 20px;"  id="adddata" type="button"><i class="tim-icons icon-simple-add"></i></button>
                                    @else
                                    <div ><a href="#" class="remove_field"><button class=" btn btn btn-danger"  style="margin-left: 18px;"  type="button"><i class="tim-icons icon-simple-delete"></i></button></a></div>   
                                    @endif
                                </div>
                               
                            </div>  
    
                            @endif
                       
                        @endforeach
                        <datalist id="fromstation">
                            @foreach($station as $item)
                            <option value="{{$item->sname}}"></option>
                            @endforeach
                        </datalist>
                        <div class="wrapper1_add">
                  
                         </div>
                         <div class="row justify-content-center text-center  mt-md-3   pl-md-2">
                            <div class="">
                                <input type="text" name="sname[]" id="" class="form-control col-12 col-md-10  " value="{{session()->get('enddata')->sname}}">
                            </div>
                           
                            <div >
                                <input type="text" name="tfromp[]" id="" class="form-control col-6 col-md-6" value="{{session()->get('enddata')->time}}">
                            </div>
                           
                            <div>
                                <input type="text" name="delay[]" id="" class="form-control col-6 col-md-6" value="{{session()->get('enddata')->delay}}">
                            </div>
                            <br>
                            <div>
                              
                                <button class="btn btn btn-danger add_field_button"  style="margin-left: 20px;"  id="adddata" type="button"><i class="tim-icons icon-simple-add"></i></button>
                            </div>
                        </div>
                         <br>
                         <div class="row justify-content-center">
                            <input type="text" name="rid" id="" value="{{$map[0]->rid}}" hidden>
                             <button class="btn btn-info">Save </button>
                         </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-md-12 justify-content-center text-center">
                <form action="{{route('viewroute',$map[0]->rid)}}" method="get">
                    <button class="btn btn-black" type="submit">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    
@stop
@section('script')

<script>
  $(document).ready(function() {
	

    var max_fields      = 100; 
	var wrapper 	   	= $(".wrapper1_add"); 
    var wrapper1 	   	= $(".ram"); 
	var add_button      = $(".add_field_button"); 
	
	
    var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append('<div class="row justify-content-center text-center mt-md-3   pl-md-2"><div ><input type="text" name="sname[]" list="fromstation" id="" class="form-control col-12 col-md-10 "></div><div ><input type="text" name="tfromp[]" id="" class="form-control col-6 col-md-6" ></div><div><input type="text" name="delay[]" id="" class="form-control col-6 col-md-6" ></div><br><div><div ><a href="#" class="remove_field1"><button class=" btn btn btn-danger"  style="margin-left: 18px;"  type="button"><i class="tim-icons icon-simple-delete"></i></button></a></div></div></div>'); //add inpu            
          
        }
	});
	$(wrapper).on("click",".remove_field1", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').parent('div').parent('div').remove(); x--;
	});
    $(wrapper1).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').parent('div').parent('div').remove(); x--;
	});
	// $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
	// 	e.preventDefault(); $(this).parent('div').remove(); x--;
	// });
});
</script>

@stop