@extends("layout")

@section("app-title", "ActorsApp")
@section("page-title", "Create Actor")

@section("page-content")
<form method="post" action="/actors" class="text-left">
    {{ csrf_field() }}
    <div class="form-group">
        @include("includes/input", [
                'fieldId' => 'actor-name', 
                'labelText' => 'Name', 
                'placeholderText' => 'Input name', 
            ])
        <!-- validation output: --> 
         <small class="form-text text-danger">
            <ul>
                @foreach($errors->get('actor-name') as $error)
                    <li>{{ $error }}</li>
                @endforeach 
            </ul>
        </small>
    </div>

    <div class="form-group">
        @include("includes/input", [
                    'fieldId' => 'actor-country', 
                    'labelText' => 'Country', 
                    'placeholderText' => 'Country', 
                ])
        <!-- validation output: --> 
        <small class="form-text text-danger">
            <ul>
                @foreach($errors->get('actor-country') as $error)
                    <li>{{ $error }}</li>
                @endforeach 
            </ul>
        </small>
    </div>

    
    <div class="form-group">
        @include("includes/input", [
                        'fieldId' => 'actor-year', 
                        'labelText' => 'Year', 
                        'placeholderText' => 'Year of birth', 
                    ])
        <!-- validation output: --> 
         <small class="form-text text-danger">
            <ul>
                @foreach($errors->get('actor-year') as $error)
                    <li>{{ $error }}</li>
                @endforeach 
            </ul>
        </small>
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
