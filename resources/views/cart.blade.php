@extends('app')

@section('content')
  <div class="container carts">
    <h3 class="cart-header">@lang('labels.yourCart')</h3>
    <div class="media cart-media empty">
      <div class="media-left cart-left">
        <a href="#">
          <i class="media-object cart-avatar empty"></i>
        </a>
      </div>
      <div class="media-body">
        <div class="row cart-heading">
          <div class="col-md-8">
            <h4 class="media-heading "></h4>
          </div>
          <div class="col-md-2">@lang('labels.price')</div>
          <div class="col-md-2">@lang('labels.quantity')</div>
        </div>
      </div>
    </div>
    @foreach($records as $record)
      <div class="media cart-media" id="cart-{{$record->id}}">
        <div class="media-left cart-left">
          <a href="#">
            <img src="{{$record->product->avatar}}" alt="" class="media-object cart-avatar">
          </a>
        </div>
        <div class="media-body">
          <div class="row cart-heading">
            <div class="col-md-8">
              <h4 class="media-heading">{{$record->product->name_fr}}</h4>
              @if($record->product->stock < 20)
                <div class="text-small text-danger">@lang('labels.lowStock', ['stock' => $record->product->stock])</div>
              @endif
              <span class="pointer link" onclick="deleteCartRecord('{{$record->id}}')">@lang('labels.delete')</span>
            </div>
            <div class="col-md-2 cart-price">@lang('labels.euro') {{number_format($record->product->price, 2)}}</div>
            <div class="col-md-2">{{$record->quantity}}</div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.min.js"></script>
  <script>
    function deleteCartRecord(recordId) {
      var auth =  $('meta[name=auth]').attr('content');
      if (auth > 0) {
        var url = '/api/carts/' + recordId + '/delete';
        var data = {
          _token: $('meta[name=token]').attr('content'),
          _method: 'DELETE',
          userId: auth
        };

        var cartRecord = $('#cart-' + recordId);
        cartRecord.fadeOut();
        $.post(url, data, function () {
        }).fail(function () {
          cartRecord.fadeIn();
          console.log('delete failed');
        });
      }
    }
  </script>
@endsection