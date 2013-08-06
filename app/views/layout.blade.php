<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta content='width=device-width, initial-scale=1.0' name='viewport'>
    <title>laravel sample app</title>

    {{ basset_stylesheets('application') }}
  </head>

  <body>
    <h1>Laravel Quickstart</h1>

    @yield('content')
  </body>
</html>
