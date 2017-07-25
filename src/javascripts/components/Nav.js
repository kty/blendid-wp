import Blendid from './Blendid'

class Nav extends Blendid {
  constructor() {
    super()

    this.init()
  }

  init() {
    let timer = null
    
    $('#header .dropdown').on('mouseenter', function() {
      let dropdown = $(this)

      clearTimeout(timer)

      if ($('#header .dropdown.show').length > 0) {
        $('#header .dropdown').removeClass('show')
      }

      if (!dropdown.hasClass('show')) {
        dropdown.addClass('show')
      }
    })

    $('#header .dropdown').on('mouseleave', function() {
      let dropdown = $(this)

      timer = setTimeout(function() {
        if (dropdown.hasClass('show')) {
          dropdown.removeClass('show')
        }
      }, 600)
    })

    $('#header .dropdown-toggle').on('click', function(e) {
      e.preventDefault()
      e.stopPropagation()
    })

    $('[data-toggle="offcanvas"]').on('click', function() {
      $('html').toggleClass('state--offcanvas')
    })

    $('#main').on('click', function(e) {
      if ($('html').hasClass('state--offcanvas')) {
        e.preventDefault()
        
        $('html').toggleClass('state--offcanvas')
      }
    })
  }
}

export default Nav