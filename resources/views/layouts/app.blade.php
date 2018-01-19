<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/gardens.css" rel="stylesheet"> 

    <script>
        window.company={!! json_encode(company()) !!}
    </script>
</head>
<body class="body__main">
    <div id="app">
     @include('layouts.nav')
     <div class="container-fluid pt-3">
       @yield('content')
       <flash></flash>

       @include('layouts.footer')
    </div>
   </div>

   <!-- Scripts -->
   <script src="/js/gardens.js"></script>
</body>
</html>
