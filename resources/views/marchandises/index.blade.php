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
            background: white;
            font-size: 14px;

        }
        .table{
            width: 100%;
            background-color: white;
            height: 5px;
            overflow-x: auto;
            margin: 0;
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
            background: white;
            color:#4285f4;
            font-size: 30px;
            cursor: pointer;
            margin-right: 25px;
        }
        #delete {
            background: white;
            color:red;
            font-size: 30px;
            cursor: pointer;
        }
        #edit{
            background: white;
            color:#4285f4;
            font-size: 30px;
            cursor: pointer;
            margin-right: 25px;
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
        #confirmation-dialog {
            background-color: #f0f0f0; /* Couleur de fond */
            color: #333; /* Couleur du texte */
        }

        #confirmation-dialog .ui-dialog-buttonset button {
            background-color: #0753ce; /* Couleur du bouton OK */
            color: #480fe4; /* Couleur du texte du bouton OK */
            border: 1px solid #4285f4; /* Bordure du bouton OK */
            border-radius: 5px; /* Bord arrondi du bouton OK */
            margin-right: 5px; /* Marge à droite du bouton OK */
        }

        #confirmation-dialog .ui-dialog-buttonset button.ui-button-cancel {
            background-color: #ccc; /* Couleur du bouton Cancel */
            color: #e40b0b; /* Couleur du texte du bouton Cancel */
            border: 1px solid #ccc; /* Bordure du bouton Cancel */
            border-radius: 5px; /* Bord arrondi du bouton Cancel */
        }
        #confirmation-dialog {
            background: red;
        }
        #title{
            font-family: 'Bernard MT Condensed', sans-serif;
        }


        .pagination-custom {
            margin-top: 20px;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .pagination li {
            margin: 0 5px;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
        }

        .pagination li.active {
            background-color: #007BFF;
            color: #fff;
        }

        .pagination li.disabled {
            color: #ccc;
            cursor: not-allowed;
        }

    </style>

        <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Include jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.delete-marchandise').on('click', function (e) {
                e.preventDefault();
                var marchandiseId = $(this).data('id');
                if (confirm("Are you sure you want to delete this merchandise?")) {
                    window.location.href = '/marchandises/destroy/' + marchandiseId;
                } else {
                    window.location.href = '/marchandises/index';
                }
            });
        });

    $(document).ready(function () {
        $('#search-form input[name="Search"]').on('input', function () {
            $(this).closest('form').submit();
        });

        // Réinitialise le champ de recherche après la soumission du formulaire
        $('#search-form').on('submit', function () {
            var searchInput = $(this).find('input[name="Search"]');
            if (!searchInput.val().trim()) {
                searchInput.prop('disabled', true);
            }
        });
    });
   </script>
</head>
<body>
    @extends('layouts.app')

   @section('content')
   <div class="form">
    <div>
        <h1 id="title">@lang('public.List of goods')</h1>
    </div><div id="search">
        <form id="search-form" action="{{ route('searchs') }}" method="get">
            <div class="input-group mb-3">
                <input type="text" name="Search" placeholder="Search...." class="form-control" value="{{ request()->Search ?? "" }}">
            </div>
        </form>
    </div>
        <div id="confirmation-dialog" title="Confirmation">
            <p>Are you sure you want to delete this marchandise?</p>
        </div>

        <div>
            <div>
                <a href="/marchandises/create" class="button"><i class="fa-solid fa-plus"></i></a>
                <a href="/marchandises/printlist" class="button"><i class="fa-solid fa-print"></i></a>
                <a href="{{ route('generatePDF') }}" class="button"><i class="fa-solid fa-download"></i></a>
            </div>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>@lang('public.No')</th>
                        <th>@lang('public.Name')</th>
                        <th>@lang('public.Quantity')</th>
                        <th>@lang('public.Unit Price')</th>
                        <th>@lang('public.Category')</th>
                        <th>@lang('public.Date of Add')</th>
                        <th>@lang('public.Supplier')</th>
                        <th>@lang('public.Image')</th>
                        <th>@lang('public.Operations')</th>
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
                                <a href="/marchandises/{{ $marchandise->id }}/edit" class="button" id="edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="#" class="delete-marchandise" data-id="{{ $marchandise->id }}" id="delete">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    @endsection
</body>
</html>
