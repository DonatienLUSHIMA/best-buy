<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>--</title>
    <style>
        body{
            background: white;
            font-size:14px;
        }
        table{
            margin-left: 100px;
            background-color: white;
            height: 5px;
        }
        .img{
            width: 100px;


        }
        .table{
           background-color: black;
           color: white;
        }



        .Add .Afficher{
          margin-left: 100%;
        }
         @media print{
            .btn{
                display: none;
            }
            th{
                background: blue;
            }
            title{
                display: none;
            }
         }
         #title{
            font-family: Edwardian Script ITC;
         }
         p{
            font-family: 'Times New Roman', Times, serif;
            font-size: 15px;
            margin-top:-10px;
         }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- JavaScript code for deletion confirmation -->
    <script>
        function printDocument(){
            window.print();
        }
        $(document).ready(function() {
            $('#boutonImprimerPDF').on('click', function() {
                // Utilisez AJAX pour appeler la méthode du contrôleur
                $.ajax({
                    url: '{{ route("marchandises.printlist") }}',
                    method: 'GET',
                    xhrFields: {
                        responseType: 'blob' // Spécifiez que la réponse est un objet Blob
                    },
                    success: function(response) {
                        // Créez un objet URL pour le Blob
                        var blobUrl = URL.createObjectURL(response);

                        // Créez un lien caché pour déclencher le téléchargement
                        var a = document.createElement('a');
                        a.href = blobUrl;
                        a.download = 'nom_du_fichier.pdf';
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);

                        // Révoquez l'URL de l'objet Blob après le téléchargement
                        URL.revokeObjectURL(blobUrl);
                    },
                    error: function(error) {
                        // Gérez les erreurs si nécessaire
                        console.log(error);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <img src="../public/logo.png" alt="">
    <center>
        <p id="title">République Démocratique Du Congo</p>
        <p>Province Du Haut-Katanga</p>
        <p>Ville de Lubumbashi</p>
        <p>Entreprise Donatien LUSHIMA SEKE</p>
        <p>List of the goods dispobles</p>
        <table class="table-bordered">
            <thead class="table">
                <tr class="tbltitle">
                    <th>N°</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Category</th>
                    <th>Add date</th>
                    <th>Fournissor</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody> <!-- Added tbody -->
                @foreach ($marchandises as $marchandise)
                    <tr>
                        <td>{{ $marchandise->id}}</td>
                        <td>{{ $marchandise->name}}</td>
                        <td>{{ $marchandise->quantity }}</td>
                        <td>{{ $marchandise->u_price}}</td>
                        <td>{{ $marchandise->category}}</td>
                        <td>{{ $marchandise->add_date}}</td>
                        <td>{{ $marchandise->fournisseur }}</td>
                        <td class="img"><center>
                            @if ($marchandise->image)
                                <img src="{{ asset('storage/'.$marchandise->image) }}" style="max-width: 100%; max-height: 25%;">
                            @else
                                Aucune image disponible
                            @endif</center>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </center>
        <button class="btn" onclick="printDocument()">Imprimer</button>
</body>
</html>
