@extends("layout")

@section("app-title", "ActorsApp")

@section("page-title", "Registration")

@section("page-content")
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <!-- name --> 
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
            <div class="col-md-6">
                <input name="name" value="{{ old('name') }}" id="name" type="text" 
                class="form-control @error('name') is-valid @enderror"
                required autocomplete="email" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror 
            </div>
        </div>
        

         <!-- email --> 
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
            <div class="col-md-6">
                <input name="email" value="{{ old('email') }}" id="email" type="email" 
                class="form-control @error('email') is-valid @enderror"
                required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror 
            </div>
        </div>
        <!-- password --> 
        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
            <div class="col-md-6">
                <input name="password" id="password" type="password" 
                class="form-control @error('password') is-valid @enderror"
                required autocomplete="current-password" autofocus>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror 
            </div>
        </div>

        <!--confirm password --> 
        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm password</label>
            <div class="col-md-6">
                <input name="password_confirmation" id="password-confirm" type="password" 
                class="form-control"
                required autocomplete="new-password">
            </div>
        </div>

        <!-- Register --> 
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
               <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </div>   

    </form>
@endsection 