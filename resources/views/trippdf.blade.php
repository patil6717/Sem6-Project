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
    <table class="table table-bordered">
            <tr >
            <td class="column "><label for="busnumber">Bus Number :</label><p class="text-center">{{ session()->get('number')}} </p></td>    
            <td class="column "  colspan="2"><label for="busnumber">From :</label><p class="text-center">{{ session()->get('starting')}} </p></td>    
            <td class="column " colspan="2"><label for="busnumber">To :</label><p class="text-center ">{{ session()->get('ending')}} </p></td>
        </tr>
        <tr class="row ">
            <td class="column text-center"><label for="price">Starting Date :</label><p class="text-center form-control" >{{ session()->get('date')}} </p></td>
                        <td class="column text-center"><label for="price">Starting Time :</label><p class="text-center form-control" >{{ session()->get('starttime')}} </p></td>
                        <td class="column text-center"><label for="price">Ending Date :</label><p class="text-center form-control" >{{ session()->get('enddate')}} </p></td>
                        <td class="column text-center"><label for="price">End Time :</label><p class="text-center form-control" >{{ session()->get('endtime')}} </p></td>
                    <td class="column"></td>
                      
                    </tr>
        @foreach ($data as $item)
        <tr class="row ">
            <td class="column text-center"><label for="index">  Sr No :</label><p class="text-center " >{{($loop->index+1)}} </p>  </td>
            <td class="column"><label for="index">  Seat No :</label> <p class="text-center " >{{($item->seatno)}} </p>  </td>
            <td class="column"><label for="index">  Name :</label>  <p class="text-center " >{{($item->name)}} </p> </td>
            <td class="column"><label for="index">  Age :</label>  <p class="text-center " >{{($item->age)}} </p> </td>
            <td class="column"><label for="index">  Gender :</label>  <p class="text-center" >{{($item->gender)}} </p> </td>
        </tr>
        @endforeach
    </table>  
            <div class="column"><label for="index">  Phone no :</label> <p class="text-center form-control" >{{ session()->get('phone')}}</p></div>
            <div class="column"><label for="index">  Email :</label> <p class="text-center form-control" >{{ session()->get('email')}} </p> </div>
            <div class="column"><label for="index">  Total Price :</label> <p class="text-center form-control" >{{ session()->get('totalprice')}} </p></div>

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