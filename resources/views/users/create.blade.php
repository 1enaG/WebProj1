@extends("layout")

@section("app-title", "UsersApp")
@section("page-title", "Create User")

@section("page-content") 

<form method="post" action="/users" class="text-left">
{{ csrf_field() }}
    <div class="form-group">
        <label for="user-name">User name</label>
        <input type="text" class="form-control" name="user-name"
                id="user-name" placeholder="Input name" value="{{ old('user-name') ? old('user-name') : '' }}">
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
        <input type="text" class="form-control" name="user-email" id="user-email" placeholder="email" value="{{ old('user-email') ? old('user-email') : '' }}">
        <!-- validation output: --> 
        <small class="form-text text-danger">
            <ul>
                @foreach($errors->get('user-email') as $error)
                    <li>{{ $error }}</li>
                @endforeach 
            </ul>
        </small>
    </div>

    <div class="form-group">
        <label for="user-email">Password</label>
        <input type="password" class="form-control" name="user-password" id="user-password" placeholder="password" value="">
        <!-- validation output: --> 
        <small class="form-text text-danger">
            <ul>
                @foreach($errors->get('user-password') as $error)
                    <li>{{ $error }}</li>
                @endforeach 
            </ul>
        </small>
    </div>
    <!-- combo (dropdown) for role (1:n) --> 


   
      <div class="form-group">
        <label for="user-role">Role</label>
            <input type="text" class="form-control" name="user-role"
                    id="user-role" placeholder="Input role" value="{{ old('user-role') ? old('user-role') : '' }}">
                    <!-- validation output: --> 
            <small class="form-text text-danger">
                <ul>
                    @foreach($errors->get('user-role') as $error)
                        <li>{{ $error }}</li>
                    @endforeach 
                </ul>
            </small>
    </div>


    <label for="user_rights[]">Rights:</label> <!-- for ...--> 
    <table class="table table-striped table-dark">
        <tr> 
            <th scope="col">Model</th>
            <th scope="col">Right</th>
            
        </tr>
    
        <!-- hardcode it for the moment --> 
        <tr>
            <td>actor</td>
            <td> <!--   user_rights[actor] actually woks without quotes! --> 
                <input type="text" class="form-control" name="user_rights[actor]"  id="right_actor" placeholder="right" value="{{ old('right_actor') ? old('right_actor') : '' }}">
            </td>
        </tr>

        <tr>
            <td>film</td>
            <td>
                <input type="text" class="form-control" name="user_rights[film]"  id="right_film" placeholder="right" value="{{ old('right_film') ? old('right_film') : '' }}">
            </td>
        </tr>

        <tr>
            <td>user</td>
            <td>
                <input type="text" class="form-control" name="user_rights[user]"  id="right_user" placeholder="right" value="{{ old('right_user') ? old('right_user') : '' }}">
            </td>
        </tr>
    
        
    </table>



    <button type="submit" class="btn btn-primary float-right">Add</button>
    
    <div class="clearfix"></div>

</form>  


@endsection 