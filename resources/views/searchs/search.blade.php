<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4285f4;
            color: #ffffff;
            text-decoration: none;
            border-radius: 50px;
            cursor: pointer;
        }
        .contenaire{
        margin-left: 0;

        }
        input{
            border-radius: 30px;
        }

    </style>
<form action="{{ route('searchs') }}">
    <div class="contenaire">
        <table class="elementcontenaire">
            <input type="text" name="Search" class="form-control" placeholder="Search" value="{{ request()->Search ?? "" }}">
            <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </table>
      </div>
</form>
