class Blendid {
  constructor(element) {
    let self = this

    this._element = element
    this._currentScroll = 0

    $(window).on('scroll', self.scroll)
  }

  get element() {
    return this._element
  }

  set element(element) {
    this._element = $(element)
  }

  scroll() {
    this._currentScroll = $(window).scrollTop()

    return this._currentScroll
  }

  hide(element) {
    this.element = $(element)

    if (this.element.hasClass('hide')) return
    this.element.addClass('hide')
  }

  show(element) {
    this.element = $(element)

    if (!this.element.hasClass('hide')) return
    this.element.removeClass('hide')
  }
}

export default Blendid