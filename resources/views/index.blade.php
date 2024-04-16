<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icone.png') }}">
    <style>
        body{
            background: rgb(176, 177, 202);
        }
        .img{
            width: 100px;
            height: 25px;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4285f4;
            color: #ffffff;
            text-decoration: none;
            border-radius: 50px;
            cursor: pointer;
        }

        #delete {
            background-color: red;

        }

    </style>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- JavaScript code for deletion confirmation -->
    <script>
        $(document).ready(function () {
            $('.delete-marchandise').on('click', function (e) {
                e.preventDefault();

                // Get the marchandise ID from the data attribute
                var marchandiseId = $(this).data('id');

                // Show a confirmation dialog
                var isConfirmed = confirm('Are you sure you want to delete this marchandise?');

                // If the user confirms, trigger the deletion
                if (isConfirmed) {
                    // Redirect to the destroy route in your AchatController
                    window.location.href = '/marchandises/destroy/' + marchandiseId;
                } else {
                    // Provide a message if deletion is canceled
                    alert('Deletion canceled!');
                }
            });
        });
    </script>
</head>
<body>

    <center>
        <h1> List of goods </h1>
    </center>
    <p>
        <a href="/marchandises/create" class="Add">Ajouter effectuer une vente</a>||<a href="/marchandises/displayM" class="Afficher">Afficher</a>
    </p>
    <center>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead class="table-dark">
                <tr class="tbltitle">
                    <th>N°</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Category</th>
                    <th>Add date</th>
                    <th>Fournissor</th>
                    <th>Image</th>
                    <th><center>Opérations</center></th>
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
                        <td>
                        <center>
                            <a href="/marchandises/{{ $marchandise->id }}/detail">Details</a>|
                            <a href="/marchandises/{{ $marchandise->id }}/edit">Modifier</a> |
                            <a href="#" class="delete-marchandise" data-id="{{ $marchandise->id }}" id="delete">Delete</a>
                        </center>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </center>
</body>
</html>
