<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>index</title>
    <style>
      body{
         font-size: 14px;
      }
      .table{
        border: 1px solid black;
        border-collapse: collapse;
      }
      td , th, tr{
        border: 1px solid black;
      }
      .tdimage{
        max-width: 25px;
        max-height: 25px;
      }
      .tbltitle{
        font-size: 16px;
        background: silver;
      }
    </style>
</head>
<body>
        <table class="table">
            <thead class="table-dark">
                <tr class="tbltitle">
                    <th>N°</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Category</th>
                    <th>Add date</th>
                    <th>Fournissor</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody> <!-- Added tbody -->
                @foreach ($marchandises as $marchandise)
                    <tr>
                        <td>{{ $marchandise->id}}</td>
                        <td>{{ $marchandise->name}}</td>
                        <td>{{ $marchandise->quantity }}</td>
                        <td>{{ $marchandise->u_price}}</td>
                        <td>{{ $marchandise->category}}</td>
                        <td>{{ $marchandise->add_date}}</td>
                        <td>{{ $marchandise->fournisseur }}</td>
                        <td id="tdimage" style="max-width:100px; max-height:100px"><center>
                            @if ($marchandise->image)
                                <img src="{{ asset('storage/'.$marchandise->image) }}" style="max-width: 100%; max-height: auto;">
                            @else
                                Aucune image disponible
                            @endif</center>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</body>
</html>
