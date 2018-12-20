<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/images/footer_logo.png">

    <title>Chat</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
    window.csrf_token = "{{ csrf_token() }}";
    </script>
</head>
<body>
    <div id="app">

    </div>

    <script src="{{ asset('js/admin/app.js') }}"></script>
</body>
</html>
