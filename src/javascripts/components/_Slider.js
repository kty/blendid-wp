import App from './App'

class Slider extends App {
  constructor(props) {
    super(props)
  }

  init() {
    let self = this

    this.element = $('.slideshow-block .slider')

    this.args = {
      prevArrow: '<button type="button" class="slick-arrow slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
      nextArrow: '<button type="button" class="slick-arrow slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
      infinite: true,
      dots: true,
      pauseOnHover: true
    }

    this.setColor = function(slide) {
      if (slide.hasClass('white')) {
        self.slider.addClass('light')
      } else {
        self.slider.removeClass('light')
      }
    }

    this.element.on('beforeChange', function(event, slick, currentSlide, nextSlide){
      self.slider = slick.$slider
      var slide = $(slick.$slides[nextSlide])

      self.setColor(slide)
    }).on('init', function(event, slick) {
      self.slider = slick.$slider
      var slide = $(slick.$slides[0])

      self.setColor(slide)
    })

    this.element.slick(this.args)
  }
}

export default Slider