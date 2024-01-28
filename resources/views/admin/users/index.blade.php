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


</head>
<body>
    @extends('layouts.app')

   @section('content')
   <div>
    <h1 id="title">@lang('public.List of clients')</h1>
   </div>
   <div id="search">
    @include('searchs.search-users')
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
                    <th>@lang('public.Name')</th>
                    <th>@lang('public.Email')</th>
                    <th>@lang('public.Roles')</th>
                    <th>@lang('public.Password')</th>
                    <th>@lang('public.Operations')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ implode(", ", $user->roles()->get()->pluck('name')->toArray()) }}</td>
                        <td>{{ $user->password }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit',$user->id) }}" class="button" id="edit"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method("DELETE")
                            <button type="submit"> <i class="fa-solid fa-trash" id="delete"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
   @endsection
</body>
</html>
