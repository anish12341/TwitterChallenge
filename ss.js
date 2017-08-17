$(function() {

	var width= $("#slider").width();
    var animationSpeed = 1000;
    var pause = 4000;
    var currentSlide = 1;
    
    //cache DOM elements
    var $slider = $('#slider');//div
    var $slideContainer = $('.slides', $slider);//ul
	$slideContainer.width(10*width);
    var $slides = $('.slide', $slider);//li
	$slides.width(width);
      alert($slides.width(width)+"in starting");
	

    var interval;

    function startSlider() {
        interval = setInterval(function() {
			//alert($slideContainer.css("margin-left"));
			width=$slides.width();
            $slideContainer.animate({'margin-left': '-='+width}, animationSpeed, function() {
                if (++currentSlide === $slides.length) {
                    currentSlide = 1;
                    $slideContainer.css('margin-left', 0);
                }
            });
			
        }, pause);
    }
    function pauseSlider() {
        clearInterval(interval);
    }

    $slideContainer
        .on('mouseenter', pauseSlider)
        .on('mouseleave', startSlider);

		

    startSlider();
	
	


});
