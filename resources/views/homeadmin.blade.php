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
            margin-left: 250px;
        }

        .marchandise img {
            width: 300px;
            height: 200px; /* Ajustez la hauteur maximale selon vos besoins */
        }
    </style>

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
                    <p>Aucune image disponible</p>
                    @endif
                    <p>{{ $marchandise->name }}</p>
                    <p>Prix : {{ $marchandise->u_price }} $</p>
                    <!-- Bouton détail -->
                    <a href="/marchandises/{{ $marchandise->id }}/detail">Détail</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- TODO -->
<!-- /* $marchandises->links() */ -->

@endsection
