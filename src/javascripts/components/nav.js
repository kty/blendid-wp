let timer;

$('.dropdown').on('mouseenter', function() {
  let dropdown = $(this)

  clearTimeout(timer)

  if ($('.dropdown.open').length > 0) {
    $('.dropdown').removeClass('open')
  }

  if (!dropdown.hasClass('open')) {
    dropdown.addClass('open')
  }
})

$('.dropdown').on('mouseleave', function() {
  var dropdown = $(this)

  timer = setTimeout(function() {
    if (dropdown.hasClass('open')) {
      dropdown.removeClass('open')
    }
  }, 600)
})

$('.dropdown-toggle').on('click', function(e) {
  e.preventDefault()
  e.stopPropagation()
})

$('.offcanvas .nav-offcanvas .nav-item.menu-item-has-children').on('click', function(e) {
  let target = $(e.target),
      nav_item = $(this),
      nav_sub = nav_item.find('.sub')

  if (!target.is('.nav-link-child')) {
    e.preventDefault()

    if (nav_item.hasClass('open')) {
      nav_item.removeClass('open')
    } else {
      $('.offcanvas .nav-offcanvas .nav-item').removeClass('open')
      nav_item.addClass('open')
    }
  }
})

if ($('.offcanvas .nav-offcanvas .nav-item.menu-item-has-children').hasClass('current-menu-parent')) {
  $('.offcanvas .nav-offcanvas .nav-item.current-menu-parent').addClass('open')
}

$('[data-toggle="offcanvas"]').on('click', function() {
  $('html').toggleClass('state--offcanvas')
})

$('#main').on('click', function(e) {
  if ($('html').hasClass('state--offcanvas')) {
    e.preventDefault()
    
    $('html').toggleClass('state--offcanvas')
  }
})