<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css">
    <title>Accueil</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icone.png') }}">
    <style>
            body {
                margin: 0;
                padding: 0;
            }

            @keyframes slideBackground {
                0% {
                    background-position: left top, right top;
                }
                100% {
                    background-position: right top, left top;
                }
            }
            .PS {
                font-family: 'Nunito', sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 200px;
            }

            #Section1, #Section2 {
                padding: 60px;
                margin-right: 20px;
                width: 300px;
                height: 100px;
                background: rgb(179, 177, 177);
            }

            div{
                border-radius: 40px;
            }

            #Section3 {
                background: white;
                margin-top: 20px;
                margin-bottom: 20px;
                width: 100%;
                text-align: center;
                margin-right: 100px;
            }



            #btn {
                text-decoration: none;
                background: #515cf3;
                color: white;
                font-family: 'Times New Roman', Times, serif;
                font-size: 14px;
                padding: 15px;
                border-radius: 20px;
            }

            #Section1 p {
                font-family: 'Times New Roman', Times, serif;
                margin-top: 0;
            }

            #fonctionality {
                display: none;
            }

            .dropbtn {
                background-color: #515cf3;;
                color: white;
                padding: 16px;
                font-size: 16px;
                border: none;
                cursor: pointer;
                border-radius: 20px;
            }

            .dropbtn:hover, .dropbtn:focus {
                background-color: #2980B9;
            }

            .dropdown {
                position: relative;
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f1f1f1;
                min-width: 160px;
                overflow: auto;
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                z-index: 1;
            }

            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }

            .dropdown a:hover {
                background-color: transparent;
            }

            .show {
                display: block;
            }
            @media screen and (max-width: 600px) {
                .PS {
                    flex-direction: column;
                }

                .Part2 {
                    margin-left: 0;
                    margin-top: 20px;
                }

                #Section1, #Section2, #Section3 {
                    width: 100%;
                    margin-right: 0;
                }
                #Section2{
                    margin-top: 10px;

                }
            }
    </style>
</head>
<body class="antialiased">
    <form class="PS">
        <div id="Section1">
            <a href="#" id="About">@lang('public.About')</a>
            <p>
                @lang('public.The application was developed by Donatien LUSHIMA SEKE, a 2nd-year undergraduate student in Information Systems Design')
            </p>
            <p>
                @lang('public.This application allows for online order placement')
            </p>
            <p id="fonctionality">
                @lang('public.Here are some features:

                - Online order placement;
                - Conversation with users;
                - Secure authentication;
                - Account recovery via Gmail;
                - ...')
            </p>
        </div>
        <div id="Section2">
            <a href="#" id="About">@lang('public.Adress')</a>
            <p>
                @lang('public.Our company is located in three cities in the DRC:')<br>
                - Kinshasa;<br>
                - Lubumbashi;<br>
                - Bakavu.
            </p>
        </div>
    </form>
    <form class="Part2">
        <div id="Section3">
            @if (Route::has('login'))
                <div>
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" id="btn">@lang('public.Home')</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" id="btn">@lang('public.Log in')</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline" id="btn">@lang('public.Register')</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </form>
    <center>
        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn" id="selectedLanguageButton">@lang('public.Language')</button>
            <div id="myDropdown" class="dropdown-content">
                <div style="text-align: left;">
                    <div style="margin-bottom: 5px;">
                        <div class="fi fi-fr" style="vertical-align: middle; display: inline-flex;">
                            <a href="#" onclick="selectLanguage('fr', 'Français')" style="margin-left: 10px;">Français</a>
                        </div>
                    </div>
                    <div style="margin-bottom: 5px;">
                        <div class="fi fi-en" style="vertical-align: middle; display: inline-flex;">
                            <a href="#" onclick="selectLanguage('en', 'English')" style="margin-left: 10px;">English</a>
                        </div>
                    </div>
                    <div style="margin-bottom: 5px;">
                        <div class="fi fi-cn" style="vertical-align: middle; display: inline-flex;">
                            <a href="#" onclick="selectLanguage('cn', 'Chinoise')" style="margin-left: 10px;">Chinoise</a>
                        </div>
                    </div>
                    <div style="margin-bottom: 5px;">
                        <div class="fi fi-de" style="vertical-align: middle; display: inline-flex;" id="bouton">
                            <a href="#" onclick="selectLanguage('cd', 'Allemande')" style="margin-left: 10px;">Allemande</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </center>

    <script>
        function selectLanguage(languageCode, languageName) {
            document.getElementById('selectedLanguageButton').innerText = languageName;

            // Appel à la route Laravel pour changer la langue
            fetch('/change-language/' + languageCode)
                .then(response => {
                    if (response.ok) {
                        // Ajoutez ici d'autres actions si nécessaire

                        window.location.reload();
                        console.log('Langue changée avec succès.');
                    } else {
                        console.error('Erreur lors du changement de langue.');
                    }
                })
                .catch(error => {
                    console.error('Erreur lors du changement de langue.', error);
                });

            // Cacher le dropdown
            document.getElementById("myDropdown").classList.remove("show");
        }


        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        window.onclick = function (event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html>
