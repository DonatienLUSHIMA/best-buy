<!DOCTYPE html>
<html>
<head>
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: rgb(176, 177, 202);
        }

        .card-body {
            background: rgb(215, 226, 247);
            font-weight: bold;
            border-top-right-radius: 50px;
            border-bottom-left-radius: 50px;
        }

        .card {
            width: 500px;
            top: 50px;
            border-top-right-radius: 50px;
            border-bottom-left-radius: 50px;
        }

        button {
            display: inline-block;
            padding: 10px 20px;
            color: #ffffff;
            border-radius: 30px;
            cursor: pointer;
            background: blue;
            left: 0;
        }

        .toggle-password {
            cursor: pointer;
            position: absolute;
            right: 30px;
            top: 53%;
            transform: translateY(-50%);
        }

        .toggle-password1 {
            cursor: pointer;
            position: absolute;
            right: 30px;
            top: 67%;
            transform: translateY(-50%);
        }
        #password-confirm .toggle-password1{
            width: 100px;
        }
        @media only screen and (max-width: 600px) and (orientation: portrait) {
            body {
                font-size: 14px;
            }

            .card {

                width: 300px;
                margin-left: 10px;
                margin-right: 10px;
            }

        }
    </style>
</head>
<body>
    <center>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <h1>@lang('public.Register')</h1>
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">@lang('public.Name')</label>
                                <div>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">@lang('public.Email Address')</label>
                                <div>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">@lang('public.Password')</label>
                                <div class="input-group">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <span class="input-group-addon toggle-password" onclick="togglePasswordVisibility('password', 'eye-icon')">
                                        <i id="eye-icon" class="fas fa-eye"></i>
                                    </span>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">@lang('public.Confirm Password')</label>
                                <div class="input-group">
                                    <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                                    <span class="input-group-addon toggle-password1" onclick="togglePasswordVisibility('password-confirm', 'eye-icon1')">
                                        <i id="eye-icon1" class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        @lang('public.Register')
                                    </button>
                                </div>
                            </div>
                                                    </form>
                    </div>
                </div>
            </div>
        </div>
    </center>
    <script>
        function togglePasswordVisibility(passwordFieldId, eyeIconId) {
            var passwordField = document.getElementById(passwordFieldId);
            var eyeIcon = document.getElementById(eyeIconId);

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>


