<template>
  <div>
    <div>
      <div class="products row" id="products" >
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" v-for="product in products" >
          <a href="#" class="product" :id='product.id'>
            <div class="card-header">
              <div class="buy-button-container">
                <a :href="getProductUrl(product.slug)" class="analytics-track-to-amazon card-buy-button">
                  <i class="icon-check price-icon" v-if='product.stock > 0'></i>
                  <i class="icon-ban" v-else></i>
                  <span class="price">
                    €{{product.price}}
                  </span>
                </a>
              </div>
            </div>
            <div class="avatar-panel">
              <img v-lazy="product.avatar" class="product-avatar" alt="">
              <div class="title" v-html="getProductName(product)"></div>
            </div>
            <div class="product-footer hidden-xs">
              <div class="footer-left-side">
                <img src="../../img/flash.png" alt="">
              </div>
              <div class="footer-right-side">
                <i class="like-btn">
                  <img class="icon"
                       src="../../img/heart.png"
                       alt="Likes">
                  <span class="likes">{{product.likes ? product.likes : 0}}</span>
                </i>

                <i class="collect-btn">
                  <img class="icon"
                       src="../../img/collect.png"
                       alt="Collect">
                  <span class="collect">{{product.collects ? product.collects : 0}}</span>
                </i>
              </div>
            </div>
          </a>
        </div>
      </div>

      <div v-if="isLoading">
        <LoadProgress/>
      </div>

      <div class="load-more" @click.stop.prevent='loadInfinit' v-if="!infinite && !isLoading">
        {{loadMoreText}}
      </div>
    </div>
  </div>
</template>

<script>
  import LoadProgress from '../components/LoadProgress.vue'

  export default {
     props: ['url'],

     data() {
      return {
        page: 1,
        products: [],
        limit: 24,
        isLoading: true,
        infinite: false,
        error: false,
        scrollEvent: {},
        latestUrl: '',
        viewsUrl: '',
        randomUrl: '',
        lang: 'fr',
        loadMoreText : '',
      }
    },

    components: {
      'LoadProgress': LoadProgress,
    },

     mounted() {
      this.$nextTick(function () {
        this.lang = $("meta[name='lang']").attr('content');
        this.loadMoreText = this.lang == 'fr' ? 'Afficher Plus' : 'Load More';

        this.loadMore();

        this.scrollEvent = () => {
          const scrollTop = $(window).scrollTop();
          const documentHeight = $(document).height();
          const windowHeight = $(window).height();

          const ratio = scrollTop / (documentHeight - windowHeight);
          const ratioToLoad = 8.5 / 10;
          if (this.infinite && !this.isLoading && ratio > ratioToLoad) {
            this.loadMore();
          }
        };

        window.addEventListener('scroll', this.scrollEvent);
      })
    },

    destroyed() {
      window.removeEventListener('scroll', this.scrollEven);
    },

    methods: {
      getProductName(product) {
        if(this.lang == 'fr') {
          return product.name_fr;
        } else {
          return product.name_en;
        }
      },

      getProductUrl(slug) {
        return '/products/' + slug;
      },

      loadInfinit() {
        this.infinite = true;
        this.loadMore();
      },

      loadMore() {
        this.isLoading = true;
        const query = $("meta[name='query']").attr('content');

        this.$http.get('/api/' + this.url + this.limit + '/' + this.page + '?' + query).then(response => {
          this.page ++;
          this.products = this.products.concat(response.data.data);

          if(this.products.length > 24) {
            this.products.slice(24);
          }

          if (response.data.data.length < this.page) {
            window.removeEventListener('scroll', this.scrollEvent);
            this.infinite = true;
          }
          this.isLoading = false;
          this.error = false;
        }, (response) => {
          this.error = true;
          this.infinite = false;
          this.isLoading = false;
        });
      }
    }
  }




</script>