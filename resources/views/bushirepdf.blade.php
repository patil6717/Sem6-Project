<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trip Ticket(Om Sai Travel)</title>
  </head>
  <body>
    <div><h2>Om Sai Travels</h2></div><div><h5>Please Reach At Agency Office Before 30 Minutes</h5></div>
    <table class="table ">
            <tr>
            <td >From : {{$yo[1]->from}} </td>
            <td >To :   {{$yo[1]['to']}} </td>
        </tr>
       
        <tr>
            <td  >
                Start Date : {{$yo[1]['startdate']}}</td>
            
            <td>Start Time : {{$yo[1]['starttime']}}</td>
        </tr>
      
        <tr>          
            <td >End Date : {{$yo[1]['enddate']}}</td>
            <td >End Time : {{$yo[1]['endtime']}}</td>
        </tr>
        <tr>
            <td> Phone No : {{$yo[1]['phone']}}</td>
            <td> Email Id : {{$yo[1]['email']}}</td>
        </tr>
        <tr>
            <td> Return Trip :
            @if ($yo[1]['return'])
             Yes
            @else
            No
            @endif
            </td>
            <td> Wifi :
                @if ($yo[1]['isWifi'])
                 Yes
                @else
                No
                @endif
                </td>
        
                <td> Ac :
                    @if ($yo[1]['isAc'])
                     Yes
                    @else
                    No
                    @endif
                    </td>            
        </tr>
        @foreach ($yo[0] as $item)
        <tr class="row ">
            <td class="column text-center"><label for="index">  Sr No :</label><p class="text-center " >{{($loop->index+1)}} </p>  </td>
            <td class="column"><label for="index">  Driver Name :</label>  <p class="text-center " >{{($item->drivername)}} </p> </td>
            <td class="column"><label for="index">  Bus Number :</label>  <p class="text-center " >{{($item->number)}} </p> </td>
            <td class="column"><label for="index">  Size :</label> <p class="text-center " >{{($item->size)}} </p>  </td>
            <td class="column"><label for="index">  Driver Phone :</label>  <p class="text-center" >+91 {{($item->driverphone)}} </p> </td>
        </tr>
        
        @endforeach
        <tr class="row">
            <td>Total Km : {{$yo[0][0]->totalkm}}</td>
            <td>Total Price : {{$yo[0][0]->totalprice}}</td>
        </tr>
    </table>
      

         <br>
         <br> 
            Note:
            <ul>
                <li>Ticket Cancelation is Available before 1 hour Only</li>
                <li>Please Pay Total Payment At Agency </li>
                <li>Please Inquire Accurate timing Of Bus</li>
                <li>Please Maintain Safety precaution while Travelling</li>
                <li>If any Query Or problem Is there Feel Free To Contact Particular Agency</li>
                    </ul>
   
  </body>

</body>

</html>