<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            body{
                background: rgb(176, 177, 202);
            }
            .card{
                width: 400px;
                top:50px;
                border-top-right-radius:50px;
                border-bottom-left-radius: 50px;
            }
            .card-body{
                background: rgb(215, 226, 247);
                font-weight:bold;
                border-top-right-radius:50px;
                border-bottom-left-radius: 50px;
            }
            .card{
                width: 400px;
                top:50px;
            }

            button{
                display: inline-block;
                padding: 10px 30px;
                color: #ffffff;
                border-radius: 30px;
                cursor: pointer;
                background: blue;
                left: 0;
            }
            .card{
                top: 125px;
            }
        </style>
</head>
<body>
   <center>
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h1>Reset Password</h1>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-0 offset-md-0">
                                    <button type="submit">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
    </center>
</body>
</html>
