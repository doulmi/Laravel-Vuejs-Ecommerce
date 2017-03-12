/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import VueLazyload from 'vue-lazyload'

Vue.use(VueLazyload, {
  loading: '../../img/placeholder.jpg',
  attempt: 1
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('product-list', require('./components/ProductList.vue'));

const app = new Vue({
  el: '#app'
});

let logo = $('#logo');
let goTop = $('#goTop');

$(document).scroll(() => {
  let scrollTop = $(document).scrollTop();
  let minHeightToChangeLogo = 500;

  if (scrollTop < minHeightToChangeLogo) {
    logo.animate({'margin-top': '0'}, 40);
    goTop.animate({'margin-top': '36px'}, 40);
  } else {
    logo.animate({'margin-top': '-48px'}, 40);
    goTop.animate({'margin-top': '-40px'}, 40);
  }
});

goTop.click(() => {
  $("html, body").animate({scrollTop: 0}, "slow");
});


function setCookie(cname,cvalue,exdays) {
  let d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  const expires = "expires=" + d.toGMTString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  const name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  const ca = decodedCookie.split(';');
  for(leti = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
