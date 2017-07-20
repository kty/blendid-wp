$(function() {
  let prevArrow = '<button type="button" class="slick-arrow slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
      nextArrow = '<button type="button" class="slick-arrow slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>';

  function setSlideColor(slider, slide) {
    if (slide.hasClass('white')) {
      slider.addClass('light')
    } else {
      slider.removeClass('light')
    }
  }

  $('.slideshow-block .slider')
    .on('beforeChange', function(event, slick, currentSlide, nextSlide){
      let slider = slick.$slider
      let slide = $(slick.$slides[nextSlide])

      setSlideColor(slider, slide)
    })
    .on('init', function(event, slick) {
      let slider = slick.$slider
      let slide = $(slick.$slides[0])

      setSlideColor(slider, slide)
    })

  $('.slideshow-block .slider').slick({
    prevArrow: prevArrow,
    nextArrow: nextArrow,
    infinite: true,
    dots: true,
    pauseOnHover: true
  })
});