<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta content='width=device-width, initial-scale=1.0' name='viewport'>
    <title>laravel sample app</title>

    {{ basset_stylesheets( 'jquery', 'application') }}
    {{ basset_javascripts( 'jquery', 'application') }}
  </head>

  <body class="{{ Helper::controllerName() }} {{ Helper::actionName() }}">

    <div id="container">

      <header class="main">
        <h1>Laravel Quickstart</h1>
      </header>

      <nav>
      {{ link_to_route('nodes.index', 'Manage nodes') }} | {{ link_to_route('layouts.index','Manage layouts') }}
      </nav>

      <article class="main">
        @if (Session::has('message'))
          <div class="flash message">
            <p>{{ Session::get('message') }}</p>
          </div>
        @endif

        @yield('content')
      </article>

      <footer class="main">
      </footer>
    </div>

  </body>
</html>
