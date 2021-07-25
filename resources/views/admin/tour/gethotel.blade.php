@extends('layouts.app', ['pageSlug' => 'hotel'])
@section('content')
<div class="content">

    @if (session()->has('deleted'))
        <div class="col-12 col-md-12">
            <div class="alert alert-danger text-center">Deleted!! {{session()->get('deleted')}}</div>
        </div>
    @endif
    @if (session()->has('success'))
    <div class="col-12 col-md-12">
        <div class="alert alert-success text-center">Success!! {{session()->get('success')}}</div>
    </div>
    @endif
    <Div class="col-12 col-md-12">

        <div class="card">
            <div class="card-body">
                <table class="table text-center">
                    <tr><td colspan="4"><button class="btn btn-black" data-toggle="modal" data-target="#exampleModal">Add Hotel</button></td></tr>
             
                    <tr>
                        <td>Sr No.</td>
                        <td>Hotel Name</td>
                        <td>City</td>
                        <td>Action</td>
                    </tr>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$item->hname}}</td>
                            <td>{{$item->sname}}</td>
                            <td><button type="submit" rel="tooltip" class="btn btn-danger btn-link btn-icon btn-sm" data-toggle="modal" data-target="#deletemodal" data-id="{{$item->hid}}">
                               <i class="tim-icons icon-simple-remove"></i>
                           </button></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        {{ $data->links() }}
    </Div>

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Driver</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{'savehotel'}}" method="post">
            @csrf
              Name :<input type="text" class="form-control col-6" name="name" required>
              City :<input type="text" list="station" class="form-control col-6" name="city" required>
            <datalist id="station">
              @foreach ($station as $item1)
              <option value="{{$item1->sid}}">{{$item1->sname}}</option>  
              @endforeach
                
            </datalist>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Driver</button>
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
          <form action="{{'deletehotel'}}" method="post" class="text-center">
            @csrf
            @method('delete')
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
  
     // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.id2').val(id)
  });
  </script>
<style>
  .w-5{
    display: none;
  }
</style>
   
@endsection