@extends("layout")


@section("app-title")
    ActorsApp
@endsection


@section("page-title", "Admin panel: users")



@section("page-content")
    <a href="/users/create" class="btn btn-outline-success float-left" style="margin-bottom: 10px;">Add user</a> 
    <!-- doesn't lead anywhere yet! --> 

    <table class="table table-striped table-dark">
        <tr> 
            <th scope="col">User name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col"></th>
        </tr>

        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td><a href="/users/{{ $user->id }}"
                        class="btn btn-outline-secondary">Show</a>
                    <a href="/users/{{ $user->id }}/edit"
                        class="btn btn-outline-primary">Edit</a></td>
            </tr>
        @endforeach 
    </table>
@endsection 