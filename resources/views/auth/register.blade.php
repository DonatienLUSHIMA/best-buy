<!DOCTYPE html>
<html>
<head>
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zénith ieformatique</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icone.png') }}">
    <style>
 /* Custom CSS for Registration Form */
body {
    background: rgb(176, 177, 202);
    font-family: Arial, sans-serif;
}

.card {
    width: 500px;
    border-top-right-radius: 50px;
    border-bottom-left-radius: 50px;
}

.card-body {
    background: rgb(215, 226, 247);
    font-weight: bold;
    border-top-right-radius: 50px;
    border-bottom-left-radius: 50px;
    padding: 40px;
}

.card-title {
    font-size: 24px;
    margin-bottom: 30px;
    text-align: center;
}

.form-label {
    font-weight: bold;
    margin-bottom: 5px; /* Ajuster la marge inférieure */
}

.form-control {
    border-radius: 20px;
    padding: 12px; /* Réduire le rembourrage */
    margin-bottom: 10px; /* Ajuster la marge inférieure */
}

.input-group {
    position: relative;
}

.toggle-password,
.toggle-password1 {
    cursor: pointer;
    position: absolute;
    right: 30px;
    top: 50%;
    transform: translateY(-50%);
}

.toggle-password1 {
    top: 63%;
}

.btn-primary {
    background-color: blue;
    border: none;
    border-radius: 30px;
    padding: 15px 30px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
    display: inline-block;
}

.btn-primary:hover {
    background-color: darkblue;
}
.profile_photo{
border-radius: 40%


}
@media only screen and (max-width: 600px) and (orientation: portrait) {
    body {
        font-size: 14px;
    }

    .card {
        width: 300px;
        margin-left: auto;
        margin-right: auto;
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
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
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
                                    <span class="input-group-addon toggle-password" id="span" onclick="togglePasswordVisibility('password', 'eye-icon')">
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
                            <div class="mb-3">
                                <label for="profile_photo" class="form-label">@lang('app.public.Profile Photo')</label>
                                <div class="input-group" id="input-photo">
                                    <!-- Input file hidden to trigger file selection -->
                                    <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="form-control @error('profile_photo') is-invalid @enderror" style="display: none;">
                                    <!-- Label containing icon and image -->
                                    <label for="profile_photo" class="input-group-text rounded-circle" style="cursor: pointer; padding: 0; border: none;">
                                        <span id="photo_icon" style="display: block;">
                                            <i class="fas fa-camera" style="font-size: 2rem;"></i>
                                        </span>
                                        <img id="photo_image" src="{{ asset('default_profile_photo.jpg') }}" alt="Profile Photo" style="max-width: 100%; max-height: 100%; display: none;">
                                    </label>
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
        document.getElementById('profile_photo').addEventListener('change', function() {
            var fileInput = document.getElementById('profile_photo');
            var iconSpan = document.getElementById('photo_icon');
            var image = document.getElementById('photo_image');

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    image.src = e.target.result;
                    image.style.display = 'block';
                    iconSpan.style.display = 'none';
                }

                reader.readAsDataURL(fileInput.files[0]);
            } else {
                image.style.display = 'none';
                iconSpan.style.display = 'block';
            }
        });

    </script>
</body>
</html>


