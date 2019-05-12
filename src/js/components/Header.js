import Blendid from './Blendid'

class Header extends Blendid {
  constructor (element) {
    super()

    this._header = $(element)
    this._headerHeight = 0
    this._lastScroll = 0

    this.init()
  }

  init() {

  }

  get header() {
    return this._header
  }

  get headerHeight() {
    return this._headerHeight
  }

  set headerHeight(value) {
    this._headerHeight = value
  }

  get lastScroll() {
    return this._lastScroll
  }

  set lastScroll(value) {
    this._lastScroll = value
  }

  scroll() {
    let currentScroll = super.getCurrentScroll()

    if (currentScroll < 0) {
      return
    }

    this.headerHeight = this.header.offsetHeight

    if (currentScroll < this.headerHeight) {
      super.removeClass(this.header, 'animate-up')
      return
    }

    if (currentScroll > this.lastScroll) {
      super.addClass(this.header, 'animate-up')
    } else {
      if (currentScroll < this.lastScroll - 10) {
        super.removeClass(this.header, 'animate-up')
      }
    }

    this.lastScroll = this.currentScroll
  }
}

export default Header