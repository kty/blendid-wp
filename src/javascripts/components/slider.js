import App from './App'

class Slider extends App {
  constructor(props) {
    super(props)
  }

  setSlideColor(slide) {
    var self = this

    if (slide.hasClass('white')) {
      self.slider.addClass('light')
    } else {
      self.slider.removeClass('light')
    }
  }

  init() {
    console.log('init slider')

    var self = this

    this.prevArrow = '<button type="button" class="slick-arrow slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>'
    this.nextArrow = '<button type="button" class="slick-arrow slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>'

    $('.slideshow-block .slider')
      .on('beforeChange', function(event, slick, currentSlide, nextSlide){
        self.slider = slick.$slider
        let slide = $(slick.$slides[nextSlide])

        self.setSlideColor(slide)
      })
      .on('init', function(event, slick) {
        self.slider = slick.$slider
        let slide = $(slick.$slides[0])

        self.setSlideColor(slide)
      })

    $('.slideshow-block .slider').slick({
      prevArrow: self.prevArrow,
      nextArrow: self.nextArrow,
      infinite: true,
      dots: true,
      pauseOnHover: true
    })
  }
}

export default Slider