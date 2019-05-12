class Blendid {
  constructor(element) {
    let self = this

    this._element = $(element)
    this._currentScroll = 0

    $(window).on('scroll', self.scroll)
  }

  get element() {
    return this._element
  }

  set element(element) {
    this._element = $(element)
  }

  set currentScroll(value) {
    this._currentScroll = value
  }

  get currentScroll() {
    return this._currentScroll
  }

  init() {
    
  }

  scroll() {
    this.currentScroll = $(window).scrollTop()
  }

  getCurrentScroll() {
    return this.currentScroll
  }

  addClass(element, value) {
    this.element = $(element)

    if (this.element.hasClass(value)) return
    this.element.addClass(value)
  }

  removeClass(element, value) {
    this.element = $(element)

    if (!this.element.hasClass(value)) return
    this.element.removeClass(value)
  }
}

export default Blendid