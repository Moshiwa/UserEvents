@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="description">
        <div class="text"></div>
        <div class="date"></div>
    </div>
    <div class="members">
        <h2>Участники</h2>
        <div class="list"></div>
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
            let event = response.result;

            let parent = document.getElementsByClassName('content-header')[0];
            parent = parent.getElementsByTagName('h1')[0];
            createElement(event.title, parent);

            parent = document.getElementsByClassName('content')[0];
            parent = parent.getElementsByClassName('text')[0];
            createElement(event.text, parent);

            parent = document.getElementsByClassName('content')[0];
            parent = parent.getElementsByClassName('date')[0];
            createElement(event.date_creation, parent);



            parent = document.getElementsByClassName('content')[0];
            parent = parent.getElementsByClassName('members')[0];
            parent = parent.getElementsByClassName('list')[0];

            event.members.forEach((member) => {
                let item = document.createElement('div');

                let link = document.createElement('a');
                link.setAttribute('href', '/user/' + member.id)
                const text = document.createTextNode(member.full_name);
                link.appendChild(text);

                item.appendChild(link);
                parent.append(item);
            })

        }

        function createElement(value, element)
        {
            const text = document.createTextNode(value);
            element.appendChild(text);
        }

        async function getData(url = "",) {
            const response = await fetch(url, {
                method: "GET",
                mode: "cors",
                cache: "no-cache",
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json",
                },
                redirect: "follow",
                referrerPolicy: "no-referrer",
            });

            return response.json();
        }
    </script>
@stop
