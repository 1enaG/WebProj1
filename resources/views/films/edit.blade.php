@extends("layout")

@section("app-title", "ActorsApp")
@section("page-title", "Edit Film")

@section("page-content") 
<form method="post" action="/genre/{{ $genre_filter_id }}/films/{{ $film->id }}" class="text-left">
    
    @csrf
    {{ method_field("patch") }}
    <div class="form-group">
        @include("includes/input", [
            'fieldId' => 'film-title', 
            'labelText' => 'Title', 
            'placeholderText' => 'Input title', 
            'fieldValue' => $film->title,  
        ])
       
    
    </div>


    
    <div class="form-group">
        @include("includes/input", [
                'fieldId' => 'film-year', 
                'labelText' => 'Year', 
                'placeholderText' => 'Input year', 
                'fieldValue' => $film->year,
            ])
         <!-- validation output: --> 
        
    </div>

    <div class="form-group">
        
        <label for="genre">Genre</label>
        <select name="genre_id" id="genre" class="browser-default custom-select">
            <option disabled selected value="0">Choose genre</option>
            @foreach($genres as $genre)
                
                <option @if($film->genre->id == $genre->id) selected @endif 
                    value="{{ $genre->id }}">{{ $genre->genre_name }}</option> <!-- $film->actor->id looks a bit fishy. Have to get only 1 actor out of many, i guess --> 
                
            @endforeach
        </select>
        
    </div>


           <!-- checkbox section for many-to-many relationship  --> 

            <label for="film_actors[]">Actors:</label>
            <table class="table table-striped table-dark">
        <tr> 
            <th scope="col">Name</th>
            <th scope="col">Checkboxes</th>
            
        </tr>

        @foreach($actors as $actor) 
            <tr>
                <td>{{ $actor->name }}</td>
                <td>
                    <input type="checkbox" value="{{ $actor->id }}" text="{{ $actor->id }}" id="actor" name="film_actors[]" @if(in_array($actor->id, ($film->actors)->pluck('id')->toArray())) 
                        checked 
                    @endif > <!-- I should get an input array from this ... --> 
                </td>
            </tr>
        @endforeach 
        
    </table>


            <!-- end of checkbox section --> 


    
    <button type="submit" class="btn btn-primary float-right">Change</button>

    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
        Delete
    </button>
    
    <div class="clearfix"></div>

    <!-- @if( $errors->any() )
    <div class="row border border-danger rounded text-danger"
            style="margin: 20px; padding: 10px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach 
            </ul>
    </div>
    @endif -->

</form>


<!-- Modal (popup window) -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel"><p>Confirm deleting film</p></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div> 
            <div class="modal-body text-left">
                Delete film {{ $film->title }} ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="delete-film">Delete</button>

            </div>
        </div> 
    </div>
</div>

<script>
    $( document ).ready(function(){
        $("#delete-film").click(function(){
            var id = {!! $film->id !!} ; 
            $.ajax({

                url: '/genre/{{ $genre_filter_id }}/films/'+id,
                type: 'post',
                data: {
                    _method: 'delete',
                    _token: "{!! csrf_token() !!}"
                },
                success: function(msg){
                    location.href="/genre/{{ $genre_filter_id }}/films"; 
                }
            }); 
        }); 
    }); 
</script>
@endsection 
