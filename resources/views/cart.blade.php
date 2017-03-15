@extends('app')

@section('content')
  <div class="container carts" id="container">
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
    <div v-for="record in records">
      <div class="media cart-media">
        <div class="media-left cart-left">
          <a href="#">
            <img :src="record.product.avatar" alt="" class="media-object cart-avatar">
          </a>
        </div>
        <div class="media-body">
          <div class="row cart-heading">
            <div class="col-md-8">
              <h4 class="media-heading">@{{record.product.name_fr}}</h4>
              <div class="text-small text-danger"
                   v-if="record.product.stock > {{config('config.lowStock')}}">
                {{--@lang('labels.lowStock', ['stock' => $record->product->stock])--}}
              </div>
              <span class="pointer link text-small" @click.stop.prevent="deleteRecord(record)">@lang('labels.delete')</span>
            </div>
            <div class="col-md-2 cart-price">@lang('labels.euro') @{{ record.product.price }}</div>
            <div class="col-md-2"><input type="text" v-model="record.quantity" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" id="records" value="{{$records}}"/>
@endsection

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.min.js"></script>
  <script>
    new Vue({
      el: '#container',
      data: {
        records: JSON.parse($('#records').val()),
        auth : $('meta[name=auth]').attr('content'),
      },

      methods: {
        deleteRecord(record) {

        }
      }
    });

    function deleteCartRecord(recordId) {
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