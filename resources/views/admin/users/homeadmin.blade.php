    <style>
        .numner_user{
            width: 300px;
            height: 100px;
            border-radius: 10%;
            background: blue;
            color: white;
            text-align: center;

        }
        .numner_goods{
            width: 300px;
            height: 100px;
            margin-left: 10px;
            border-radius: 10%;
            background: blue;
            color: white;
            text-align: center;

        }
        .numner_cmd{
            width: 300px;
            height: 100px;
            margin-left: 10px;
            border-radius: 10%;
            background: blue;
            color: white;
            text-align: center;

        }
        h2{
            margin-top: 10px;
        }
        .container{
            display: flex;

        }
        .number{
            font-size: 36px;
        }
        #graphique{
            margin-top: 10%;
            margin-right: 500px;
            width: 50%;
        }

    </style>

@extends('layouts.app')

@section('content')
<center>
    <div class="container">
                <div class="numner_user" >
                    <h2>@lang('public.Number of users')</h2>
                    <div class="number">{{ $userCount }}</div>
                </div>
                <div class="numner_goods">
                    <h2>@lang('public.Number of goods')</h2>
                    <div class="number">{{ $marchandiseCount }}</div>
                </div>
                <div class="numner_cmd">
                    <h2>@lang('public.Number of orders')</h2>
                    <div class="number">{{ $commandeCount }}</div>
                </div>
            </div>
                <div id="graphique">
                    <canvas id="myChart"></canvas>
                </div>

                <script src="{{ asset('js/Chart.min.js') }}"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var ctx = document.getElementById('myChart').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            options: {
                                scales: {
                                    y: {
                                        stacked: true
                                    }
                                }
                            },
                            data: @json($chartData),
                        });
                    });
                </script>
</center>
@endsection
