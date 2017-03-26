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
  <meta name="currency" content="EUR">
  <meta name="fullUrl" content="{{Request::fullUrl()}}">
  <meta name="token" content="{{csrf_token()}}">
  <meta name="baseUrl" content="{{url('')}}">
  <meta name="auth" content="{{Auth::check() ? Auth::id() : 0}}">
  <title>Sousoutake</title>
  <link href="https://fonts.googleapis.com/css?family=Old+Standard+TT" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Slab" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
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

<script>
  var logo = $('#logo');
  var goTop = $('#goTop');

  $(document).scroll(function () {
    var scrollTop = $(document).scrollTop();
    var minHeightToChangeLogo = 500;

    if (scrollTop < minHeightToChangeLogo) {
      logo.animate({'margin-top': '0'}, 40);
      goTop.animate({'margin-top': '36px'}, 40);
    } else {
      logo.animate({'margin-top': '-48px'}, 40);
      goTop.animate({'margin-top': '-40px'}, 40);
    }
  });

  goTop.click(function () {
    $("html, body").animate({scrollTop: 0}, "slow");
  });
//
//  function setCookie(cname, cvalue, exdays) {
//    if (exdays == undefined) exdays = 7;
//    var d = new Date();
//    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
//    var expires = "expires=" + d.toGMTString();
//    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
//  }
//
//  function getCookie(cname) {
//    var name = cname + "=";
//    var decodedCookie = decodeURIComponent(document.cookie);
//    var ca = decodedCookie.split(';');
//    for (var i = 0; i < ca.length; i++) {
//      var c = ca[i];
//      while (c.charAt(0) == ' ') {
//        c = c.substring(1);
//      }
//      if (c.indexOf(name) == 0) {
//        return c.substring(name.length, c.length);
//      }
//    }
//    return "";
//  }

  var panier = $('#cart');
  function updateCart(quantity) {
    panier.html(parseInt(panier.html()) + parseInt(quantity));
  }

//  //init panier
//  function initPanier() {
//    var auth = $('meta[name=auth]').attr('content');
//    if(auth > 0) {
//
//    } else {
//      var cart = JSON.parse(getCookie('cart'));
//      var quantity = 0;
//      Object.keys(cart).map(function(key) {
//        quantity += cart[key];
//      });
//      console.log(quantity);
//      updateCart(quantity);
//    }
//  }
//
//  initPanier();
</script>
@yield('js')

</body>
</html>
