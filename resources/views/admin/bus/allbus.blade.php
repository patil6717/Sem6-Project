@extends('layouts.app', ['pageSlug' => 'allbus'])
@section('content')
<div class="content">
    @if ($errors->any())
    <div class="alert alert-danger text-center">
        <ul>
            @foreach ($errors->all() as $error)
             Alert !! {{$error}}
            @endforeach
        </ul>
    </div>
    @endif
    @if (session()->has('success'))
        <div class="col-12 col-md-12">
            <div class="alert alert-success text-center">Success !! {{session()->get('success')}}</div>
        </div>
    @endif
    @if (session()->has('delete'))
    <div class="col-12 col-md-12">
        <div class="alert alert-danger text-center">Deleted !! {{session()->get('delete')}}</div>
    </div>
    @endif
    <div class="col-12 col-md-12">
    </div>
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-body">
            <table class="table">
                <tr><td colspan="5"><button class="btn btn-black" data-toggle="modal" data-target="#exampleModal">Add Bus</button></td></tr>
                <tr>
                    <td>Number</td>
                    <td>Capacity</td>
                    <td>Wifi</td>
                    <td>Ac</td>
                    <td>Sleeper</td>
                    <td>Action</td>
                </tr>
       
                @foreach ($data as $item)
                <tr>
                    <td>{{$item->number}}</td>
                    <td>{{$item->capacity}}</td>
                    <td>@if($item->isWifi==1) Yes @else No @endif</td>
                     <td>@if($item->isAc==1) Yes @else No @endif</td>
                  <td>   @if($item->isSleeper==1) Yes @else No @endif</td>
                     <td> 
                         <button type="submit" rel="tooltip" class="btn btn-danger btn-link btn-icon btn-sm" data-toggle="modal" data-target="#deletemodal" data-id="{{$item->did}}" data-name="{{$item->name}}">
                        <i class="tim-icons icon-simple-remove"></i>
                    </button>
                    </td>
                 </tr>
                @endforeach
            </table>
        </div>
       
    </div>
    {{ $data->links() }}
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Bus</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{'savebus'}}" method="post">
            @csrf
              Number :<input type="text" class="form-control col-6" name="number" pattern="[0-9]{4}" required>
             <label for="" class="form-check-label">Capacity :</label><br>  <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="capacity" id="inlineRadio1" value="30">
                <label class="form-check-label" for="inlineRadio1">30</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="capacity" id="inlineRadio2" value="36">
                <label class="form-check-label" for="inlineRadio2">36</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="capacity" id="inlineRadio3" value="40" >
                <label class="form-check-label" for="inlineRadio3">40</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="capacity" id="inlineRadio4" value="50" >
                <label class="form-check-label" for="inlineRadio4">50</label>
              </div>
              <br>
              <br>
              Wifi : <br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="wifi" id="inlineRadio5" value="1">
                <label class="form-check-label" for="inlineRadio5">Yes</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="wifi" id="inlineRadio6" value="0">
                <label class="form-check-label" for="inlineRadio6">No</label>
              </div>
              <br>
              <br>
              
              
              Ac :
              <br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="ac" id="inlineRadio7" value="1">
                <label class="form-check-label" for="inlineRadio7">Yes</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="ac" id="inlineRadio8" value="0">
                <label class="form-check-label" for="inlineRadio8">No</label>
              </div>
        
              
              
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Driver</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{'editdriver'}}" method="post">
            @csrf
            <input type="text" name="id" class="id" hidden>
              City :<input type="text"class="form-control col-6 city" id="city" name="city" required>
              Mobile No : <input type="tel" pattern="[0-9]{10}" id="phone" name="mobileno"class="form-control col-6 phone" required>
              Email : <input type="email" name="email"class="form-control email" id="email" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header"> 
         <h5 class="modal-title" id="exampleModalLabel">Delete Confirm!!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{'deletedriver'}}" method="post" class="text-center">
            @csrf
          Are You Confirm Want To Delete IT!!!
          <input type="text" name="id" class="id2" hidden>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
          <button type="submit" class="btn btn-primary">Yes</button>
        </form>
        </div>
      </div>
    </div>
  </div>
 
    
@endsection

@section('script')
<script type="text/javascript">
  $('#editmodal').on('show.bs.modal', function (event) {
    console.log('hello');
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id= button.data('id')
    var name = button.data('name')
    var city = button.data('city')
    var email = button.data('email')
    var phone = button.data('phone')
     // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('Edit Data Of ' + name.charAt(0).toUpperCase()+name.slice(1))
    modal.find('.city').val(city)
    modal.find('.email').val(email)
    modal.find('.phone').val(phone)
    modal.find('.id').val(id)
  });

  $('#deletemodal').on('show.bs.modal', function (event) {
   
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id= button.data('id')
    var name = button.data('name')
     // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('Delete Data Of ' + name.charAt(0).toUpperCase()+name.slice(1))
    modal.find('.id2').val(id)
  });
  </script>
<style>
  .w-5{
    display: none;
  }
</style>
   
@endsection