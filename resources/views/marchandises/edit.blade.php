<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Vos balises meta, titre, liens vers les fichiers CSS et JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background: rgb(176, 177, 202);
        }

        .form {
            position: relative;
            background: rgb(215, 226, 247);
            width: 600px;
            margin: 0 auto;
            top: 40px;
            border-top-right-radius:50px;
            border-bottom-left-radius: 50px;
        }

        .form-control {
            width: 40%;
            padding: 0%
        }

        .Cancel {
            display: inline-block;
            padding: 10px 20px;
            color: #ffffff;
            text-decoration: none;
            border-radius: 30px;
            cursor: pointer;
            position: absolute;
            background: red;
            right: 0;
        }

        .success {
            display: inline-block;
            padding: 10px 20px;
            color: #ffffff;
            text-decoration: none;
            border-radius: 30px;
            cursor: pointer;
            background: lime;
            left: 0;
            margin-left: 50px;
        }

        #customFileUpload {
            display: none;
        }

        #customButton {
            background: rgb(97, 97, 233);
            border-radius: 40px;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
        }

        #imagePreview {
            right: 0;
        }
        .lblgrs{
            font-weight: bold;
        }
    </style>
</head>
<body>
    @extends('layouts.app')

    @section('content')
        <div class="form">
            <form action="{{ route('marchandises.update', $marchandise) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <center>
                    <h1 class="lblgrs">@lang('public.Edit Product')</h1>
                    <label for="name" class="lblgrs">@lang('public.Name')</label><br>
                    <input type="text" id="name" name="name" value="{{ old('name', $marchandise->name) }}" required
                        maxlength="50"class="form-control">
                        <label for="quantity"class="lblgrs">@lang('public.Quantity')</label><br>
                    <input type="text" id="quantity" name="quantity" value="{{ old('quantity', $marchandise->quantity) }}"
                        required maxlength="50"class="form-control">
                        <label for="u_price" class="lblgrs">@lang('public.Unit Price')</label><br>
                        <input type="text" id="u_price" name="u_price" value="{{ old('u_price', $marchandise->u_price) }}" required maxlength="50" class="form-control">
                        <label for="category" class="lblgrs">@lang('public.Category')</label><br>
                        <input type="text" id="category" name="category" value="{{ old('category' ,$marchandise->category) }}" required maxlength="50" class="form-control">
                        <label for="fournisseur" class="lblgrs">@lang('public.Date of Add')</label><br>
                        <input type="date" id="add_date" name="add_date" value="{{ old('add_date', $marchandise->add_date) }}" required maxlength="50" class="form-control">
                        <label for="fournisseur" class="lblgrs">@lang('public.Supplier')</label><br>
                        <input type="text" id="fournisseur" name="fournisseur" value="{{ old('fournisseur' ,$marchandise->fournisseur) }}" required maxlength="50" class="form-control">
                    <div>
                        <label for=""class="lblgrs">@lang('public.Image')</label><br>
                        <label for="customFileUpload" id="customButton">@lang('public.Select a file')</label>
                        <input type="file" id="customFileUpload" name="image" accept="image/*" class="btnimg"
                            onchange="previewImage()"><br>
                        @if($marchandise->image)
                            <div id="imagePreview" style="margin-top: 10px;">
                                <img src="{{ asset('storage/'.$marchandise->image) }}"
                                    style="max-width: 100%; max-height: 200px;">
                            </div>
                        @else
                            <div id="imagePreview" style="display: none;">
                                <img id="preview" style="max-width: 100%; max-height: 200px;">
                            </div>
                        @endif
                    </div><br>
                </center>
                <div>
                    <button type="submit" class="success">@lang('public.Save')</button>
                    <button type="submit" class="Cancel">@lang('public.Cancel')</button>
                </div>
            </form>
        </div>
    @endsection
        <script>
            function previewImage() {
                var fileInput = document.getElementById('customFileUpload');
                var imagePreview = document.getElementById('imagePreview');
                var preview = document.getElementById('preview');

                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    }

                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        </script>
</body>
</html>
