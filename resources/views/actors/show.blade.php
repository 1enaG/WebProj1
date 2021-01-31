@extends("layout")

@section("app-title")
ActorsApp 
@endsection

@section("page-title")
Actor Details
@endsection 

@section("page-content")
<div class="text-left">
    <h4>Name: {{ $actor->name }}</h4>
    <h4>Country: {{ $actor->country }}</h4>
    <h4>Year: {{ $actor->year }}</h4>
   

    @if(count($actor->films) > 0 )
        <h4>Credits:</h4>
        @foreach($films as $film)
            <ul>
                <li>{{$film->year}} - {{ $film->title }}</li>
            </ul>
        @endforeach
    @endif 
</div>
    <a href="/actors" style="..."
        class="btn btn-outline-info">Back to List</a>
@endsection 