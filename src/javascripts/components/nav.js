$(function() {

  let timer;

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

  $('[data-toggle="offcanvas"]').on('click', function() {
    $('html').toggleClass('state--offcanvas')
  })

  $('#main').on('click', function(e) {
    if ($('html').hasClass('state--offcanvas')) {
      e.preventDefault()
      
      $('html').toggleClass('state--offcanvas')
    }
  })

});