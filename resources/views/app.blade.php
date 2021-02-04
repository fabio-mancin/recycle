<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <!--<meta name="csrf-token" content="{{ csrf_token() }}">-->
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Recycle</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
      <link href="/css/app.css" rel="stylesheet">
   </head>
   <body>
      <div id="root">
         @yield('content')
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
      <script src="/js/app.js"></script>
   </body>
</html>