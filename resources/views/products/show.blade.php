@extends('app')

@section('content')
  <div class="container product-detail-page">
    {{-- product info part --}}
    <div class="product-header">
      {{--image part--}}
      <div class="col-md-6">
        <div class="product-image">
          <img src="https://res.cloudinary.com/hcu8jcnmr/image/upload/c_fit,w_600,h_600/uhodjniomvtaaolbpbia.jpg"
               alt="">
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

    {{-- relative products part --}}
    <div class="row">

    </div>

    {{-- comment parts --}}
  </div>
@endsection