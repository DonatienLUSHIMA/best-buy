<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>index</title>
    <style>
        body{
            background: rgb(176, 177, 202);
            font-size: 14px;
        }
        .table{
            width: 100%;
            background-color: white;
            height: 5px;
        }
        .img{
            width: 100px;
        }
        .thead-dark .tbltitle{
            background-color: black;
            height: 25px;
            color: white;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4285f4;
            color: #ffffff;
            text-decoration: none;
            border-radius: 50px;
            cursor: pointer;
        }
        #delete {
            display: inline-block;
            padding: 10px 20px;
            background-color: red;
            color: #ffffff;
            text-decoration: none;
            border-radius: 50px;
            cursor: pointer;
        }
        input{
            max-width: 20%;
        }
        .btn{
            display: inline-block;
            padding: 10px 20px;
            background-color: #4285f4;
            color: #ffffff;
            text-decoration: none;
            border-radius: 50px;
            cursor: pointer;
        }
        .input-group{
            margin-left: 800px;
        }
        /* Ajoutez ce style pour centrer la boîte de dialogue personnalisée */
        #confirmation-dialog {
            display: none;
            text-align: center;
        }
    </style>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- JavaScript code for deletion confirmation -->
    <script>
        $(document).ready(function () {
            $('.delete-marchandise').on('click', function (e) {
                e.preventDefault();

                // Get the marchandise ID from the data attribute
                var marchandiseId = $(this).data('id');

                // Open the custom confirmation dialog
                openConfirmationDialog(function (isConfirmed) {
                    if (isConfirmed) {
                        // Redirect to the destroy route in your AchatController
                        window.location.href = '/marchandises/destroy/' + marchandiseId;
                    } else {
                        // Provide a message if deletion is canceled
                        alert('Deletion canceled!');
                    }
                });
            });

            function openConfirmationDialog(callback) {
                // Initialize the jQuery UI dialog
                $("#confirmation-dialog").dialog({
                    resizable: false,
                    height: "auto",
                    width: 400,
                    modal: true,
                    buttons: {
                        "OK": function () {
                            $(this).dialog("close");
                            callback(true);
                        },
                        "Cancel": function () {
                            $(this).dialog("close");
                            callback(false);
                        }
                    },
                    close: function () {
                        // Clean up after the dialog is closed
                        $(this).dialog("destroy");
                        $(this).remove();
                    }
                });
            }
        });
    </script>
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div>
        <h1>Liste des marchandises</h1>
    </div>
        @include('searchs.search')
        <div id="confirmation-dialog" title="Confirmation">
            <p>Are you sure you want to delete this marchandise?</p>
        </div>

        <div>
            <div>
                <a href="/marchandises/create" class="button">Ajouter une marchandise</a>
                <a href="/marchandises/printlist" class="button">Imprimer la liste</a>
                <a href="{{ route('generatePDF') }}" class="button">Télécharger en PDF</a>
            </div>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Quantité</th>
                        <th>Prix Unitaire</th>
                        <th>Catégorie</th>
                        <th>Date dajout</th>
                        <th>Fournisseur</th>
                        <th>Image</th>
                        <th>Opérations</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marchandises as $marchandise)
                        <tr>
                            <td>{{ $marchandise->id }}</td>
                            <td>{{ $marchandise->name }}</td>
                            <td>{{ $marchandise->quantity }}</td>
                            <td>{{ $marchandise->u_price }}</td>
                            <td>{{ $marchandise->category }}</td>
                            <td>{{ $marchandise->add_date }}</td>
                            <td>{{ $marchandise->fournisseur }}</td>
                            <td>
                                @if ($marchandise->image)
                                    <img src="{{ asset('storage/'.$marchandise->image) }}" style="max-width: 100px; max-height: 100px;">
                                @else
                                    Aucune image disponible
                                @endif
                            </td>
                            <td>
                                <a href="/marchandises/{{ $marchandise->id }}/edit" class="button">Modifier</a>
                                <a href="#" class="delete-marchandise button" data-id="{{ $marchandise->id }}" id="delete">Supprimer</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
</body>
</html>
