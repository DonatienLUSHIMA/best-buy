<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login User</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: rgb(176, 177, 202);
        }

        .card {
            width: 400px;
            top: 50px;
            border-top-right-radius: 50px;
            border-bottom-left-radius: 50px;
        }

        .card-body {
            background: rgb(215, 226, 247);
            font-weight: bold;
            border-top-right-radius: 50px;
            border-bottom-left-radius: 50px;
        }

        button {
            display: inline-block;
            padding: 10px 20px;
            background-color: blue;
            color: #ffffff;
            text-decoration: none;
            border-radius: 50px;
            cursor: pointer;
        }

        .card {
            top: 125px;
        }

        .toggle-password {
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 45%;
            transform: translateY(-50%);
        }

        #btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: blue;
            color: #ffffff;
            text-decoration: none;
            border-radius: 50px;
            cursor: pointer;
        }

    @media screen and (max-width: 768px) {
    .card {
        width: 80%; /* Ajustez selon vos besoins */
        top: 20px; /* Ajustez selon vos besoins */
    }

    .card-body {
        border-top-right-radius: 20px;
        border-bottom-left-radius: 20px;
    }

    .card h1 {
        font-size: 24px;
    }

    .row mb-3 {
        flex-direction: column;
    }

    .toggle-password {
        top: 35%;
    }

    #btn {
        margin-top: 10px;
    }
}

    </style>
</head>
<body>
    <center>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1>@lang('public.Log in')</h1>
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">@lang('public.Email Address')</label>
                        <div class="col-md">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">@lang('public.Password')</label>
                        <div class="col-md input-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            <span class="input-group-addon toggle-password" onclick="togglePasswordVisibility('password')">
                                <i id="eye-icon" class="fas fa-eye"></i>
                            </span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div>
                        <div class="col-md-12 offset-md-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    @lang('public.Remember Me')
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <center>
                            <div>
                                <button type="submit">
                                    @lang('public.Log in')
                                </button>
                                <a href="{{ route('register') }}" id="btn">@lang('public.Register')</a>
                            </div>
                            @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        @lang('public.Forgot Your Password?')
                                    </a>
                                @endif
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </center>
</body>
</html>
