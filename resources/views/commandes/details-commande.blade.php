<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            background: white;
        }
        thead{
            background-color: #4285f4
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4285f4;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .Cancel {
            position: absolute;
            background-color: red;
            text-decoration: none;
            color: #ffffff;
            font-weight:bold;
            border-radius: 5px;
            text-align: center;
            right: 0;
            font-family:Arial-Rounded-MT-Bold;
        }
        .ok {
            background-color: rgb(21, 173, 21);
            text-decoration: none;
            border-radius: 5px;
            padding: 10px;
            color: #ffffff;
            font-weight:bold;
            font-family:Arial-Rounded-MT-Bold;
        }
        .img{
            width: 250px;
            height: 250px;
        }
        .clrTr{
            background-color: silver
        }
        .tbl{
            border-radius: 10px;
        }
        .control{
            position: relative;
        }
        #quantite{
            width: 80px;
        }
    </style>
</head>
<body>
    @extends('layouts.app')

@section('content')
<br><br><br><br><br><br><br><br>
<div class="container">
    <div class="row justify-content-center" id="AB">
        <div class="col-md-8">
            <center>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form method="post" action="{{ route('savePanier', $marchandise->id) }}">
                    @csrf
                <table border="5px" class="tbl">
                    <thead>
                        <td colspan="3" style="text-align:center">
                        Details</td>
                    </thead>
                            <tr>
                                <th scope="row" class="clrTr">Name</th>
                                <td>{{ $details_commande->id}}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="clrTr">Unite price</th>
                                <td>{{ $details_commande->commande_id }}</td></td>
                            </tr>
                            <tr>
                                <th scope="row" class="clrTr">Category</th>
                                <td>{{ $details_commande->marchandise_id }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="clrTr">Fournisor</th>
                                <td>{{ $details_commande->marchandise_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="clrTr">Fournisor</th>
                                <td>{{ $details_commande->quantite }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="clrTr">Fournisor</th>
                                <td>{{ $details_commande->marchandise_u_price }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="clrTr">Fournisor</th>
                                @if ($details_commande->marchandise_image)
                                <img src="{{ asset('storage/'.$details_commande->marchandise_image) }}" class="img">
                            @else
                                Aucune image disponible
                            @endif</center>
                            </tr>
                            <tr>

                                <td colspan="3">
                                    <div class="control">
                                            <label for="quantite">Quantité</label>
                                            <input type="number" name="quantite" id="quantite" required maxlength="5">
                                            <button type="submit" class="ok">Ajouter au panier</button>
                                    <a href="/marchandises/displayM" class="Cancel">Cancel</a>
                                    </div>
                                </td>
                            </tr>
                    </tbody>
                </table>
                </form>
            </center>
        </div>
    </div>
</div>
@endsection
