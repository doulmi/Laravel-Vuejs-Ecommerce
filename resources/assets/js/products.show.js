var quantity = $('#quantity');
$app = new Vue({
  el: 'body',
  data: {
    liked: false,
    collected: false,
    quantity: 1,
    stock: quantity.data('max')
  } ,

  methods: {
    like: function() {
      console.log('like');
    },

    collect: function() {

    },

    increment: function() {
      var num = parseInt(this.quantity) + 1;
      if(num <= this.stock) {
        this.quantity = num;
      }
    },

    decrement: function() {
      var num = parseInt(this.quantity) - 1;
      if(num > 0) {
        this.quantity = num;
      }
    }
  }
});

$(function() {
  quantity.keydown(function (e) {
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
  });

  quantity.change(function() {
    var num = parseInt(quantity.val());
    if(num < 1) {
      quantity.val(1);
    } else if(num > stock) {
      quantity.val(stock);
    }
  });
});