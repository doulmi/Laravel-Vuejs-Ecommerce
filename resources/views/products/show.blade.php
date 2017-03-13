@extends('app')

@section('content')
  <input type="hidden" id="likeUrl" value="{{route('actions.like', ['productId' => $product->id])}}">
  <div class="container product-detail-page" id="ProductInfo">
    {{-- product info part --}}
    <div class="product-header">
      <div class="row productInfo">
        {{--image part--}}
        <div class="col-md-6">
          <div class="product-image">
            <img src="{{$product->avatar}}" alt="">
          </div>
        </div>

        {{-- Detail and button part --}}
        <div class="col-md-6">
          <h1 class="ProductInfo-title">{{$product->name}}</h1>

          <div class="ProductInfo-stock"><span>{{$product->stock}}</span> @lang('labels.stockInfo')</div>
          <div class="Button-Container">
            <div class="ProductInfo-price price">€{{$product->price}}</div>
            <div>
              <input type="text" class="ProductInfo-quantity" id="quantity" v-model="quantity" name="quantity"
                     data-max="{{$product->stock}}"/>
              <button class="Quantity-btn increment" id="increment" @click.stop.prevent="increment">+</button>
              <button class="Quantity-btn decrement" id="decrement" @click.stop.prevent="decrement">-</button>
              <a class="Button Buy-btn"
                 @click.stop.prevent="addToPanier('{{$product->id}}')">@lang('labels.addToCart')</a>
            </div>
          </div>


          <div class="Buyers">
            @foreach($buyers as $buyer)
              <img src="{{$buyer->avatar}}" alt="">
            @endforeach
          </div>
        </div>
      </div>

      {{-- actions and buyer --}}
      <div class="row">
        <div class="col-md-6 text-center">
          <span href="#" class="icon like" @click.stop.prevent="like" :class="{active : liked }">
            <i class="fa fa-heart" aria-hidden="true"></i>
            <span>@{{ liked ? "@lang('labels.liked')" : "@lang('labels.like')" }}</span>
            <input type="hidden" id="like" value="{{$product->like}}">
          </span>

          <span href="#" class="icon collect" @click.stop.prevent="collect" :class="{active : collected}">
            <img src="{{asset('images/collect.png')}}">
            <span>@lang('labels.collect')</span>
          </span>
          {{--<a class="icon" id="likeBtn" @click.stop.prevent="like">--}}
          {{--<img src="{{asset('images/heart.png')}}" alt="">--}}
          {{--<span>@lang('labels.like')</span>--}}
          {{--</a>--}}
          {{--<a class="icon" id="collectBtn" @click.stop.prevent="collect" >--}}
          {{-- alt="">--}}
          {{--<span>@lang('labels.collect')</span>--}}
          {{--</a>--}}
        </div>

        <div class="col-md-6 social-share">
          <a class="contact-icon fa fa-facebook"
             href="https://www.facebook.com/sharer/sharer.php?u={{Request::fullUrl()}}" target="_blank"></a>
          <a class="contact-icon fa fa-twitter"
             href="https://twitter.com/intent/tweet?text=Sousoutake&amp;url={{Request::fullUrl()}}&amp;via=http%3A%2F%2Flocalhost%3A8000"
             target="_blank"></a>
          <a class="contact-icon fa fa-google" href="https://plus.google.com/share?url={{Request::fullUrl()}}"
             target="_blank"></a>
          <a class="contact-icon fa fa-pinterest"
             href="//www.pinterest.com/pin/create/button/?url={{Request::fullUrl()}}&media={{$product->avatar}}&description={{$product->name}}"
             target="_blank"></a>
        </div>
      </div>
    </div>

    {{-- relative products part --}}
    <div class="row">
      <div class="Relative-container">
        <div class="Relative-Title">@lang('labels.related')</div>
      </div>
    </div>

    <div class="row">
      <div class="Relative-products">
        @foreach($relativeProducts as $i => $rp)
          <div class="col-sm-5ths ProductPivot">
            <a class="ProductPivot-product hover-overlay-light"
               href="{{route('products.show', $rp->relativeProduct->slug)}}">
              <div class="product-image" style="background-image: url('{{$rp->relativeProduct->avatar}}');">
                {{$rp->relativeProduct->name_fr}}
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>

    {{-- comment parts --}}
    @if(Auth::check())
      {{-- Comment --}}
    @else
      {{-- Should login to leave a comment --}}
    @endif
  </div>
@endsection

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
          integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
          crossorigin="anonymous"></script>
  <script>
    function setCookie(cname, cvalue, exdays) {
      if(exdays == undefined) exdays = 7;
      var d = new Date();
      d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
      var expires = "expires=" + d.toGMTString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
      var name = cname + "=";
      var decodedCookie = decodeURIComponent(document.cookie);
      var ca = decodedCookie.split(';');
      for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
    }

    var quantity = $('#quantity');
    var stock = quantity.data('max');
    new Vue({
      el: 'body',
      data: {
        liked: ($('#like').val() == '1') ? true : false,
        quantity: 1,
        auth: $('meta[name=auth]').attr('content'),
      },

      methods: {
        like: function () {
          var likeUrl = $('#likeUrl').val();

          if (this.auth > 1) {
            var token = $('meta[name=token]').attr("content");
            this.liked = !this.liked;
            $.post(likeUrl, {_token: token}, function (data) {
              //success
            }.bind(this)).fail(function () {
              this.liked = !this.liked;
              console.log('liked failed');
            }.bind(this));
          } else {
            $('#loginModal').modal();
          }
        },

        collect: function () {

        },

        increment: function () {
          var num = parseInt(this.quantity) + 1;
          if (num <= stock) {
            this.quantity = num;
          }
        },

        decrement: function () {
          var num = parseInt(this.quantity) - 1;
          if (num > 0) {
            this.quantity = num;
          }
        },

        addToPanier: function (productId) {
          var cart = getCookie('cart');
          if (cart == '') {
            setCookie('cart', productId + ':' + this.quantity);
            console.log('set cart');
          } else {
            setCookie('cart', cart + '&' + productId + ':' + this.quantity);
            console.log('renew cart');
          }
        }
      }
    });

    $(function () {
      quantity.keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
          // Allow: Ctrl+A, Command+A
          (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
          // Allow: home, end, left, right, down, up
          (e.keyCode >= 35 && e.keyCode <= 40)) {
          // let it happen, don't do anything
          return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
          e.preventDefault();
        }
      });

      quantity.change(function () {
        var num = parseInt(quantity.val());
        if (num < 1) {
          quantity.val(1);
        } else if (num > stock) {
          quantity.val(stock);
        }
      });
    });
  </script>
@endsection