@extends("layout")

@section("app-title", "ActorsApp")

@section("page-title", "Films List") 

@section("page-content")

    

    <div class="form-group">
        <!-- filter --> 
        <select name="film-genre-filter" id="film-genre-filter" class="browser-default custom-select">
            <option value="0">All genres</option>
            @foreach($genres as $genre)
                <option 
                        @if($genre->id==$genre_filter_id) selected @endif 
                        value="{{ $genre->id }}">
                        {{ $genre->genre_name }}
                </option>
            @endforeach 
        </select>
        <!-- java script fragment --> 
        <script>
            $('#film-genre-filter').change(()=>{
                var id = $('#film-genre-filter').val(); 
                var url = "/genre/"+id+"/films"; 
                location.href = url; 
            }); 
        </script> 

        <!-- end of filter --> 
    </div>

    <a href="/genre/{{ $genre_filter_id }}/films/create" class="btn btn-outline-success float-left"  style="margin-bottom: 10px;">Add film</a>

    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Year</th>
                <th scope="col">Genre</th>
                <th scope="col"></th> <!-- for edit btn etc --> 
                
            </tr>
        </thead>
        <tbody>
            @foreach($films as $film)
                <tr>
                    <td>{{ $film->title }}</td>
                    <td>{{ $film->year }}</td>
                    <td>{{ $film->genre->genre_name }}</td>
                    <td><a href="/genre/{{ $genre_filter_id }}/films/{{ $film->id }}"
                            class="btn btn-outline-secondary">Show</a>

                        <a href="/genre/{{ $genre_filter_id }}/films/{{ $film->id }}/edit"
                            class="btn btn-outline-primary">Edit</a></td>
                </tr>

            @endforeach 
        </tbody>
    
    </table>

@endsection

