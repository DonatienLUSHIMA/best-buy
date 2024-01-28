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
    .input-group{
       margin-left: 0;

    }

</style>
<form action="{{ route('searchs-users') }}">
    <div class="input-group mb-3">
        <input type="text" name="Search" class="form-control" placeholder="Search" value="{{ request()->Search ?? "" }}">
        <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
      </div>
</form>
