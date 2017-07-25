import Blendid from './Blendid'

class Header extends Blendid {
  constructor (element) {
    super()

    this._header = element
  }

  get header() {
    return this._header
  }

  set header(header) {
    this._header = $(header)
  }

  scroll() {
    let currentScroll = super.scroll()

    if (currentScroll > 500) {
      super.hide(this.header)
    } else {
      super.show(this.header)
    }
  }
}

export default Header