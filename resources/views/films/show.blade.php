@extends("layout")

@section("app-title")
ActorsApp
@endsection

@section("page-title")
Film Details
@endsection 

@section("page-content")
<div class="text-left">
    <h4>Title: <strong> {{ $film->title }} </strong> </h4>
    <h4>Year: {{ $film->year }}</h4>
    <h4>Genre: {{ $film->genre->genre_name }}</h4>

    <!-- show all actors for this film -->
    @if(count($film->actors) > 0)
    
        <h4>Actors:</h4>
        @foreach($film->actors as $actor)
            <ul>
                <li>{{ $actor->name }}</li>
            </ul>
        @endforeach
    @endif
</div> 
    <a href="/genre/0/films" style="..."
        class="btn btn-outline-info">Back to List</a>

  
@endsection 