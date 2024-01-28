<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marchandises Disponibles</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
    <style>
        body {
            background: white;
        }

        a, button {
            display: inline-block;
            padding: 5px 10px;
            background-color: #4285f4;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .marchandises-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            border: 100px;
        }

        .marchandise {
            text-align: center;
        }

        h2 {
            margin-left: 0;
        }

        .marchandise img {
            max-width: 70%;
            max-height: 100px; /* Ajustez la hauteur maximale selon vos besoins */
        }

        /* Style du bouton panier */
        #panier-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #4285f4;
            color: #ffffff;
            border: none;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative; /* Position relative pour positionner le label */
        }

        #panier-btn i {
            margin-right: 5px;
        }

        #panier-count {
            background-color: red;
            color: white;
            padding: 5px;
            border-radius: 50%;
            position: absolute;
            top: 0;
            right: 0;
        }
        #panier-btn{
            margin-left: 1000px;
            top: 0px;
        }
        @media screen and (max-width: 780px) {
            h2 {
                margin-left: 0; /* Adjust the margin for smaller screens */
            }

            .marchandises-container {
                justify-content: center; /* Center the items on smaller screens */
            }

            #panier-btn {
                margin-left: 20px; /* Adjust the position of the cart button on smaller screens */
            }
        }
    </style>

<body>
    @extends('layouts.app')

    @section('content')

    <div class="container_">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Marchandises Disponibles</h2>
                <div class="marchandises-container">
                    @foreach ($marchandises as $marchandise)
                    <div class="marchandise">
                        @if ($marchandise->image)
                        <img src="{{ asset('storage/' . $marchandise->image) }}" alt="{{ $marchandise->name }}">
                        @else
                        <p>  @lang('public.No image available')</p>
                        @endif
                        <p> {{ $marchandise->name }}</p>
                        <p>Prix : {{ $marchandise->u_price }} €</p>
                        <!-- Bouton détail -->
                        <a href="/marchandises/{{ $marchandise->id }}/detail"> @lang('public.Details')</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>
</html>
