<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF_8">
        <title>Zénith ieformatique</title>
        <link rel="icon" type="image/png" href="{{ asset('images/icone.png') }}">
    </head>
    <body style="background:white; padding:30px;">
     <div style="max-width:320px; margin:0 auto; padding:20px; backgroud:blue;">
      <h1>{{ $data['title'] }}</h1>
      <div>{{ $data['message'] }}</div>
     </div>
    </body>
</html>
