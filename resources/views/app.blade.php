<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="route" content="{{URL::current()}}">
  <meta name="path" content="{{Request::path()}}">
  <meta name="query" content="{{Request::getQueryString()}}">
  <meta name="lang" content="{{App::getLocale()}}">
  <title>Sousoutake</title>
  <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  @yield('othercss')
  <link rel="stylesheet" href="{{elixir('css/app.css')}}">
  <script>
    window.Laravel = <?php echo json_encode([
      'csrfToken' => csrf_token(),
    ]); ?>
  </script>
</head>
<body>

<div id="app">
  <div class="page-wrap">
    <div class="main-container">
      @include('components.Navbar')
      @yield('content')
    </div>
  </div>
  @include('components.Footer')
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js'></script>
<script src="{{elixir('js/app.js')}}"></script>
@yield('otherjs')

</body>
</html>
