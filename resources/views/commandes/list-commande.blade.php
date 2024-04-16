<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Zénith ieformatique</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icone.png') }}">
    <style>
        body{
            background: white;
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

        #delete {
            color: red;
        }
        #title{
            font-family: 'Bernard MT Condensed', sans-serif;
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
            $('.delete-user').on('click', function (e) {
                e.preventDefault();
                var details_commandesId = $(this).data('id');
                if (confirm("Are you sure you want to delete this user ?")) {
                    window.location.href = '/users/destroy/' + details_commandesId;
                } else {
                    window.location.href = '{{ route('listcommande') }}';
                }
            });
        });
    </script>
</head>
<body>
    @extends('layouts.app')

   @section('content')
   <div>
    <h1 id="title">@lang('public.List of orders')</h1>
   </div>
   <div id="search">
    @include('searchs.search')
    </div>
    <div>
        <div>
            <a href="/marchandises/printlist" class="button"><i class="fa-solid fa-print"></i></a>
            <a href="{{ route('generatePDF') }}" class="button"><i class="fa-solid fa-download"></i></a>
        </div>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>@lang('public.No')</th>
                    <th>@lang('public.Order Date')</th>
                    <th>@lang('public.Client ID')</th>
                    <th>@lang('public.Global Price')</th>
                    <th>@lang('public.Operations')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commandes as $commande)
                <tr>
                    <td>{{ $commande->id }}</td>
                    <td>{{ $commande->date_commande }}</td>
                    <td>{{ $commande->user_id}}</td>
                    <td>{{ $commande->total_général }}</td>
                    <td>
                        <a href="/commandes/{{ $commande->id }}/details-commande" class="button" id="edit"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="#" class="delete-user" data-id="{{ $commande->id }}">
                            <i class="fa-solid fa-trash" id="delete"></i>
                        </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
   @endsection
</body>
</html>
