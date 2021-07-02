@extends('layouts.app', ['pageSlug' => 'route'])
@section('content')
    <div class="content">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    Edit Shedule
                </div>
                <div class="card-body table table-responsive justify-content-center text-center">
                    <form action="{{route('saverouteshedule')}}" method="post">
                        @csrf
                        @foreach ($shedule as $item)
                            <div class="row ram justify-content-center text-center  mt-md-3   pl-md-2">
                              <div class="col-5">                
                                    <input type="time" name="shedule[]" id="" class="form-control col-12 col-md-10  mt-sm-auto" value="{{$item->starttime}}">
                                </div>
                                <div>
                                    @if ($loop->index==0 )
                                    <button class="btn btn btn-danger add_field_button"  style="margin-left: 20px;"  id="adddata" type="button"><i class="tim-icons icon-simple-add"></i></button>
                                    @else
                                    <div ><a href="{{route('deleteshedule',$item->shid)}}" ><button class=" btn btn btn-danger"  style="margin-left: 18px;"  type="button"><i class="tim-icons icon-simple-delete"></i></button></a></div>   
                                    @endif
                                </div>
                               
                            </div>  
    
                         
                        @endforeach
                     
                        <div class="wrapper1_add">
                            
                         </div>
                         <br>
                         <div class="row justify-content-center">
                            <input type="text" name="rid" id="" value="{{$shedule[0]->rid}}" hidden>
                             <button class="btn btn-info">Save </button>
                         </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 justify-content-center text-center">
            <form action="{{route('viewroute',$shedule[0]->rid)}}" method="get">
                <button class="btn btn-black" type="submit">Cancel</button>
            </form>
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
			$(wrapper).append(' <div class="row justify-content-center text-center  mt-md-3   pl-md-2"><div class="col-5"><input type="time" name="shedule[]" list="fromstation" id="" class="form-control col-12 col-md-10  mt-sm-auto" ></div><div><div><a href="#" class="remove_field"><button class=" btn btn btn-danger"  style="margin-left: 18px;"  type="button"><i class="tim-icons icon-simple-delete"></i></button></a></div></div></div>'); //add inpu            
             

        }
	});
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
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