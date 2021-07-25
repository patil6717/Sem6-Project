@extends('layouts.app', ['pageSlug' => 'busmaintanance'])
@section('content')
<div class="content">
    @if(session()->has('success'))
    <div class="col-12 col-md-12">
        <div class="alert alert-success text-center justify-content-center">{{session()->get('success')}}</div>
    </div>
    @endif
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table text-center">
                    <tr><td colspan="6"><button class="btn btn-black" data-toggle="modal" data-target="#examplemodel">Add</button></td></tr>
                    <tr>
                        <td>Sr no.</td>
                        <td>Number</td>
                        <td>From Date</td>
                        <td>To Date</td>
                        <td>Reason</td>
                        <td>Action</td>
                    </tr>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$item->number}}</td>
                        <td>{{$item->fromdate}}</td>
                        <td>{{$item->todate}}</td>
                        <td>{{$item->description}}</td>
                        <td><button type="submit" rel="tooltip" class="btn btn-danger btn-link btn-icon btn-sm" data-toggle="modal" data-target="#deletemodal" data-id="{{$item->bid}}">
                           <i class="tim-icons icon-simple-remove"></i>
                       </button>
                       </td>
                    </tr>    
                    @endforeach
                    
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="examplemodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Bus</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{'savebusmaintain'}}" method="post">
            @csrf
              Number :<input type="text" list="busnumber"class="form-control col-6" name="number" pattern="[0-9]{4}" required>
              <datalist id="busnumber">
                @foreach($bus as $item)
               <option value="{{$item->number}}">
                @endforeach
               </datalist>  
              From Date :<input type="date" class="form-control col-6" name="from" required>
              To Date :<input type="date" class="form-control col-6" name="to"  required>
              Description :<input type="text" class="form-control col-12" name="desc"  required>
              
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Bus</button>
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
          <form action="{{'deletebusmaintain'}}" method="post" class="text-center">
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
  $('#deletemodal').on('show.bs.modal', function (event) {
    ///console.log('hello');
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id= button.data('id')
     // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.id2').val(id)
  });
</script>
@endsection