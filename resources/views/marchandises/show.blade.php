<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <td>{{ $marchandise->id}}</td>
        <td>{{ $marchandise->name}}</td>
        <td>{{ $marchandise->quantity }}</td>
        <td>{{ $marchandise->u_price}}</td>
        <td>{{ $marchandise->category}}</td>
        <td>{{ $marchandise->add_date}}</td>
        <td>{{ $marchandise->fournisseur }}</td>
        <td>
        @if ($marchandise->image)
        <img src="{{ asset('storage/'.$marchandise->image) }}" style="max-width: 100%; max-height: 100%;">
    @else
        Aucune image disponible
    @endif</td>
</body>
</html>
