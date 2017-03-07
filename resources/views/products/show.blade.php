@extends('app')

@section('content')
  <div class="container product-detail-page">
    {{-- product info part --}}
    <div class="product-header row">
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
          <a class="Button">@lang('labels.addToCart')</a>
        </div>
      </div>
    </div>

    {{-- actions and buyer --}}
    <div class="row">
      <div class="col-md-6 text-center">
      <span href="" class="icon">
        <img src="{{asset('images/heart.png')}}" alt="">
        <span>@lang('labels.like')</span>
      </span>

        <span href="" class="icon">
        <img src="{{asset('images/collect.png')}}" alt="">
        <span>@lang('labels.collect')</span>
      </span>
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
           href="//www.pinterest.com/pin/create/button/?url={{Request::fullUrl()}}&media={{$product->avatar}}&description={{$product->name}}" target="_blank"></a>
      </div>
    </div>

    {{-- relative products part --}}
    <div class="row">

    </div>

    {{-- comment parts --}}
  </div>
@endsection