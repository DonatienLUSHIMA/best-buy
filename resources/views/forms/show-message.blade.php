<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            color:#0864f7;
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
        #title{
            font-family: 'Bernard MT Condensed', sans-serif;
        }

        #messagebtn{
            margin-left: 80%;
            margin-top: 0px;

        }
        #messagebtn a {
            text-decoration: none;
            background: blue;
            color:white;
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
            padding: 10px;
            border-radius: 20px;

        }
        .custom-navbar a.active {
            background-color: white;
            color: black;
            width: 110%;
        }

        .custom-navbar a:hover {
            background-color: white;
            color: black;
            width: 110%;
        }

        /*Searchs*/
         .contenaire {
            margin: auto;
            position: relative;
            width: 300px;
            height: 42px;
            border: 4px solid #2980b9;
            padding: 0px 10px;
            border-radius: 50px;
        }
        .elementcontenaire{
        width: 100%;
        height: 100%;
        vertical-align: middle;

        }
        .form-control{
            border: none;
            width: 100%;
            height: 100%;
            padding: 0px 5px;
            border-radius: 50px;
            font-size: 10px;
            font-family: 'Times New Roman', Times, serif;
            color:black;

        }
       .form-control:focus{
        outline: none;
       }
       i{
         font-size: 26;
       }
    </style>
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div>
        <h1 id="title">@lang('public.Messages Sent')</h1>
    </div>
    <div id="search">
        <form id="search-form" action="{{ route('searchs-messages') }}" method="get">
            <div class="contenaire">
                <table class="elementcontenaire">
                    <td>
                <input type="text" name="Search" class="form-control" value="{{ request()->Search ?? "" }}">
                </td>
                <td>
                    <i class="fa-solid fa-magnifying-glass">
                </td>
                </table>
            </div>
        </form>
    </div>
    <div>
        <div id="messagebtn">
            <a href="{{ url('/forms') }}">
                <i class="fas fa-envelope"></i> @lang('public.New Message')
            </a>
        </div><br>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>@lang('public.No')</th>
                    <th>@lang('public.Recipient')</th>
                    <th>@lang('public.Subject')</th>
                    <th>@lang('public.Date and Time of Sending')</th>
                    <th>@lang('public.Operations')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sent_mails as $sent_mail)
                <tr>
                    <td>{{ $sent_mail->id }}</td>
                    <td>{{ $sent_mail->recipients }}</td>
                    <td>{{ $sent_mail->subject }}</td>
                    <td>{{ $sent_mail->body }}</td>
                    <td>{{ $sent_mail->created_at }}</td>
                    <td>
                        <a href="#" class="delete-message" data-id="{{ $sent_mail->id }}">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $sent_mails->links() }}
    </div>

   @endsection
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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
</html>
