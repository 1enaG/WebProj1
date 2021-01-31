@extends("layout")

@section("app-title", "ActorsApp")

@section("page-title", "Films For Pdf") 

@section("page-content")

    <a href="{{ url('dynamic_pdf/pdf') }}" class="btn btn-warning m-3">Convert to PDF</a>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Year</th>
                
                
            </tr>
        </thead>
        <tbody>
            @foreach($filmsData as $film)
                <tr>
                    <td>{{ $film->title }}</td>
                    <td>{{ $film->year }}</td>
              
                   
                </tr>

            @endforeach 
        </tbody>
    
    </table>



@endsection

