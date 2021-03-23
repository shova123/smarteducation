//animate hamburger icon
$(document).ready(function () {
	$(".navbar-toggle").on("click", function () {
	    $(this).toggleClass("active");
	});

	$("#course-slide").lightSlider({
	    item:4,
	        loop:true,
	        slideMargin: 30,
	        auto:true,
	        pause: 7000,
	        speed: 1800,
	        mode: 'slide',
	        pager: false,
	        easing: 'ease',
	         responsive : [
	        {
	        breakpoint:991,
	        settings: {
	                item:2,
	                slideMove:1,
	                slideMargin:15,
	            }
	        },
	        {
	        breakpoint:480,
	        settings: {
	                item:1,
	                slideMove:1,
	                slideMargin: 5
	                }
	            }
	        ]
	});

	$("#video-slide").lightSlider({
	    item:4,
	        // loop:true,
	        slideMargin: 30,
	        auto:true,
	        pause: 9000,
	        speed: 1800,
	        mode: 'slide',
	        pager: true,
	        controls: false,
	        easing: 'ease',
	         responsive : [
	        {
	        breakpoint:991,
	        settings: {
	                item:2,
	                slideMove:1,
	                slideMargin:15,
	            }
	        },
	        {
	        breakpoint:480,
	        settings: {
	                item:1,
	                slideMove:1,
	                slideMargin: 5
	                }
	            }
	        ]
	});

	//select a referenced box for bottom alignment
	var bottomReferenceBox = $('.pagination-parent-div');
	//calculate the bottom position
	var bottomOffLine = $(document).height() - bottomReferenceBox.offset().top - bottomReferenceBox.outerHeight();
	$('.affix-top').affix({
	  offset: {
	    top: 70,
	    bottom: bottomOffLine
	  }
	})
});
//active class in  menu
// $(function() {
//      var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
//      $("nav ul a").each(function(){
//           if($(this).attr("href") == pgurl )
//           $(this).addClass("active");
//      })
// });

//equalize heights of divs
var maxHeight = 0;
$(".single").each(function(){
   if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
});
$(".single").height(maxHeight);

//function for shrinking navbar
  $(window).scroll(function() {
    if ($(document).scrollTop() > 200) {
      $('nav').addClass('shrink');
    } else {
      $('nav').removeClass('shrink');
    }
  });


//open the lateral panel
$('.cd-btn').on('click', function(event){
	event.preventDefault();
	$('.cd-panel').addClass('is-visible');
	$('body').addClass('hide-y');
});
//close the lateral panel
$('.cd-panel').on('click', function(event){
	if( $(event.target).is('.cd-panel') || $(event.target).is('.cd-panel-close') ) { 
		$('.cd-panel').removeClass('is-visible');
		$('body').removeClass('hide-y');
		event.preventDefault();
	}
});

//hide and show divs
$(function(){
	$('.show_register').click(function(){
		$('.login_div').hide();
		$('.forgot_pass').hide();
		$('.signup_div_cont').hide();
		$('.signup_div').show();
		return false;
	});
	$('.continue_signup').click(function(){
		$('.login_div').hide();
		$('.forgot_pass').hide();
		$('.signup_div').hide();
		$('.signup_div_cont').show();
		return false;
	});
	$('.forgot_password').click(function(){
		$('.signup_div').hide();
		$('.login_div').hide();
		$('.signup_div_cont').hide();
		$('.forgot_pass').show();
		return false;
	});
	$('.show_login').click(function(){
		$('.login_div').show();
		$('.signup_div').hide();
		$('.signup_div_cont').hide();
		$('.forgot_pass').hide();
		return false;
	});
	// $("[aria-controls=candidate]").click(function(){
	// 	$('.login_div').show();
	// 	$('.signup_div').hide();
	// 	$('.signup_div_cont').hide();
	// 	$('.forgot_pass').hide();
	// 	return false;
	// });
});

//tooltip initialize
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
})

