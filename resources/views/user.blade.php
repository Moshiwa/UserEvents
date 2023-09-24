@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="description">
        <div class="d-flex">
            <div class="w-25">Логин:</div>
            <div class="login"></div>
        </div>
        <div class="d-flex">
            <div class="w-25">Дата регистрации:</div>
            <div class="register-date"></div>
        </div>
        <div class="d-flex">
            <div class="w-25">Дата рождения:</div>
            <div class="birth-date"></div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        fill();
        async function fill() {
            let response = await getData('/api' + window.location.pathname)
            let user = response.result;

            let parent = document.getElementsByClassName('content-header')[0];
            parent = parent.getElementsByTagName('h1')[0];
            createElement(user.full_name, parent);

            parent = document.getElementsByClassName('content')[0];
            parent = parent.getElementsByClassName('login')[0];
            createElement(user.login, parent);

            parent = document.getElementsByClassName('content')[0];
            parent = parent.getElementsByClassName('register-date')[0];
            createElement(user.registration_date, parent);

            parent = document.getElementsByClassName('content')[0];
            parent = parent.getElementsByClassName('birth-date')[0];
            createElement(user.birth_date, parent);
        }

        function createElement(value, element)
        {
            const text = document.createTextNode(value);
            element.appendChild(text);
        }

        async function getData(url = "",) {
            let token = localStorage.getItem('Token');
            const response = await fetch(url, {
                method: "GET",
                mode: "cors",
                cache: "no-cache",
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": "Bearer " + token
                },
                redirect: "follow",
                referrerPolicy: "no-referrer",
            });

            return response.json();
        }
    </script>
@stop
