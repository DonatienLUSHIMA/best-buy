<!DOCTYPE html>
<html>
<head>
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: rgb(176, 177, 202);
        }

        .card {
            width: 400px;
            top: 50px;
        }

        .card-body {
            background: rgb(215, 226, 247);
            font-weight: bold;
            border-top-right-radius: 50px;
            border-bottom-left-radius: 50px;
        }

        .card {
            width: 400px;
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
            right: 90px;
            top: 53%;
            transform: translateY(-50%);
        }

        .toggle-password1 {
            cursor: pointer;
            position: absolute;
            right: 90px;
            top: 67%;
            transform: translateY(-50%);
        }
    </style>
</head>
<body>
    <center>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.users.update', $user) }}">
                            @csrf
                            @method("PATCH")
                            <h1>Update User</h1>
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')?? $user->name}}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email')?? $user->email }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @foreach ($roles as $role)
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" name="roles[]" value="{{ $role->id }}" id="{{ $role->id }}"
                                        @if($user->roles->pluck('id')->contains($role->id))
                                            checked
                                        @endif
                                    <label for="{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                                </div>
                            @endforeach

                            <div class="row mb-0">
                                <div>
                                    <button type="submit">
                                        {{ __('Register') }}
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
        //display password
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
