import Blendid from './Blendid'

class Slider extends Blendid {
  constructor(element, args) {
    super(element, args)

    this._element = $(element)
    this.args = args
    
    this.init()
  }

  get args() {
    return this._args
  }

  set args(value) {
    this._args = value
  }

  init() {
    let self = this

    this.element.on('beforeChange', function(event, slick, currentSlide, nextSlide){
      this.element = slick.$slider
      var slide = $(slick.$slides[nextSlide])

      self.setColor(slide)
    }).on('init', function(event, slick) {
      this.element = slick.$slider
      var slide = $(slick.$slides[0])

      self.setColor(slide)
    })

    this.element.slick(this._args)
  }

  setColor(slide) {
    if (slide.hasClass('white')) {
      this.element.addClass('light')
    } else {
      this.element.removeClass('light')
    }
  }
}

export default Slider