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
        @media screen and (max-width: 780px) {
            /* Apply styles for screens with a width of 780px or less */

            .tbl {
                top: 10px;
                width: 100%;
                border-radius: 0; /* Remove border-radius for small screens */
            }

            .img {
                width: 100%;
                height: auto; /* Maintain image aspect ratio */
            }
            .contenaire-detail{
                margin-top: 0;
            }
        }
    </style>
</head>
<body>
    @extends('layouts.app')

@section('content')
<div class="container">
    <div id="AB">
        <div class="contenaire-detail">
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
                            @lang('public.Details')</td>
                    </thead>
                             <tr>
                            <td rowspan="5">
                           <center>
                                @if ($marchandise->image)
                                    <img src="{{ asset('storage/'.$marchandise->image) }}" class="img">
                                @else
                                    @lang('public.No image available')
                                @endif</center>
                            </td>
                             </tr>

                            <tr>
                                <th scope="row" class="clrTr">@lang('public.Name')</th>
                                <td>{{ $marchandise->name}}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="clrTr"> @lang('public.Unite price') </th>
                                <td>{{ $marchandise->u_price}}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="clrTr">@lang('public.Category')</th>
                                <td>{{ $marchandise->category}}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="clrTr">@lang('public.Supplier')</th>
                                <td>{{ $marchandise->fournisseur }}</td>
                            </tr>
                            <tr>

                                <td colspan="3">
                                    <div class="control">
                                            <label for="quantite">Quantity</label>
                                            <input type="number" class="form-control" name="quantite" id="quantite" required maxlength="5" min="1"><br>
                                            <button type="submit" class="ok">Add to cart</button>
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

