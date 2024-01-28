<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login user</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="resources/css/login.css">
</head>
<body><center>
    <div class="contenaire col-lg-offset-3 ">
        <h1 class="text-success">CONNEXION</h1>
        <form action="">
            <div>
                <label>Pseudo</label>
                <input type="text" name="pseudo" placeholder="Pseud......">
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="pseudo" placeholder="Passwodr......">
            </div>
            <button>LOGIN</button>
        </form>
    </div>
</center>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
