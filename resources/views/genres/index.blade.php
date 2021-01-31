@extends("layout")

@section("app-title", "ActorsApp")

@section("page-title", "Genres List") 

@section("page-content")

<table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">Genre</th>
                <th scope="col"></th> <!-- for show films btn --> 
                
            </tr>
        </thead>
        <tbody>
            @foreach($genres as $genre)
                <tr>
                    <td>{{ $genre->genre_name }}</td>
                   
                    <td><a href="/genre/{{ $genre->id }}/films"
                            class="btn btn-outline-primary">Show films</a>

                        </td>
                </tr>

            @endforeach 
        </tbody>
    
    </table>
@endsection 
