@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="d-flex flex-column">
        <div>
            <label for="title">Название события</label>
            <input id="field-text" type="text" name="title">
        </div>
        <div>
            <label for="description">Описание события</label>
            <input id="field-description" type="text" name="description">
        </div>

        <button class="save-event w-25">Сохранить</button>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        let button = document.getElementsByClassName('save-event')[0];
        button.addEventListener("click", async (event) => {
            const title = document.getElementById('field-text');
            const description = document.getElementById('field-description');
            let response = await saveEvent('/api' + window.location.pathname, {
                title: title.value,
                text: description.value
            });

            if (response.error) {
                alert(response.error);
            } else {
                window.location.reload();
            }
        });


        async function saveEvent(url = "", data) {
            let token = localStorage.getItem('Token');
            const response = await fetch(url, {
                method: "POST",
                mode: "cors",
                cache: "no-cache",
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": "Bearer " + token
                },
                redirect: "follow",
                referrerPolicy: "no-referrer",
                body: JSON.stringify(data)
            });

            return response.json();
        }
    </script>
@stop
