
  
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Om Sai Tour</title>
    <!-- <link rel="tylesheet" href="{{asset('bootstrap/css/bootstrap.min.css?h=553e1c2a2573c524c40439f9d0b80bb8')}}"> -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('css/Contact-Form-Clean-1.css')}}">
    <link rel="stylesheet" href="{{asset('css/Contact-Form-Clean-2.css')}}">
    <link rel="stylesheet" href="{{asset('css/Contact-Form-Clean.css')}}">
    <link rel="stylesheet" href="{{asset('css/Dark-NavBar-1.css')}}">
    <link rel="stylesheet" href="{{asset('css/Dark-NavBar-2.css')}}">
    <link rel="stylesheet" href="{{asset('css/Dark-NavBar-3.css')}}">
    <link rel="stylesheet" href="{{asset('css/Dark-NavBar-4.css')}}">
    <link rel="stylesheet" href="{{asset('css/Dark-NavBar.css')}}">
    <link rel="stylesheet" href="{{asset('css/Footer-Clean.css')}}">
    <link rel="stylesheet" href="{{asset('css/Footer-Dark.css')}}">
    <link rel="stylesheet" href="{{asset('css/Header-Dark.css')}}">
    <link rel="stylesheet" href="{{asset('css/Navigation-with-Button.css')}}">
    <link rel="stylesheet" href="{{asset('css/seat.css')}}">
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery.seat-charts.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    .img{
      border-radius: 10px;
  height:150px;
  width:100%;
}

div [class="try"]{
  padding-left:5px;
  padding-right:5px;
}
.card{
  margin: 20px,20px,20px,20px;
  transition:0.5s;
  cursor:pointer;
  height: 450px;
  border-radius: 10px;
}
.card-title{  
  font-size:15px;
  transition:1s;
  cursor:pointer;
}
.card-title i{  
  font-size:15px;
  transition:1s;
  cursor:pointer;
  color:#ffa710
}
.card-title i:hover{
  transform: scale(1.25) rotate(100deg); 
  color:#18d4ca;
  
}
.card:hover{
  transform: scale(1.05);
  box-shadow: 10px 10px 15px rgba(0,0,0,0.3);
}
.card-text{
  height:80px;  
}

.card::before, .card::after {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  transform: scale3d(0, 0, 1);
  transition: transform .3s ease-out 0s;
  background: rgba(255, 255, 255, 0.1);
  content: '';
  pointer-events: none;
}
.card::before {
  transform-origin: left top;
}
.card::after {
  transform-origin: right bottom;
}
.card:hover::before, .card:hover::after, .card:focus::before, .card:focus::after {
  transform: scale3d(1, 1, 1);
}
</style>

<style>

body {
	font-family: 'Roboto', sans-serif;
  background-color:#fafafa;
}
a {
	color: #b71a4c;
}
.front-indicator {
	width: 145px;
	margin: 5px 32px 15px 32px;
	background-color: #f6f6f6;	
	color: #adadad;
	text-align: center;
	padding: 3px;
	border-radius: 5px;
}
.wrapper {
	width: 100%;
	text-align: center;
  margin-top:150px;
}
.container1 {
	margin: 0 auto;
	width: 500px;
	text-align: left;
}
.booking-details {
	float: left;
	text-align: left;
	margin-left: 35px;
	font-size: 12px;
	position: relative;
	height: 401px;
}
.booking-details h2 {
	margin: 25px 0 20px 0;
	font-size: 17px;
}
.booking-details h3 {
	margin: 5px 5px 0 0;
	font-size: 14px;
}
div.seatCharts-cell {
	color: #182C4E;
	height: 25px;
	width: 25px;
	line-height: 25px;
	
}
div.seatCharts-seat {
	color: #FFFFFF;
	cursor: pointer;	
}
div.seatCharts-row {
	height: 35px;
}
div.seatCharts-seat.available {
	background-color: silver;

}
div.seatCharts-seat.available.first-class {
/* 	background: url(vip.png); */
	background-color: red;
}
div.seatCharts-seat.focused {
	background-color: red;
}
div.seatCharts-seat.selected {
	background-color: #76B474;
}
div.seatCharts-seat.unavailable {
	background-color: #472B34;
}
div.seatCharts-seat.ladies {
	background-color: pink;
}
div.seatCharts-container1 {
	border-right: 1px dotted #adadad;
	width: 200px;
	padding: 20px;
	float: left;
}
div.seatCharts-legend {
	padding-left: 0px;
	position: absolute;
	bottom: 16px;
}
ul.seatCharts-legendList {
	padding-left: 0px;
}
span.seatCharts-legendDescription {
	margin-left: 5px;
	line-height: 30px;
}
.checkout-button {
	display: block;
	margin: 10px 0;
	font-size: 14px;
}
#selected-seats {
	max-height: 90px;
	overflow-y: scroll;
	overflow-x: none;
	width: 170px;
}
</style>
</head>

<body>
  <nav class="navbar navbar-light navbar-expand-md sticky-top navigation-clean-button" style="height: 80px;background-color: #0d7994;color: #fffff0;">
    <div class="container-fluid"><a class="navbar-brand" href="/"><img src="https://img.icons8.com/plasticine/32/ffffff/bus--v2.png"/></i>&nbsp;Om Sai Travels</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav ml-auto" style="background-color: #0d7994;">
                <li class="nav-item"><a class="nav-link" style="color:#fffff0;" href="{{route('gettrip')}}">Trip</a></li>
                <li class="nav-item"><a class="nav-link" style="color:#18e0e0;" href="#">Tour</a></li>
                <li class="nav-item"><a class="nav-link" style="color:#fffff0;" href="{{route('getbushire')}}">Bus HIre</a></li>
            </ul>
        </div>
    </div>
  </nav>

      <div class="container" style="padding-top: 100px;">
        <div class="container mt-2 justify-content-center">
                <div class="row justify-content-center text-center">
                    <div class="col"> <a href="/viewtourbooking">
                        <i class="tim-icons icon-zoom-split"></i>
                        <p><h6>Your Bookings</h6></p>
                    </a></div>
                </div>
                <div class="row  jutify-content-center text-center">
                   <div class="col"> <p class="text-center"><h5>Om Sai Tour Special</h5></p></div>
                </div>
              <div class="row justify-content-center text-center">
                  @foreach($data as $item)
                  <div class="col-md-3 col-sm-6 justify-content-center text-center m-3">
                    <div class="card card-block justify-content-center text-center">
                  <img src="{{asset('storage/tour/'.$item->image)}}" class="img" alt="Photo of sunset">
                      <h5 class="card-title mt-3 mb-3">{{$item->mainattraction}}</h5>
                      <p class="card-text">Total Duration <br>{{$item->day}}/{{$item->night}} Day/Night <br>Start Date {{$item->startdate}} <br>Start Time :{{$item->starttime}}</p> 
                   <br>   <h4 class="card-title text-center"><i class="material-icons">Price :{{$item->price}}</i></h4>
                      <br><br>
                      <div class="col text-center" role="group"><button class="btn btn-info" data-capacity="30" data-price="{{$item->price}}"  data-startingtime="{{$item->starttime}}"  data-startdate="{{$item->startdate}}" data-tid="{{$item->tid}}" data-female="{{json_encode($item->female)}}" data-seat="{{ json_encode($item->male) }}" id="hello"  data-toggle="modal" data-target="#exampleModal" type="button">Select Seat</button></div>
                      <br>
                    </div>
                  </div>
                  @endforeach
              </div>
              
            </div>
            
    
    
    </div>
    <footer class="footer-dark" style="background-image:url('{{asset('/img/map-image.png')}}');">
      <div class="container">
          <div class="row">
              <div class="col-sm-6 col-md-3 item">
                  <h3>List</h3>
                  <ul>
                      <li><a href="#">Stations</a></li>
                      <li><a href="#">Shedules</a></li>
                      <li><a href="#">Routes</a></li>
                  </ul>
              </div>
              <div class="col-sm-6 col-md-3 item">
                  <h3>Details</h3>
                  <ul>
                      <li><a href="#">About Us&nbsp;</a></li>
                      <li><a href="#">Feedback</a></li>
                      <li><a href="#"></a></li>
                  </ul>
              </div>
              <div class="col-md-6 item text">
                  <h3>Om Sai Tours &amp; Travels Pvt. Ltd.</h3>
                  <p>67,Swagat Complex, Kadodara-394327, Tal:Palsana, Dist:Surat</p>
                  <p>Contact No:9727707949</p>
                  <p></p>
              </div>
              <div class="col item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a></div>
          </div>
          <p class="copyright">Om Sai Travel © 2021 <br>Made with Love By Yogesh patil</p>
      </div>

  </footer>
  
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header ">
                <h5 class="modal-title justify-content-center" id="exampleModalLabel">Select Your Seat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body ">
                     <div class="container row d-flex justify-content-center">
                     
                      <div class="row">
                            <div class="column"><div id="seat-map">
                                <div class="front-indicator">Lower</div>
                            </div>
                            </div>
                            <div class="column"><div id="seat-map1">
                                <div class="front-indicator">Upper</div>
                            </div>
                            </div>
                    </div>
                        <div class="booking-details">
                        
                            <div class="column">
                                <h2>Booking Details</h2>
                                <h3> Selected Seats (<span id="counter" name="count"></span>):</h3>
                                <ul id="selected-seats">
                                </ul>
                                Total: <b>$<span id="total">0</span></b>
                            </div>
                            <div class="column" >
                                <p id="legend"></p>
                            </div>   
                        
                        </div>
                        
                         </div>
                         
                </div>
            <div class="modal-footer">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <form action="{{route('gettourform')}}" method="post" >
                @csrf
                <input type="text" name="tid" id="tid" hidden>
                <input type="text" name="seatdata" id="seatdata" hidden>
                <button type="submit" class="btn btn-primary">Proceed &raquo;</button> 
                </form>
           
            </div>
        </div>
    </div>
  </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
 <script>


 </script>
     {{-- <script src="{{asset('js/agency.js')}}"></script> --}}
    <!-- <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>  -->
<script src="{{asset('js/jquery.seat-charts.js')}}"></script> 
<script>
		
            $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var busid=button.data('tid');
            $('#tid').val(busid);
            var price=button.data('price');
            $('#price').val(price);
            $('#counter').empty();
            $('#total').empty();
            $('#selected-seats').empty();
            var id = button.data('seat')
            var fid = button.data('female')
            var capacity=button.data('capacity')
            $('.seatCharts-row').remove();
            $('.seatCharts-legendItem').remove();
            $('#selected-seats').unbind().removeData();
            $('#selected-seats').attr('aria-activedescendant', null);
            $('#seat-map,#seat-map *').unbind().removeData();
            $('#seat-map').attr('aria-activedescendant', null);
            $('#seat-map1,#seat-map1 *').unbind().removeData();
            $('#seat-map1').attr('aria-activedescendant', null);

            var firstSeatLabel = 1; 
            var selectedseats=[];
			var cart = $('#selected-seats'),
					counter = $('#counter'),
                    seatdata=$('#seatdata'),
					$total = $('#total')

                if(capacity==30)
                {
                 
                                var	sc = $('#seat-map').seatCharts({       
                                    map: [
                                'e[1,1]_e[2,2]e[3,3]',
                                'e[4,4]_e[5,5]e[6,6]',
                                'e[7,7]_e[8,8]e[9,9]',
                                'e[10,10]_e[11,11]e[12,12]',
                                'e[13,13]_e[14,14]e[15,15]',
                                    ],
                            seats: {
                                
                                e: {
                                    price   : button.data('price'),
                                    classes : 'economy-class', //your custom CSS class
                                    category: 'Economy Class'
                                }					
                            
                            },
                            naming : {
                                top : false,
                                getLabel : function (character, row, column) {
                                    return firstSeatLabel++;
                                },
                            },
                            legend : {
                                node : $('#legend'),
                                items : [
                                    [ 'f', 'available',   'Available Seats' ],
                                    [ 'e', 'ladies',  'Ladies Booked'],
                                    [ 'f', 'unavailable', 'Gents Booked']
                                ]					
                            },
                            click: function () {
                                if (this.status() == 'available') {
                                    //let's create a new <li> which we'll add to the cart items
                                    
                                    $('<li>'+this.data().category+' Seat # '+this.settings.label+': <b>$'+this.data().price+'</b> <a href="#" class="cancel-cart-item1">[cancel]</a></li>')
                                        .attr('id', 'cart-item-'+this.settings.id)
                                        .data('seatId', this.settings.id)
                                        .appendTo(cart);
                                        selectedseats.push(this.node()[0].id);
                                        console.log(selectedseats);
                                        seatdata.val(selectedseats);
                                    /*
                                    * Lets update the counter and total
                                    *
                                    * .find function will not find the current seat, because it will change its stauts only after return
                                    * 'selected'. This is why we have to add 1 to the length and the current seat price to the total.
                                    */
                                    counter.text(sc.find('selected').length+sc1.find('selected').length+1);
                                    $total.text(recalculateTotal(sc,sc1)+this.data().price);
                                    
                                    return 'selected';
                                } else if (this.status() == 'selected') {
                                    //update the counter
                                    selectedseats.splice(selectedseats.indexOf(this.node()[0].id), 1);
                                    console.log(selectedseats);
                                    seatdata.val(selectedseats);
                                    counter.text(sc.find('selected').length+sc1.find('selected').length-1);
                                    //and total
                                    $total.text(recalculateTotal(sc,sc1)-this.data().price);
                                
                                    //remove the item from our cart
                                    $('#cart-item-'+this.settings.id).remove();
                                
                                    //seat has been vacated
                                    return 'available';
                                } else if (this.status() == 'unavailable') {
                                    //seat has been already booked
                                    return 'unavailable';
                                } else {
                                    return this.style();
                                }
                            }
                        });
                    var	sc1 = $('#seat-map1').seatCharts({
                        
                            map: [
                                'e[16,16]_e[17,17]e[18,18]',
                                'e[19,19]_e[20,20]e[21,21]',
                                'e[22,22]_e[23,23]e[24,24]',
                                'e[25,25]_e[26,26]e[27,27]',
                                'e[28,28]_e[29,29]e[30,30]',
                            ],
                        
                            
                            seats: {
                                
                                e: {
                                    price   : button.data('price'),
                                    classes : 'economy-class', //your custom CSS class
                                    category: 'Economy Class'
                                }					
                            
                            },
                            naming : {
                                top : false,
                                getLabel : function (character, row, column) {
                                    return firstSeatLabel++;
                                },
                            },
                            
                            click: function () {
                                if (this.status() == 'available') {
                                    //let's create a new <li> which we'll add to the cart items
                                    $('<li>'+this.data().category+' Seat # '+this.settings.label+': <b>$'+this.data().price+'</b> <a href="#" class="cancel-cart-item2">[cancel]</a></li>')
                                        .attr('id', 'cart-item-'+this.settings.id)
                                        .data('seatId', this.settings.id)
                                        .appendTo(cart);
                                        selectedseats.push(this.node()[0].id);
                                        console.log(selectedseats);
                                        seatdata.val(selectedseats);
                                    /*
                                    * Lets update the counter and total
                                    *
                                    * .find function will not find the current seat, because it will change its stauts only after return
                                    * 'selected'. This is why we have to add 1 to the length and the current seat price to the total.
                                    */
                                    counter.text(sc1.find('selected').length+sc.find('selected').length+1);
                                    $total.text(recalculateTotal(sc1,sc)+this.data().price);
                                    
                                    return 'selected';
                                } else if (this.status() == 'selected') {
                                    selectedseats.splice(selectedseats.indexOf(this.node()[0].id), 1);
                                    console.log(selectedseats);
                                    seatdata.val(selectedseats);
                                    //update the counter
                                    counter.text(sc1.find('selected').length+sc.find('selected').length-1);
                                    //and total
                                    $total.text(recalculateTotal(sc1,sc)-this.data().price);
                                
                                    //remove the item from our cart
                                    $('#cart-item-'+this.settings.id).remove();
                                
                                    //seat has been vacated
                                    return 'available';
                                } else if (this.status() == 'unavailable') {
                                    //seat has been already booked
                                    return 'unavailable';
                                } else {
                                    return this.style();
                                }
                            }
                        });

                }
                else
                {
                    var		sc = $('#seat-map').seatCharts({
                     
                     map: [
                 'e[1,1]_e[2,2]e[3,3]',
                 'e[4,4]_e[5,5]e[6,6]',
                 'e[7,7]_e[8,8]e[9,9]',
                 'e[10,10]_e[11,11]e[12,12]',
                 'e[13,13]_e[14,14]e[15,15]',
                 'e[16,16]_e[17,17]e[18,18]',
                     ],
             seats: {
                 
                 e: {
                     price   : button.data('price'),
                     classes : 'economy-class', //your custom CSS class
                     category: 'Economy Class'
                 }					
             
             },
             naming : {
                 top : false,
                 getLabel : function (character, row, column) {
                     return firstSeatLabel++;
                 },
             },
             legend : {
                 node : $('#legend'),
                 items : [
                     [ 'f', 'available',   'Available Seats' ],
                     [ 'e', 'ladies',  'Ladies Booked'],
                     [ 'f', 'unavailable', 'Gents Booked']
                 ]					
             },
             click: function () {
                 if (this.status() == 'available') {
      
                     $('<li>'+this.data().category+' Seat # '+this.settings.label+': <b>$'+this.data().price+'</b> <a href="#" class="cancel-cart-item1">[cancel]</a></li>')
                         .attr('id', 'cart-item-'+this.settings.id)
                         .data('seatId', this.settings.id)
                         .appendTo(cart);
                         selectedseats.push(this.node()[0].id);
                         console.log(selectedseats);
                         seatdata.val(selectedseats);
                        counter.text(sc.find('selected').length+sc1.find('selected').length+1);
                        $total.text(recalculateTotal(sc,sc1)+this.data().price);
                     
                     return 'selected';
                 } else if (this.status() == 'selected') {
                     //update the counter
                     selectedseats.splice(selectedseats.indexOf(this.node()[0].id), 1);
                     console.log(selectedseats);
                     seatdata.val(selectedseats);
                     counter.text(sc.find('selected').length+sc1.find('selected').length-1);
                     //and total
                     $total.text(recalculateTotal(sc,sc1)-this.data().price);
                 
                     //remove the item from our cart
                     $('#cart-item-'+this.settings.id).remove();
                 
                     //seat has been vacated
                     return 'available';
                 } else if (this.status() == 'unavailable') {
                     //seat has been already booked
                     return 'unavailable';
                 } else {
                     return this.style();
                 }
             }
         });
     var	sc1 = $('#seat-map1').seatCharts({
           
              map: [
                 
                 'e[19,19]_e[20,20]e[21,21]',
                 'e[22,22]_e[23,23]e[24,24]',
                 'e[25,25]_e[26,26]e[27,27]',
                 'e[28,28]_e[29,29]e[30,30]',
                 'e[31,31]_e[32,32]e[33,33]',
                 'e[34,34]_e[35,35]e[36,36]',
             ],
           
             
             seats: {
                 
                 e: {
                     price   : button.data('price'),
                     classes : 'economy-class', //your custom CSS class
                     category: 'Economy Class'
                 }					
             
             },
             naming : {
                 top : false,
                 getLabel : function (character, row, column) {
                     return firstSeatLabel++;
                 },
             },
             
             click: function () {
                 if (this.status() == 'available') {
                     //let's create a new <li> which we'll add to the cart items
                     $('<li>'+this.data().category+' Seat # '+this.settings.label+': <b>$'+this.data().price+'</b> <a href="#" class="cancel-cart-item2">[cancel]</a></li>')
                         .attr('id', 'cart-item-'+this.settings.id)
                         .data('seatId', this.settings.id)
                         .appendTo(cart);
                         selectedseats.push(this.node()[0].id);
                         console.log(selectedseats);
                         seatdata.val(selectedseats);
                        
                        counter.text(sc1.find('selected').length+sc.find('selected').length+1);
                        $total.text(recalculateTotal(sc1,sc)+this.data().price);
                     
                       return 'selected';
                 } else if (this.status() == 'selected') {
                     selectedseats.splice(selectedseats.indexOf(this.node()[0].id), 1);
                     console.log(selectedseats);
                     seatdata.val(selectedseats);
                     counter.text(sc1.find('selected').length+sc.find('selected').length-1);
                     $total.text(recalculateTotal(sc1,sc)-this.data().price);
                 
                     $('#cart-item-'+this.settings.id).remove();
                 
                     return 'available';
                 } else if (this.status() == 'unavailable') {
                     return 'unavailable';
                 } else {
                     return this.style();
                 }
             }
         });
     }

				$('#selected-seats').on('click', '.cancel-cart-item2', function () {
					sc1.get($(this).parents('li:first').data('seatId')).click();
				});
                $('#selected-seats').on('click', '.cancel-cart-item1', function () {
					sc.get($(this).parents('li:first').data('seatId')).click();
				});

				sc.get(id).status('unavailable');
                sc1.get(id).status('unavailable');
				sc.get(fid).status('ladies');
                sc1.get(fid).status('ladies');
		});

		function recalculateTotal(sc,sc1) {
			var total = 0;
			sc.find('selected').each(function () {
				total += this.data().price;
			});
			sc1.find('selected').each(function () {
				total += this.data().price;
			}); 		
			return total;
		}
		
		</script>
</body>

</html>