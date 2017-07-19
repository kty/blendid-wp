let timer;

$('#header .dropdown').on('mouseenter', function() {
  let dropdown = $(this)

  clearTimeout(timer)

  if ($('.dropdown.show').length > 0) {
    $('.dropdown').removeClass('show')
  }

  if (!dropdown.hasClass('show')) {
    dropdown.addClass('show')
  }
})

$('#header .dropdown').on('mouseleave', function() {
  var dropdown = $(this)

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

$('.offcanvas .nav-offcanvas .nav-item.menu-item-has-children').on('click', function(e) {
  let target = $(e.target),
      nav_item = $(this),
      nav_sub = nav_item.find('.sub')

  if (!target.is('.nav-link-child')) {
    e.preventDefault()

    if (nav_item.hasClass('show')) {
      nav_item.removeClass('show')
    } else {
      $('.offcanvas .nav-offcanvas .nav-item').removeClass('show')
      nav_item.addClass('show')
    }
  }
})

if ($('.offcanvas .nav-offcanvas .nav-item.menu-item-has-children').hasClass('current-menu-parent')) {
  $('.offcanvas .nav-offcanvas .nav-item.current-menu-parent').addClass('show')
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