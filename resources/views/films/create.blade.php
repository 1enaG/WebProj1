@extends("layout")

@section("app-title", "ActorsApp")
@section("page-title", "Create Film")

@section("page-content")
<form method="post" action="/genre/{{ $genre_filter_id }}/films" class="text-left">
    {{ csrf_field() }}
    <div class="form-group">
        @include("includes/input", [
            'fieldId' => 'film-title', 
            'labelText' => 'Title', 
            'placeholderText' => 'Input title', 
        ])
         <!-- validation output: --> 
         <small class="form-text text-danger">
            <ul>
                @foreach($errors->get('film-title') as $error)
                    <li>{{ $error }}</li>
                @endforeach 
            </ul>
        </small>
    </div>


    
    <div class="form-group">
        @include("includes/input", [
                'fieldId' => 'film-year', 
                'labelText' => 'Year', 
                'placeholderText' => 'Input year', 
            ])
         <!-- validation output: --> 
         <small class="form-text text-danger">
            <ul>
                @foreach($errors->get('film-year') as $error)
                    <li>{{ $error }}</li>
                @endforeach 
            </ul>
        </small>
    </div>

            
    <div class="form-group">
        
        <label for="genre">Genre</label>
        <select name="genre_id" id="genre" class="browser-default custom-select">
            <option disabled selected value="0">Choose genre</option>
            @foreach($genres as $genre)
                
                <option 
                    value="{{ $genre->id }}">{{ $genre->genre_name }}</option> <!-- $film->actor->id looks a bit fishy. Have to get only 1 actor out of many, i guess --> 
                
            @endforeach
        </select>
        
    </div>
    
    
    <button type="submit" class="btn btn-primary float-right">Add</button>
    
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
@endsection 
