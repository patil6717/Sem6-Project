<h1><strong>{{$Body}}</strong></h1>
<p>Your Bus Hire Request is Accepted</p>
<br>
<p>From : {{$dest['from']}}</p>
<p>To : {{$dest['to']}}</p>
<br>
<p>Total Km is : {{$km}}</p>
<p>Total Price is : {{$total}}</p>
@foreach ($driver as $item)
    <p>Bus Number : {{$bus[$loop->index]}} </p>
    <p>Driver Name : {{$item->name}} </p>
    <p>Driver Phone no : {{$item->phone}} </p>
@endforeach
<br>
<p><h4>Please Call The Driver Before 30 minutes.</h4></p>
<p><h4>For Cancelation Purpose Please Visit BUshire Section of website</h4></p>