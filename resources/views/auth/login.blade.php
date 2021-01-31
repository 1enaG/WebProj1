@extends("layout")

@section("app-title", "ActorsApp")

@section("page-title", "Login")

@section("page-content")
    <form action="{{ route('login') }}" method="POST">
        @csrf

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
        <!-- Remember me --> 
        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input type="checkbox" name="remember" id="remember"
                        class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                    <label  class="form-check-label" for="remember">Remember me</label>
                </div>
            </div>
        </div>

        <!-- Login --> 
        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
               <button type="submit" class="btn btn-primary">Login</button>
               @if(Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
               @endif
            </div>
        </div>   

    </form>
@endsection 