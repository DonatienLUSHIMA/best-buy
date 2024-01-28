<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nom+de+la+Police">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            list-style: none;
            font-family: 'Poppins', sans-serif;
        }

        .custom-navbar {
            position: relative;
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: rgb(50, 50, 241);
            overflow-x: hidden;
            padding-top: 20px;
        }

        .custom-navbar a  {
            text-decoration: none;
            font-size: 20px;
            color: white;
            border-radius: 40px;
            background-color: rgb(50, 50, 241);
            margin-left: 5px;
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }

        .custom-navbar a.active {
            background-color: white;
            color: black;
            width: 110%;
        }

        .custom-navbar a:hover {
            background-color: white;
            color: black;
            margin-left: 10px;
        }

        #custom-container {
            margin-left: 250px;
            padding: 20px;
            border-radius: 20px;

        }

        #down {
            position: absolute;

        }

        #down1 {
            background: rgb(50, 50, 241);
            color: white;
            text-decoration: none;
        }

        #title_menu {
            background: rgb(50, 50, 241);
            margin-left: 250px;
            height: 50px;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        #user {
            font-size: 30px;
        }

        #logo {
            font-size: 100px;
            color: white;
        }

        #home {
            width: 100px;
            border-radius:10px 10px 0 0;
          }

        #title_menu a.active {
            background-color: white;
            color: black;
            margin-left: 30px;
            margin-top: 10px;
            height: 110%;
        }

        #title_menu.user-style {
            background: rgb(50, 50, 241);
            margin-left: 0;
        }
        #title_menu.admin-style {
            background: rgb(50, 50, 241);
            margin-left: 250px;
        }
        #custom-container.user-style {
            margin-left: 0;
        }
        #logout {
            margin-top: 1px;
        }

        #panier-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: white;
            font-size: 20px;
            position: absolute;
        }

        #panier-count {
            position: absolute;
            right: 0;
            padding: 5px;
            background: red;
            color: white;
            border-radius: 30%;
        }
        #panier-btn i {
            margin-right: 20px;
        }
        h1{
            font-family: 'Brilliant Student Font';
        }

        @media screen and (max-width: 768px) {

         .navbar{
            padding: 0;
         }
        .nav-links{
           position: absolute;
           background-color: rgba(18, 22, 238, 0.301);
           width: 100%;
           height: 100vh;
           top: 50px;
           justify-content: center;
           align-items: center;
           display: flex;
           color: black;
           backdrop-filter: blur(7px);
           margin-left: -500px;
           transition: all 0.5s ease;


        }
        .nav-links ul{
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 18px;

         }
         .navbar.nav-links ul li{
            margin-top:  45px 0;
         }
         .cart {
            display: flex;
            margin-left: 100%;
            top: 0;
        }

        .cart ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 10px;
        }

        .cart button {
            /* Ajouter des styles supplémentaires au bouton si nécessaire */
        }

        #name-user {
            /* Ajouter des styles supplémentaires au lien si nécessaire */
        }
        .navbar .cart ul li{
            margin: 0 20px;
         }
       }
    }

    .navbar{
        position: absolute;
        padding: 50px;
        display: flex;
        justify-content: space-between;
        margin-left: 40%;
        box-sizing:border-box;
    }
    .navbar a{
        color: white;
        display: flex;


    }
    .navbar .nav-links ul{
        display: flex;

    }
    .navbar .nav-links ul li{
       margin: 0 25px;
    }
    #exit#exit-link{
        width:100px ;
        background: rgb(50, 50, 241);
    }
    .navbar .menu{
        position: absolute;
        font-size: 25px;
        background: rgb(50, 50, 241);
        top: 0;
        color: white;
        border: none;
        margin-left: 4px;


    }
    .mobile-menu{
        margin-left: 0;
    }
    label{
        margin-left: 10px;
    }
        </style>
    </head>
    <body>

        <div id="title_menu" class="@if(Auth::user()->isAdmin()) admin-style @else user-style @endif">
            @can('users')
        <nav class="navbar">
            <div class="nav-links">
                <ul>
                    <li><a href="{{ url('home') }}" class="{{ request()->is('home*') ? 'active' : '' }}" id="home"><i class="fa-solid fa-house"></i>Home</a></li>

                    <li>            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="#" id="logout" onclick="event.preventDefault(); confirmLogout();"><i class="fas fa-sign-out-alt"></i> @lang('public.Log Out')</a>
                    </form></li>
                </ul>
            </div>
        <button class="menu"><i class="fa-solid fa-bars"></i></button>
        <div class="cart">
            <ul>
                <li>
                    <form action="{{ route('Paniers.panier') }}" method="get" id="panier">
                        <button id="panier-btn">
                            <i class="fa fa-shopping-cart"></i>
                            <span id="panier-count">{{ $nombreArticlesDansPanier ?? "0" }}</span>
                        </button>
                    </form>
                </li>
                <li>
                    @auth
                        <a id="name-user" href="#">
                            {{ Auth::user()->name }}
                        </a>
                    @endauth
                </li>
            </ul>
        </div>
        </nav>
            @endcan

            <!-- Shopping cart form -->


        </div>

        @can('manage-users')
        <!-- Admin navigation -->
        <div class="custom-navbar">
            <h1>Donatien</h1>
            <H1>Store</H1>
            <!-- Admin navigation links -->
            <a href="{{ url('/admin/users/homeadmin') }}" class="{{ request()->is('homeadmin*') ? 'active' : '' }}"><i class="fa-solid fa-house"></i><label id="btnhome">@lang('public.Home')</label></a>
            <a href="{{ url('/marchandises/create') }}" class="{{ request()->is('create*') ? 'active' : '' }}"><i class="fa-solid fa-plus"></i><label>@lang('public.Add a product')</label></a>
            <a href="{{ url('/marchandises/index') }}" class="{{ request()->is('detail*') ? 'active' : '' }}"><i class="fas fa-list"></i><label>@lang('public.Details')</label></a>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->is('clients*') ? 'active' : '' }}"> <i class="fas fa-users"></i><label>@lang('public.Clients')</label></a>
            <a href="{{ url('/forms/show-message') }}" class="{{ request()->is('contact*') ? 'active' : '' }}"><i class="fas fa-envelope"></i><label>@lang('public.Messages')</label></a>
            <a href="{{ url('/commandes/list-commande') }}" class="{{ request()->is('contact*') ? 'active' : '' }}"><i class="fas fa-envelope"></i><label>@lang('public.Commandes')</label></a>

            <!-- Logout form for admin -->
            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="#" id="logout" onclick="event.preventDefault(); confirmLogout();"><i class="fas fa-sign-out-alt"></i> @lang('public.Log Out')</a>
            </form>
        </div>
        @endcan

        <div id="custom-container" class="@if(Auth::user()->isAdmin()) admin-style @else user-style @endif">
            <main>
                @yield('content')
            </main>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            var currentUrl = window.location.href;

            $('.custom-navbar a').each(function () {
                if ($(this).attr('href') === currentUrl) {
                    $(this).addClass('active');
                }
            });
        });
        // Initialize the panierCount variable with the actual number of items in the cart
        let panierCount = {{ $nombreArticlesDansPanier ?? 0 }};

        // Function to update the cart count
        function updatePanierCount() {
            document.getElementById('panier-count').textContent = panierCount;
        }

        // Function to show the cart
        function showPanier() {
            // Logic to display the cart
            alert("Show the cart");
        }

        // Function to confirm logout with cart check
        function confirmLogout() {
            // Check if the cart is not empty
            if (panierCount > 0) {
                // If the cart is not empty, ask the user to confirm logout
                var confirmLogout = confirm("You have items in your cart. Are you sure you want to log out?");

                // If the user confirms, proceed with logout
                if (confirmLogout) {
                    document.getElementById('logout-form').submit();
                }
            } else {
                // If the cart is empty, proceed with logout without confirmation
                document.getElementById('logout-form').submit();
            }
        }

        const menu = document.querySelector(".menu")
        const navLinks = document.querySelector(".nav-links")

        menu.addEventListener('click',()=>{
        navLinks.classList.toggle('mobile-menu')
        })

    </script>
    </body>
    </html>


