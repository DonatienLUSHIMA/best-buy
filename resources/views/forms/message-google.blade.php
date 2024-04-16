<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        /* ... Votre style CSS existant ... */
        .user-list {
            display: none;
        }
        #customButton {
            background: rgb(97, 97, 233);
            border-radius: 40px;
            color: white;
            padding: 10px 15px;
            cursor: pointer;

        }
        .btn{
            background: rgb(42, 42, 247);
            border-radius: 40px;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            font-family: 'Bernard MT Condensed', sans-serif;


        }
        textarea{
           font-family: 'Times New Roman', Times, serif;
           font-size: 14px;
           text-indent: 20px;
           padding-left: 20px;
           padding-right: 20px;

        }
        li{
           list-style-type: none;
        }
    </style>
</head>
<body>
    @extends('layouts.app')

    @section('content')
    @if(session()->has('text'))
        <p>{{ session('text') }}</p>
    @endif

    <form action="{{ route('send.message.google') }}" method="POST" enctype="multipart/form-data">
        <label for="title">@lang('public.Title of the message')</label>
        @csrf
        <p>
            <textarea name="title" id="title" cols="100" rows="1"></textarea>
            {{ $errors->first('title', ":title") }}
        </p>
        <label for="message">@lang('public.Message')</label>
        <p>
            <textarea name="message" id="message" cols="100" rows="20" placeholder="@lang('public.Write your message...')"></textarea>
            {{ $errors->first('message', ":message") }}
        </p>
        <label for="recipient">@lang('public.Recipient')</label>
        <p>
            <button type="button" onclick="toggleUserList()">@lang('public.Show User List')</button>
        </p>
        <div class="user-list">
            <input type="checkbox" id="selectAllUsers" onclick="toggleAllUsers(this)">@lang('public.All Users')
            @foreach($users as $user)
            <ul>
                <li>
                    <input type="checkbox" name="recipients[]" value="{{ $user->email }}"> {{ $user->name }}
                </li>
            </ul>
            @endforeach
        </div>
        <br>
        <button type="submit" class="btn">@lang('public.Send')</button>
    </form>

    <script>
        function toggleUserList() {
            var userList = document.querySelector('.user-list');
            userList.style.display = (userList.style.display === 'none') ? 'block' : 'none';
        }


        function toggleAllUsers(checkbox) {
            var checkboxes = document.querySelectorAll('input[name="recipients[]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = !checkbox.checked;
            });
        }
    </script>

    @endsection
</body>
</html>

