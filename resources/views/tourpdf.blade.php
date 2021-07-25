<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tour Ticket(Om Sai Travel)</title>
  </head>
  <body>
    <div><h2>Om Sai Travels</h2></div><div><h5>Please Reach At Agency Office Before 30 Minutes</h5></div>
    <table class="table table-bordered">
            <tr >
            <td class="column "><label for="busnumber">Place :</label><p class="text-center">{{ $data->mainattraction}} </p></td>    
        </tr>
        <tr class="row ">
            <td class="column text-center"><label for="price">Start Date :</label><p class="text-center form-control" >{{ $data->startdate}} </p></td>
                        <td class="column text-center"><label for="price">Start Time :</label><p class="text-center form-control" >{{ $data->starttime}}</p></td>
                    <td class="column"></td>
                      
                    </tr>
        @for ($i = 0; $i < count($data->name); $i++)
        <tr class="row ">
            <td class="column text-center"><label for="index">  Sr No :</label><p class="text-center " >{{($i+1)}} </p>  </td>
            <td class="column"><label for="index">  Seat No :</label> <p class="text-center " >{{($data->seatno[$i])}} </p>  </td>
            <td class="column"><label for="index">  Name :</label>  <p class="text-center " >{{($data->name[$i])}} </p> </td>
            <td class="column"><label for="index">  Age :</label>  <p class="text-center " >{{($data->age[$i])}} </p> </td>
            <td class="column"><label for="index">  Gender :</label>  <p class="text-center" >{{($data->gender[$i])}} </p> </td>
        </tr>
        @endfor
   
    </table>  
            <div class="column"><label for="index">  Phone no :</label> <p class="text-center form-control" >{{$data->phone}}</p></div>
            <div class="column"><label for="index">  Email :</label> <p class="text-center form-control" >{{$data->email}} </p> </div>
            <div class="column"><label for="index">  Total Price :</label> <p class="text-center form-control" >{{ $data->totalprice}} </p></div>
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