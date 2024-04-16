<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zénith ieformatique</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icone.png') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<style>
    /* Custom CSS for Login Form */
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }

    .container {
        margin-top: 50px;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 40px;
    }

    .card-title {
        font-size: 24px;
        margin-bottom: 30px;
        text-align: center;
    }

    .form-label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 20px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .form-check-input {
        margin-right: 10px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 20px;
        padding: 15px 30px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-link {
        color: #007bff;
        text-decoration: none;
    }

    .btn-link:hover {
        text-decoration: underline;
    }

    i {
        background-color: transparent;
    }
</style>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">@lang('public.Log in')</h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">@lang('public.Email Address')</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">@lang('public.Password')</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" onclick="togglePasswordVisibility()" id="showPasswordCheckbox">
                                <label class="form-check-label" for="showPasswordCheckbox">
                                    @lang('public.Show Password')
                                </label>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                @lang('public.Remember Me')
                            </label>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">@lang('public.Log in')</button>
                            <a href="{{ route('register') }}" class="btn btn-link">@lang('public.Register')</a>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    @lang('public.Forgot Your Password?')
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById('password');
        var checkbox = document.getElementById('showPasswordCheckbox');

        if (checkbox.checked) {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
</script>
</body>
</html>
