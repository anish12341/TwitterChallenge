$(function() {                     //FOR SLIDESHOW FUNCTIONING USING JQUERY
				   //LOGIC:Inside container ul is created of width 10*width(container) and inside ul li(s) are created 
	                           //       with width(container) at each interval ul will change its margin-left property in order 
	                           //       to show next li .
    var width= $("#slider").width();        //#slider is the container inside which ul is stored
    var animationSpeed = 1000;
    var pause = 4000;
    var currentSlide = 1;
    
    //cache DOM elements
    var $slider = $('#slider');                          //div(container)
    var $slideContainer = $('.slides', $slider);         //ul
	$slideContainer.width(10*width);
    var $slides = $('.slide', $slider);                  //li
	$slides.width(width);
    
	

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
