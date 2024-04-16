
    <title>Paiement M-Pesa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-container {
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input[type="text"],
        .form-group input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        .form-group input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    @extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Paiement M-PESA</h1>
        <div class="form-container">
            <form action="{{ route('Mpesa.paiement') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="montant">Montant à payer:</label>
                    <input type="number" name="montant" id="montant" required>
                </div>
                <div class="form-group">
                    <label for="numero_telephone">Numéro de téléphone:</label>
                    <input type="text" name="numero_telephone" id="numero_telephone" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Payer">
                </div>
            </form>
        </div>
    </div>
