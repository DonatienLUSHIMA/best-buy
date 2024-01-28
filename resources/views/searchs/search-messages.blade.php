<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .contenaire {
            margin: auto;
            margin-top: 20%;
            position: relative;
            width: 300px;
            height: 42px;
            border: 4px solid #2980b9;
            padding: 0px 10px;
            border-radius: 50px;
        }
        .elementcontenaire{
        width: 100%;
        height: 100%;
        vertical-align: middle;

        }
        .form-control{
            border: none;
            width: 100%;
            height: 100%;
            padding: 0px 5px;
            border-radius: 50px;
            font-size: 10px;
            font-family: 'Times New Roman', Times, serif;
            color:black;

        }
       .form-control:focus{
        outline: none;
       }
       i{
         font-size: 26;
         color: black;
       }
    </style>
    <form id="search-form" action="{{ route('searchs-messages') }}" method="get">
        <div class="contenaire">
            <table class="elementcontenaire">
                <td>
            <input type="text" name="Search" class="form-control" value="{{ request()->Search ?? "" }}">
            </td>
            <td>
                <i class="fa-solid fa-magnifying-glass">
            </td>
            </table>
        </div>
    </form>
