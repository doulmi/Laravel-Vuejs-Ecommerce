@extends('app')

@section('content')
  <div class="container">
    <div class="filters" id="filters">
      <a class="filter {{\App\Helper::activeLi('index')}}" href="{{route('index')}}">@lang('labels.products.explore')</a>
      <a class="filter {{\App\Helper::activeLi('index.latest')}}" href="{{route('index.latest')}}">@lang('labels.products.new')</a>
      <a class="filter {{\App\Helper::activeLi('index.popular')}}" href="{{route('index.popular')}}">@lang('labels.products.popular')</a>
    </div>

    <product-list url="{{$url}}"></product-list>
  </div>
@endsection
