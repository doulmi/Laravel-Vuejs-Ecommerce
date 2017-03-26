@extends('app')

@section('content')
  <div class="container carts" id="container">
    <div class="cart-header">@lang('labels.yourCart')</div>
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

    <div id="loadProgress" v-if="isLoading">
      @include('components.LoadProgress')
    </div>

    <div v-for="record in records" id="cartList" v-else>
      <div class="media cart-media" :id="getId(record)">
        <div class="media-left cart-left">
          <a :href="getUrl(record.prodcut)">
            <img :src="record.product.avatar" alt="" class="media-object cart-avatar">
          </a>
        </div>
        <div class="media-body">
          <div class="row cart-heading">
            <div class="col-md-8">
              <h4 class="media-heading">@{{record.product.name}}</h4>
              <div class="text-small text-danger"
                   v-if="record.product.stock > {{config('config.lowStock')}}">
              </div>
              <span class="pointer link text-small"
                    @click.stop.prevent="deleteRecord(record)">@lang('labels.delete')</span>
            </div>

            <div class="col-md-2 cart-price">@lang('labels.euro') @{{ numberFormat.format(record.product.price) }}</div>
            <div class="col-md-2">
              <input type="text" v-model="record.quantity" class="cart-quantity" @change="quantityChange(record)
              " @keydown="quantityKeydown"/>
              <button class="Quantity-btn small increment" id="increment"
                      @click.stop.prevent="increment(record)">+
              </button>
              <button class="Quantity-btn small decrement" id="decrement"
                      @click.stop.prevent="decrement(record)">-
              </button>

              <div class="text-danger">
                @{{record.error}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{--<div class="load-more" v-show="isQuantityModified" @click.stop.prevent="updateQuantity">--}}
    {{--@lang('labels.updateQuantity')--}}
    {{--</div>--}}

    <div class="top2 clearfix">
      <div class="cart-price pull-right">
        <p>
          @lang('labels.euro') @{{ totalPrice }}
        </p>
      </div>
    </div>

    <div class="pull-right"><a href="#" @click.stop.prevent="validCommand"
                               class="Button small Buy-btn">@lang('labels.passCommand')</a></div>
  </div>
  <input type="hidden" id="records" value="{{$records}}"/>
@endsection

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
          integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
          crossorigin="anonymous"></script>
  <script>
    $(function () {
      new Vue({
        el: '#container',
        data: {
          records: {},
          auth: $('meta[name=auth]').attr('content'),
          isLoading: true,
          baseUrl: $('meta[name=baseUrl]').attr('content'),
          numberFormat: null,
        },

        ready: function () {
          this.records = JSON.parse($('#records').val());
          this.records.map(function (record) {
            record.origin_quantity = record.quantity;
          });

          this.numberFormat = new Intl.NumberFormat(["fr-FR"], {
            currency: $('meta[name=currency]').attr('content'),
            minimumFractionDigits: 2,
//            style: "currency",
//            currency: "EURO",
//            currencyDisplay: "symbol",
//            maximumFractionDigit: 1
          });
          this.isLoading = false;
        },

        computed: {
//          isQuantityModified: function () {
//            for (var i = 0; i < records.length; i++) {
//              record = records[i];
//              if (record.origin_quantity != record.quantity) return false;
//            }
//            return true;
//          },

          totalPrice: function () {
            var total = 0;
            this.records.map(function (record) {
              total += record.quantity * record.product.price;
            });
            return this.numberFormat.format(total);
          }
        },

        methods: {
          getId: function (record) {
            return 'record-' + record.id;
          },

//          updateQuantity: function () {
//            var changedRecords = [];
//            this.records.map(function (record) {
//              if (record.quantity != record.origin_quantity) {
//                changedRecords.push(record);
//              }
//            })
//
//            var url = this.baseUrl + '/carts';
//            $.put(url, {records: changedRecords, _token: $('meta[name=token]').attr('content')}, function () {
//
//            });
//          },

          getUrl: function (product) {
            return this.baseUrl + '/products/' + product.slug;
          },

          deleteRecord: function (record) {
            if (this.auth > 0) {
              var url = '/api/carts/' + record.id + '/delete';
              var data = {
                _token: $('meta[name=token]').attr('content'),
                _method: 'DELETE',
                userId: this.auth
              };

              this.records.$remove(record);
              $.post(url, data, function () {
              }).fail(function () {
                this.records.push(record);
                console.log('delete failed');
              }.bind(this));
            }
          },

          increment: function (record) {
            record.quantity++;
          },

          decrement: function (record) {
            record.quantity--;
          },

          quantityKeydown: function (e, record) {
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
          },

          updateQuantity: function(record) {
            console.log('update', record);
//TODO: show mask layer
            var url = '';
            $.post(url, {
              id: record.id,
              quantity: record.quantity,
              _method: 'PUT',
              _token: $('meta[name=token]').attr('content')
            }, function(response) {
              //TODO: hide mask layer
            }).fail(function() {
              //TODO: Show error
              //TODO: hide mask layer
            });
          },

          quantityChange: function (record) {
            var num = parseInt(record.quantity);
            if (isNaN(num) || num < 1) {
              record.quantity = 1;
            } else if (num > record.product.stock) {
              record.quantity = record.product.stock;
              record.error = 'Stock Max: ' + record.product.stock;
            }

            this.updateQuantity(record);
          }
        }
      });
    });
  </script>
@endsection