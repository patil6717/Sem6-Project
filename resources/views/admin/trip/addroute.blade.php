@extends('layouts.app', ['pageSlug' => 'route'])
@section('content')

<div class="content">
<div id="multple-step-form-n" class="container" style="margin-top: 10px;margin-bottom: 10px;padding-bottom: 300px;padding-top: 57px;">
            <div id="progress-bar-button" class="multisteps-form">
                <div class="row">
                    <div class="col-12 col-lg-8 ml-auto mr-auto mb-4">
                        <div class="multisteps-form__progress"><a class="multisteps-form__progress-btn js-active" role="button" title="User Info">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;Route Info</a><a class="multisteps-form__progress-btn" role="button" title="User Info">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Stations Order</a><a class="multisteps-form__progress-btn" role="button" title="User Info">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Shedule&nbsp</a></div>
                    </div>
                </div>
            </div>
            <!-- <div id="multistep-start-row" class="row"> -->
                <div id="multistep-start-column" >
                    <form id="main-form" class="multisteps-form__form" method="post" action="{{route('saveroute')}}">
                    @csrf
                        <div id="single-form-next" class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
                            <h3 class="text-center multisteps-form__title">Route Info</h3>
                            <div id="form-content" class="multisteps-form__content">
                                <div id="input-grp" class=" md-6 row">
                                    <div class="col"><input class="form-control multisteps-form__input  " list="fromstation" type="text" name="from" placeholder="From"></div>
                                    <div class="col"><input class="form-control multisteps-form__input" list="fromstation" type="text" name="to" placeholder="To"></div>
                                    <div> <datalist id="fromstation">
                                        @foreach($stations as $station)
                                        <option value="{{$station->sname}}"></option>
                                        @endforeach
                                        </datalist>
                                     </div>
                                </div>
                                <div id="next-button" class="button-row d-flex mt-4"><button class="btn btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button></div>
                            </div>
                        </div>
                        <div id="single-form-next-prev" id="todata" class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="text-center multisteps-form__title"> Stations Order</h3>
                            <div id="form-content-1" class="multisteps-form__content">
                            
                                <div id="input-group" class=" input_fields_wrap_station">
                                <div class="row" >
                                  <input class="column col-md-6 form-control " style="margin-left: 20px; " list="fromstation"type="text" placeholder="Station Name" name="sname[]">
                                    <div> <datalist id="fromstation">
                                        @foreach($stations as $station)
                                        <option value="{{$station->sname}}"></option>
                                        @endforeach
                                        </datalist>
                                     </div>
                                  <input class=" column col-md-2 form-control" style="margin-left: 20px; " type="text" placeholder="Station Order" name="sorder[]">
                                   <input class="column col-md-6  form-control "  style="margin-left: 20px; margin-top : 10px; margin-bottom : 5px;"  type="text" placeholder="Time From Previous Station" name="tfromp[]">
                                   <input class="column  col-md-3 form-control "  style="margin-left: 20px; margin-top : 10px; padding-bottom : 5px;"  type="text" placeholder="Hault Time" name="delay[]">
                                    <button class="button-row d-flex btn btn btn-primary add_field_button "  style="margin-left: 20px;"  id="adddata" type="button"><i class="tim-icons icon-simple-add"></i></button>
                                </div>
                                </div>
                                <div id="next-prev-buttons" class="button-row d-flex mt-4"><button class="btn btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button><button class="btn btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button></div>
                            </div>
                        </div>
                       
                        <div id="single-form-next-prev-2" class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="text-center multisteps-form__title">Shedules</h3>
                            <div id="form-content-2" class="multisteps-form__content">
                            
                                <div id="input-group" class=" input_fields_wrap_shedules">
                                <div class="row" >
            
                                 Time : <input class=" column col-md-2 form-control" style="margin-left: 20px; " type="time"  placeholder="Shedule Time" name="shedules[]">
                                    <button class="button-row d-flex btn btn btn-primary add_field_button_shedules "  style="margin-left: 20px;"  id="adddata" type="button"><i class="tim-icons icon-simple-add"></i></button>
                                </div>
                                </div>
                                <div id="next-prev-buttons" class="button-row d-flex mt-4"><button class="btn btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button><button class="btn btn btn-primary ml-auto js-btn-save" type="submit">Save</button></div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>


</div>
    

@stop

@section('script')

<script>
  $(document).ready(function() {
	var max_fields1      = 50; 
	var wrapper1   	   	= $(".input_fields_wrap_station"); 
	var add_button1      = $(".add_field_button"); 

    var max_fields      = 50; 
	var wrapper 	   	= $(".input_fields_wrap_shedules"); 
	var add_button      = $(".add_field_button_shedules"); 
	
	var x1 = 1; //initlal text box count
	$(add_button1).click(function(e){ //on add input button click
		e.preventDefault();
		if(x1 < max_fields1){ //max input box allowed
			x++; //text box increment
			$(wrapper1).append('<div class="row"><input class="column col-md-6 form-control"  style="margin-left: 20px;" value=""  list="fromstation"type="text" placeholder="Station Name" name="sname[]"><div> <datalist id="fromstation">@foreach($stations as $station)<option value="{{$station->sname}}"></option>@endforeach</datalist></div> <input class=" column col-md-2 form-control" style="margin-left: 20px; " type="text" placeholder="Station Order" name="sorder[]">  <input class="column col-md-6  form-control "  style="margin-left: 20px; margin-top : 10px; margin-bottom : 5px;"  type="text" placeholder="Time From Previous Station" name="tfromp[]"><input class="column  col-md-3 form-control "  style="margin-left: 20px; margin-top : 10px; padding-bottom : 5px;"  type="text" placeholder="Hault Time" name="delay[]"><a href="#" class="remove_field"><button class="button-row d-flex btn btn btn-primary"  style="margin-left: 20px;"  type="button"><i class="tim-icons icon-simple-delete"></i></button></a></div>'); //add input box
		}
	});
	
	$(wrapper1).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x1--;
	});
    var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append('<div class="row">Time : <input class=" column col-md-2 form-control" style="margin-left: 20px; " type="time"  placeholder="Shedule Time" name="shedules[]"><a href="#" class="remove_field"><button class="button-row d-flex btn btn btn-primary"  style="margin-left: 20px;"  type="button"><i class="tim-icons icon-simple-delete"></i></button></a></div></div>'); //add input box
		}
	});
	
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	});
});
</script>



@stop