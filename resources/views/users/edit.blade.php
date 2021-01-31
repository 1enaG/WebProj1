@extends("layout")

@section("app-title", "UsersApp")
@section("page-title", "Edit User Details")

@section("page-content") 

<form method="post" action="/users/{{ $user->id }}" class="text-left">
    @csrf
   {{ method_field("patch") }}
    <div class="form-group">
        <label for="user-name">User name</label>
        <input type="text" class="form-control" name="user-name"
                id="user-name" placeholder="Input name" value="{{ $user->name }}">
                <!-- validation output: --> 
         <small class="form-text text-danger">
            <ul>
                @foreach($errors->get('user-name') as $error)
                    <li>{{ $error }}</li>
                @endforeach 
            </ul>
        </small>
    </div>

    <div class="form-group">
        <label for="user-email">Email</label>
        <input type="text" class="form-control" name="user-email" id="user-email" placeholder="email" value="{{ $user->email }}">
        <!-- validation output: --> 
        <small class="form-text text-danger">
            <ul>
                @foreach($errors->get('user-email') as $error)
                    <li>{{ $error }}</li>
                @endforeach 
            </ul>
        </small>
    </div>

    <!-- combo (dropdown) for role (1:n) --> 


      <!-- checkbox section for many-to-many relationship  --> 
      <div class="form-group">
        <label for="user-name">Role</label>
            <input type="text" class="form-control" name="user-role"
                    id="user-role" placeholder="Input role" value="{{ $user->role }}">
                    <!-- validation output: --> 
            <small class="form-text text-danger">
                <ul>
                    @foreach($errors->get('user-role') as $error)
                        <li>{{ $error }}</li>
                    @endforeach 
                </ul>
            </small>
    </div>

     <!-- checkbox section for many-to-many relationship  --> 

     <label for="user_rights[]">Rights:</label> <!-- for ...--> 
    <table class="table table-striped table-dark">
        <tr> 
            <th scope="col">Model</th>
            <th scope="col">Right</th>
            
        </tr>
        <!-- need to pass in an array of userrights for a particular user -->
        @foreach($user->userRights as $userRight) 
            <tr>
                <td>{{ $userRight->model }}</td>
                <td>
                    <input type="text" class="form-control" name="user_rights[{{ $userRight->id }}]"  id="userRight-right" placeholder="right" value="{{ $userRight->right }}">
                </td>
            </tr>
        @endforeach 
        
    </table>


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
                <h5 class="modal-title" id="ModalLabel"><p>Confirm deleting user</p></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div> 
            <div class="modal-body text-left">
                Delete user {{ $user->name }} ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="delete-user">Delete</button>

            </div>
        </div> 
    </div>
</div>
<!-- this stuff doesn't work, i don't know why.--> 
<script>
    $( document ).ready(function(){
        $("#delete-user").click(function(){
            var id = {!! $user->id !!} ; 
            $.ajax({

                url: '/users/'+id,
                type: 'post',
                data: {
                    _method: 'delete',
                    _token: "{!! csrf_token() !!}"
                },
                success: function(msg){
                    location.href="/users"; 
                }
            }); 
        }); 
    }); 
</script>



@endsection 