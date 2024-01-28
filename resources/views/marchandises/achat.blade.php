<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            font-family: 'Bernard MT Condensed', sans-serif;
            margin: 0;
            padding-left: 0;
            box-sizing: border-box;
        }

        .navbar {
            position: absolute;
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: rgb(88, 88, 90);
            overflow-x: hidden;
            padding-top: 20px;
        }

        .navbar a {

            text-decoration: none;
            font-size: 25px;
            color: white;
            border-radius: 40px;
            background-color: rgb(88, 88, 90);
            margin-left: 10px;

        }

        .navbar .nav-item {
            margin-top: 5px;
        }

        .navbar .nav-item .nav-link {
            padding: 5px 0;
            position: relative;
        }
        .navbar .nav-item .nav-link.active {
            background-color: rgb(167, 165, 165); /* Couleur de fond lors du clic */
            color: black;
            width: 110%;
            margin-left: 10px;
            text-align: left;
        }


        .navbar .nav-item .nav-link:hover {
            background:rgb(167, 165, 165);
            color: black;
            width: 100%;
            text-align: left;
        }
        .conteneur {
            margin-left: 500px;
            background: red;
        }
    </style>
</head>
<body>
    </div>
        <div class="sidenav">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">Mon Site</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa-solid fa-house"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-info-circle"></i> About
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-list"></i> Detail
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-users"></i> Clients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-envelope"></i> Contact
                            </a>
                        </li>
                        <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <a :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                                        <i class="fas fa-sign-out-alt"></i>
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                    </ul>
                </div>
            </nav>

        </div>
        <div class="sidenav">
            <main>
                @yield('content')
            </main>
        </div>
            </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <script>
            $(document).ready(function(){
                $('.navbar-nav').on('click', 'a', function(){
                    $(".navbar-nav a.active").removeClass('active');
                    $(this).addClass('active');
                });
            });
        </script>

</body>
</html>
