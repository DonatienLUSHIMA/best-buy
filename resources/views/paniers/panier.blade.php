   <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
        }

        title {
            background: blue;
        }

        #add {
            margin: 0;
            font-size: 60px;
            color: blue;
        }

        .ok {
            background-color: rgb(21, 173, 21);
            text-decoration: none;
            border-radius: 5px;
            padding: 10px;
            color: #ffffff;
            font-weight: bold;
            font-family: Arial-Rounded-MT-Bold;
        }
        #delete{
            color:red;
            font-size: 18px;
            margin: 0;
        }


        .quantity-buttons button {
            background-color: blue;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        input[name^="quantite["] {
            width: 40px;
            text-align: center;
            padding: 5px;
            font-size: 16px;
        }
        @media screen and (max-width: 780px) {

            .panier {
                margin-left:-1px;

            }

            th,
            td {
                padding: 5px;
                font-size: 8px;
            }

            #add {
                font-size: 10px; /* Ajuster la taille de la police pour les petits écrans */
            }

            .ok {
                padding: 5px; /* Ajuster le padding pour les petits écrans */
                font-size: 14px; /* Ajuster la taille de la police pour les petits écrans */
            }

            .quantity-buttons button {
                padding: 3px; /* Ajuster le padding pour les petits écrans */
                font-size: 12px; /* Ajuster la taille de la police pour les petits écrans */
            }

            input[name^="quantite["] {
                width: 30px; /* Ajuster la largeur pour les petits écrans */
                padding: 3px; /* Ajuster le padding pour les petits écrans */
                font-size: 12px; /* Ajuster la taille de la police pour les petits écrans */
            }
            .img {
                width: 100%;
                height: auto; /* Maintain image aspect ratio */
            }

           .quantity-minus{
            width: 30px;
            background-color: blue;
            font-size: 14px;
            border:none;
           }
           .quantity-plus{
            width: 30px;
            background-color: blue;
            font-size: 14px;
            border:none;
           }

        }
    </style>
    @extends('layouts.app')

@section('content')
    <a href="{{ route('home') }}" id="add"><i class="fa-solid fa-plus"></i></a>
    <center>
        <h2>Produits dans le panier</h2>
        <form action="{{ route('finaliser.commande') }}" method="POST">
            @csrf
            @if($paniers && count($paniers) > 0)
                <table class="panier">
                    <thead id="title">
                        <tr>
                            <th>N°</th>
                            <th>id</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Global price</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paniers as $index => $panier)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $panier['marchandise_id'] }}</td>
                                <td>{{ $panier['marchandise_name'] }}</td>
                                <td>
                                    <button type="button" class="quantity-minus" data-marchandise-id="{{ $panier['marchandise_id'] }}">-</button>
                                    <input type="text" name="quantite[{{ $panier['marchandise_id'] }}]" value="{{ $panier['quantite'] }}" data-marchandise-id="{{ $panier['marchandise_id'] }}" disabled>
                                    <button type="button" class="quantity-plus" data-marchandise-id="{{ $panier['marchandise_id'] }}">+</button>
                                </td>
                                <td id="prix-unitaire-{{ $panier['marchandise_id'] }}">{{ $panier['marchandise_u_price'] }}</td>
                                <td class="prix-global" id="prix-global-{{ $panier['marchandise_id'] }}">{{ $panier['global_price'] }}</td>
                                <td>
                                    @if ($panier['marchandise_image'])
                                        <img src="{{ asset('storage/'.$panier['marchandise_image']) }}" style="max-width: 100px; max-height: 100px;" class="img">
                                    @else
                                        Aucune image disponible
                                    @endif
                                </td>
                                <td >
                                    <a href="{{ route('paniers.destroy', $panier['marchandise_id']) }}">
                                        <i class="fa-solid fa-trash" id="delete"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Le panier est vide.</p>
            @endif

            <div class="total">
                <p>Total général : <span id="total-general">{{ $totalGeneral }}</span></p>
            </div>

            <div>
                <button type="submit" class="ok">Finaliser la commande</button>
            </form>
            </div>
        </center>
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script>
    $(document).ready(function () {
        $('.quantity-plus').on('click', function () {
            var marchandiseId = $(this).data('marchandise-id');
            var input = $('input[name="quantite[' + marchandiseId + ']"]');
            var newQuantite = parseInt(input.val()) + 1;
            input.val(newQuantite);
            input.trigger('input');
        });

        $('.quantity-minus').on('click', function () {
            var marchandiseId = $(this).data('marchandise-id');
            var input = $('input[name="quantite[' + marchandiseId + ']"]');
            var newQuantite = parseInt(input.val()) - 1;
            if (newQuantite < 1) {
                newQuantite = 1;
            }
            input.val(newQuantite);
            input.trigger('input');
        });

        $('input[name^="quantite["]').on('input', function () {
            var marchandiseId = $(this).data('marchandise-id');
            var newQuantite = parseInt($(this).val());
            if (newQuantite < 1) {
                newQuantite = 1;
                $(this).val(1);
            }
            updatePrixGlobal(marchandiseId, newQuantite);
            updateTotalGeneral();
        });

        function updatePrixGlobal(marchandiseId, newQuantite) {
            var prixUnitaire = parseFloat($('#prix-unitaire-' + marchandiseId).text());
            var newPrixGlobal = prixUnitaire * newQuantite;
            $('#prix-global-' + marchandiseId).text(newPrixGlobal.toFixed(2));
        }

        function updateTotalGeneral() {
            var totalGeneral = 0;
            $('.prix-global').each(function () {
                totalGeneral += parseFloat($(this).text()) || 0;
            });
            $('#total-general').text(totalGeneral.toFixed(2));
        }
    });
</script>
