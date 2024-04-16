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
            margin-top: 05%;
            margin-right: 500px;
            width: 50%;
        }
        .carousel {
            width: 100%;
            overflow: hidden;
        }

        .carousel img {
            width: 50%;
            height: 50%;
            display: none;
        }

        .carousel img:first-child {
            display: block;
        }
        .Conteairecarousel{
            background-color: rgb(227, 236, 243);
        }
        .footer{
            background-color: blue;
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

                    document.addEventListener('DOMContentLoaded', function () {
                        let currentIndex = 0;
                        const images = document.querySelectorAll('.carousel img');
                        const totalImages = images.length;

                        function showImage(index) {
                            images.forEach((img, i) => {
                                if (i === index) {
                                    img.style.display = 'block';
                                } else {
                                    img.style.display = 'none';
                                }
                            });
                        }

                        function nextImage() {
                            currentIndex = (currentIndex + 1) % totalImages;
                            showImage(currentIndex);
                        }

                        setInterval(nextImage, 4000); // Change d'image toutes les 2 secondes (2000ms)
                    });

                </script>
</center>
<div class="Conteairecarousel">
    <div class="carousel">
        <img src="{{ asset('images/icone.png') }}" alt="Image 1">
        <img src="{{ asset('images/1.png') }}" alt="Image 1">
        <img src="{{ asset('images/2.jpg') }}" alt="Image 2">
        <img src="{{ asset('images/4.jpg') }}" alt="Image 4">
        <img src="{{ asset('images/5.png') }}" alt="Image 5">
        <img src="{{ asset('images/6.jpg') }}" alt="Image 6">
        <img src="{{ asset('images/7.jpg') }}" alt="Image 7">
        <img src="{{ asset('images/8.png') }}" alt="Image 8">
        <img src="{{ asset('images/9.jpg') }}" alt="Image 9">
        <img src="{{ asset('images/10.jpg') }}" alt="Image 10">

        <img  alt="Image 3">
    </div>
</div>

@endsection
