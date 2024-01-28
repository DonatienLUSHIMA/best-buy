<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index</title>
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="text/javascriprt" src="js/jquery-2.2.4.min.js"></script>
    <script src="text/javascriprt" src="js/jquery-2.2.4.min.js"></script>
    <script src="text/javascriprt" src="js/jquery.printPage.js"></script>
</head>
<body>
      <div class="contenaire">
        <div class="col-md-12">
            @yield('content')
        </div>
      </div>

</body>
</html>
