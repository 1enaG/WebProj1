@extends("layout")


@section("app-title")
    ActorsApp
@endsection


@section("page-title")
    {{ $pageTitle }}
@endsection


@section("page-content")
    <a href="/actors/create" class="btn btn-outline-success float-left" style="margin-bottom: 10px;">Add actor</a>

    <table class="table table-striped table-dark">
        <tr> 
            <th scope="col">Name</th>
            <th scope="col">Country</th>
            <th scope="col">Year</th>
        </tr>

        @foreach($actors as $actor)
            <tr>
                <td>{{ $actor->name }}</td>
                <td>{{ $actor->country }}</td>
                <td>{{ $actor->year }}</td>
                <td>
                    <a href="/actors/{{ $actor->id }}"
                        class="btn btn-outline-secondary">Show</a>
                    <a href="/actors/{{ $actor->id }}/edit"
                        class="btn btn-outline-primary">Edit</a></td>
            </tr>
        @endforeach 
    </table>
@endsection 