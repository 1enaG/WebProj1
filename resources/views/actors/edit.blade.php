@extends("layout")

@section("app-title", "ActorsApp")
@section("page-title", "Edit Actor")

@section("page-content")
<form method="post" action="/actors/{{ $actor->id }}" class="text-left">
    @csrf
   {{ method_field("patch") }}
    <div class="form-group">
        <label for="actor-name">Name</label>
        <input type="text" class="form-control" name="actor-name"
                id="actor-name" placeholder="Input name" value="{{ $actor->name }}">
                <!-- validation output: --> 
         <small class="form-text text-danger">
            <ul>
                @foreach($errors->get('actor-name') as $error)
                    <li>{{ $error }}</li>
                @endforeach 
            </ul>
        </small>
    </div>

    <div class="form-group">
        <label for="actor-country">Country</label>
        <input type="text" class="form-control" name="actor-country" id="actor-country" placeholder="Country" value="{{ $actor->country }}">
        <!-- validation output: --> 
        <small class="form-text text-danger">
            <ul>
                @foreach($errors->get('actor-country') as $error)
                    <li>{{ $error }}</li>
                @endforeach 
            </ul>
        </small>
    </div>

    <div class="form-group">
        <label for="actor-year">Year</label>
        <input type="text" class="form-control" name="actor-year" id="actor-year" placeholder="Year" value="{{ $actor->year }}">
        <!-- validation output: --> 
        <small class="form-text text-danger">
            <ul>
                @foreach($errors->get('actor-year') as $error)
                    <li>{{ $error }}</li>
                @endforeach 
            </ul>
        </small>
    </div>


      <!-- checkbox section for many-to-many relationship  --> 

      <label for="actor_films[]">Films:</label>
            <table class="table table-striped table-dark">
        <tr> 
            <th scope="col">Title</th>
            <th scope="col">Checkboxes</th>
            
        </tr>

        @foreach($films as $film) 
            <tr>
                <td>{{ $film->title }}</td>
                <td>
                
                    <input type="checkbox" value="{{ $film->id }}" text="{{ $film->id }}" id="film" name="actor_films[]" @if(in_array($film->id, ($actor->films)->pluck('id')->toArray())) 
                        checked 
                    @endif > <!-- I should get an input array from this ... --> 
                </td>
            </tr>
        @endforeach 
        
    </table>


            <!-- end of checkbo section   --> 

    <button type="submit" class="btn btn-primary float-right">Change</button>

    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
        Delete
    </button>

</form>  

<!-- Modal (popup window) -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel"><p>Confirm deleting actor</p></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div> 
            <div class="modal-body text-left">
                Delete actor {{ $actor->name }} ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="delete-actor">Delete</button>

            </div>
        </div> 
    </div>
</div>

<script>
    $( document ).ready(function(){
        $("#delete-actor").click(function(){
            var id = {!! $actor->id !!} ; 
            $.ajax({

                url: '/actors/'+id,
                type: 'post',
                data: {
                    _method: 'delete',
                    _token: "{!! csrf_token() !!}"
                },
                success: function(msg){
                    location.href="/actors"; 
                }
            }); 
        }); 
    }); 
</script>


@endsection 

