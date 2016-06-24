
$(document).ready(function(){
$('body').hide().delay(400).fadeIn(800);
qty_counter();
item_image_toggle();
showNav();
showHomeNav();
itemImages();
});

function qty_counter(){
  var qty = 1;
  // $('#qty-counter').val(qty);
    $('.qty-plus').on('click', function(){
          if(qty < 5){
            qty++;
            display_qty(qty);
          } else if(qty === 5){
            qty = 1;
            display_qty(qty);
          }
      });
      $('.qty-minus').on('click', function(){
        if(qty >= 2){
          qty--;
          display_qty(qty);
        } else if(qty === 1){
          qty = 5;
          display_qty(qty);
        }
      });
}

function display_qty(qty){
  $('#qty-counter').val(qty).html(qty);
}

function item_image_toggle(){
  $('.item-thumbs img').each(function(index){
    $(this).on('click', function(){
      var src = $(this).attr('src');
      $('.default-image').attr('src', src);
      $('.blow-up-image').attr('src', src);
    });
  });
}

function showNav() {
  $('.drop-button').on('click', function(){
    $('#menu').toggleClass('show-nav');
  });
}

function showHomeNav() {
  $('.nav-button').on('click', function(){
    $('#home-nav').toggleClass('show-nav');
  });
}

function itemImages() {
   $('.default-image').click(function(){
    $('.blow-up-image').addClass('fadeInLeft');
    $('.close').addClass('fadeInLeft');
 });
  $('.blow-up-image').click(function(){
    $(this).removeClass('fadeInLeft');
    $('.close').removeClass('fadeInLeft');
 });
}
