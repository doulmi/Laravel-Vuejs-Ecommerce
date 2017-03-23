<template>
  <div class="container carts" id="container">
    <div class="cart-header">{{getN18('yourCart')}}</div>
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
          <div class="col-md-2">{{getN18('price')}}</div>
          <div class="col-md-2">{{getN18('quantity')}}</div>
        </div>
      </div>
    </div>

    <div v-if="isLoading">
      <LoadProgress/>
    </div>

    <div v-for="record in records" id="cartList">
      <div class="media cart-media">
        <div class="media-left cart-left">
          <a :href="getUrl(record.prodcut)">
            <img :src="record.product.avatar" alt="" class="media-object cart-avatar">
          </a>
        </div>
        <div class="media-body">
          <div class="row cart-heading">
            <div class="col-md-8">
              <h4 class="media-heading">{{record.product.name}}</h4>
              <div class="text-small text-danger"
                   v-if="record.product.stock > {{config('config.lowStock')}}">
              </div>
              <span class="pointer link text-small"
                    @click.stop.prevent="deleteRecord(record)">{{getN18('delete')}}</span>
            </div>
            <div class="col-md-2 cart-price">{{getN18('euro')}} {{ record.product.price }}</div>
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
                {{record.error}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="top2">
      <div class="col-md-2 cart-price">{{getN18('euro')}} {{ totalPrice }}</div>
      <div class="col-md-3"><a href="" class="Button small Buy-btn">{{getN18('passCommand')}}</a></div>
    </div>
  </div>
  <!--<input type="hidden" id="records" value="{{$records}}"/>-->
  <script>
    import LoadProgress from '../components/LoadProgress.vue'
    import * as N18 from '../lang'

    export default {
      data() {
        return {
          records: {},
          auth: $('meta[name=auth]').attr('content'),
          isLoading: true,
          baseUrl: $('meta[name=baseUrl]').attr('content'),
          N18: {},
        }
      },

      components: {
        'LoadProgress': LoadProgress,
      },

      mounted() {
        this.$nextTick(() => {
          const lang = $('meta[name=lang]').attr('content');
          this.N18 = N18[lang];
          let url = '/api/' + this.url + this.limit + '/' + this.page + '?' + query;

          this.$http.get(url).then(response => {
            this.records = response.data.data;
            this.isLoading = false;
          }, error => {
            console.log('load cart failed');
          });
        })
      },

      computed: {
        totalPrice() {
          let total = 0;
          this.records.map(function (record) {
            total += record.quantity * record.product.price;
          });
          return total;
        },

        getN18(text) {
          return this.N18[text];
        }
      },

      methods: {
        getUrl(product) {
          return this.baseUrl + '/products/' + product.slug;
        },

        deleteRecord(record) {
          if (this.auth > 0) {
            const url = '/api/carts/' + record.id + '/delete';
            const data = {
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

        increment(record) {
          record.quantity++;
        },

        decrement(record) {
          record.quantity--;
        },

        quantityKeydown(e, record) {
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

        quantityChange(record) {
          let num = parseInt(record.quantity);
          if (isNaN(num) || num < 1) {
            record.quantity = 1;
          } else if (num > record.product.stock) {
            record.quantity = record.product.stock;
            record.error = 'Stock Max: ' + record.product.stock;
            console.log(record.error);
          }
        }
      }
    }
  </script>
</template>

<script>
</script>