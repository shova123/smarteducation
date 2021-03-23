//make height equals to width
//var cw = $('.port-show').width();
//$('.port-show').css({
//    'height': cw + 'px'
//});
//scrolreaveal initialize
 //window.scrollReveal = new scrollReveal();
//call stellar for parallax
//$(window).stellar();
//call fatnav funciton
//(function() {
//    $.fatNav();
//}());
//lightslider
//$(document).ready(function() {
//    $("#special").lightSlider({
//        item:4,
//        loop:true,
//        slideMargin: 0,
//        auto:true,
//        pause: 7000,
//        speed: 1800,
//        mode: 'slide',
//        pager: true,
//        easing: 'ease',
//         responsive : [
//        {
//        breakpoint:991,
//        settings: {
//                item:2,
//                slideMove:1,
//                slideMargin:6,
//            }
//        },
//        {
//        breakpoint:480,
//        settings: {
//                item:1,
//                slideMove:1
//                }
//            }
//        ]
//    });
//    $("#testi").lightSlider({
//        item:1,
//        loop:true,
//        slideMargin: 0,
//        auto:true,
//        pause: 9000,
//        speed: 1800,
//        mode: 'fade',
//        pager: true,
//        controls:false,
//        easing: 'ease',
//    });
//});
//page preload
$(window).load(function() {
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");;
});
//toolbar
// $('#button').toolbar({
//     content: '#toolbar-options',
// });
//more content portion
function articleOpen(id){
    $('#'+id).slideDown();  
    var f = $('#'+id).offset();
    var top = (f["top"]) - 150; 
    $('html, body').animate({
      scrollTop: (top)
    },800);
    $('#'+id).removeAttr('style');
}
function articleClose(id){
    $('#'+id).slideUp();
    var f = $('#'+id).offset();
    var top = (f["top"]) - 220; 
    $('html, body').animate({
      scrollTop: (top)
    },800);
}
// //call tooltip
//   $(document).ready(function () {
//     $('[data-toggle="tooltip"]').tooltip();
//   });
