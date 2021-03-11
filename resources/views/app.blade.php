<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Recycle</title>
      <link rel="icon" href="{{ URL::asset('images/favicon.svg') }}" type="image/x-icon"/>
      <link href="/css/app.css" rel="stylesheet">
   </head>
   <body>
      <div id="root">
         @yield('content')
      </div>
      <script src="/js/app.js"></script>
   </body>
</html>