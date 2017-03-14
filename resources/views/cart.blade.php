@extends('app')

@section('content')
  @foreach($records as $record)
    {{$record->product->name_fr}}
  @endforeach
@endsection

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.min.js"></script>
@endsection